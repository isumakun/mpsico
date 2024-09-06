<?php

require 'funciones.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$pdo = conectar();

if (isset($_POST["usuario"]) && isset($_POST["password"])) {

    // Consulta para verificar si el usuario existe
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario ORDER BY idUsuario DESC LIMIT 1");
    $stmt->execute(['usuario' => $_POST['usuario']]);
    $nusuarios = $stmt->rowCount();

    if ($nusuarios != 0) {
        /*
            Tabla: usuario
            Columna	Tipo	Comentario
            idUsuario	int Incremento automático	
            usuario	varchar(256)	
            password	varchar(256)	
            tipo	int	
        */
        
        // Consulta si el usuario y la contraseña en Sh1 son correctos
        $contra = sha1($_POST["password"]);

        $smtp = $pdo->prepare("SELECT * FROM usuario WHERE password = :password AND usuario = :usuario ORDER BY idUsuario DESC LIMIT 1");
        $smtp->bindParam(':password', $contra, PDO::PARAM_STR);
        $smtp->bindParam(':usuario', $_POST["usuario"], PDO::PARAM_STR);
        $smtp->execute();
        $logged = $smtp->fetch(PDO::FETCH_ASSOC);

        if (!empty($logged)) {
            // Consulta para obtener los datos del usuario
            $stmtDatos = $pdo->prepare("SELECT u.usuario, a.forma, a.cedula, a.idAspirante 
                                        FROM usuario AS u
                                        INNER JOIN aspirante AS a ON a.Usuario_idUsuario = u.idUsuario
                                        WHERE usuario = :usuario
                                        ORDER BY u.idUsuario DESC LIMIT 1");
            $stmtDatos->bindParam(':usuario', $_POST["usuario"], PDO::PARAM_STR);
            $stmtDatos->execute();
            //check the sql with the parameters replaced
            $query = $stmtDatos->queryString;
            $usuarioData = $stmtDatos->fetch(PDO::FETCH_ASSOC);

            if (validarFicha($usuarioData['usuario'])) {
                $idAsp = getIDByUser($usuarioData['usuario']);
                $stmtCargo = $pdo->prepare("SELECT tipocargo FROM fichatrabajo WHERE Aspirante_idAspirante = :idAsp");
                $stmtCargo->execute(['idAsp' => $idAsp]);
                $tipocargo = $stmtCargo->fetchColumn();

                if (strpos($tipocargo, 'Jefatura') !== false) {
                    $_SESSION['cargo'] = 'jefe';
                } else {
                    $_SESSION['cargo'] = 'aux';
                }
            }

            $_SESSION['forma']          = $usuarioData['forma'];
            $_SESSION['cedula']         = $usuarioData['cedula'];
            $_SESSION['id']             = $usuarioData['idAspirante'];
            $_SESSION['tipo']           = $logged['tipo'];
            $_SESSION['usuario']        = $_POST["usuario"];
            $_SESSION['password']       = $contra;
            $_SESSION['autenticado']    = "autenticado";
            $_SESSION['login'] = true;

            if ($_SESSION['tipo'] == 1) {
                header("Location: index");
            } else {
                $empresaUsuario = getEmpresaUsuario();
                $_SESSION['idEmpresa'] = $empresaUsuario['idEmpresa'];

                if (validarFicha($usuarioData['usuario'])) {
                    header("Location: pruebas");
                } else {
                    header("Location: fichaTecnica");
                }
            }
        } else {
            header("Location: login?estado=contra");
        }
    } else {
        header("Location: login?estado=nousuario");
    }
}
$pdo = null;
?>
