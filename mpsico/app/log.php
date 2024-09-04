<?php

require 'funciones.php';
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
$link = conectar();
if ((isset($_POST["usuario"])) && (isset($_POST["password"]))) {


    $usuarios = mysql_query("SELECT * from usuario where usuario='{$_POST['usuario']}'  ORDER BY idUsuario DESC LIMIT 1", $link);
    $nusuarios = mysql_num_rows($usuarios);


    if ($nusuarios != 0) {

        $sql1 = "SELECT tipo from usuario where password='{$_POST["password"]}' 
                                                && usuario='{$_POST["usuario"]}'
                                                ORDER BY idUsuario DESC LIMIT 1";
        $tipouser = mysql_query($sql1, $link);

        $resultContra = mysql_query("SELECT password from usuario where usuario='{$_POST["usuario"]}'
            ORDER BY idUsuario DESC LIMIT 1", $link);
        $contra = mysql_result($resultContra, 0);

        $sql2 = "SELECT u.usuario, a.forma, a.cedula, a.idAspirante FROM usuario AS u
                 INNER JOIN aspirante AS a
                 ON a.Usuario_idUsuario = u.idUsuario
                 WHERE password='{$_POST["password"]}' 
                 AND usuario='{$_POST["usuario"]}'
                 ORDER BY u.idUsuario DESC LIMIT 1";

        $result = mysql_query($sql2, $link);
        $usuario = mysql_result($result, 0, 0);

        if (validarFicha($usuario)) {
            $idAsp = getIDByUser($usuario);
            $sqlcargo = "SELECT tipocargo from fichatrabajo where Aspirante_idAspirante= $idAsp";
            $result = mysql_query($sql2, $link);
            $tipocargo = mysql_result($result, 0);
            if (strpos($tipocargo, 'Jefatura') !== false) {
                $_SESSION['cargo'] = 'jefe';
            }else{
                 $_SESSION['cargo'] = 'aux';
            }
        }

        if ($contra == $_POST["password"]) {

            $_SESSION['forma'] = mysql_result($result, 0, 1);
            $_SESSION['cedula'] = mysql_result($result, 0, 2);
            $_SESSION['id'] = mysql_result($result, 0, 3);
            $_SESSION['tipo'] = mysql_result($tipouser, 0, 0);
            $_SESSION['usuario'] = $_POST["usuario"];
            $_SESSION['password'] = $contra;
            $_SESSION['autenticado'] = "autenticado";
            $_SESSION['login'] = true;

            if ($_SESSION['tipo'] == 1) {
                header("Location: index.php");
            } else {
                $result = getEmpresaUsuario();

                $_SESSION['idEmpresa'] = $result['idEmpresa'];

                if (validarFicha($usuario)!='') {
                    header("Location: pruebas.php");
                } else {
                    header("Location: fichaTecnica.php");
                }
            }
        } else {
            header("Location: login.php?estado=contra");
        }
    } else {
        header("Location: login.php?estado=nousuario");
    }
}
mysql_close($link);
