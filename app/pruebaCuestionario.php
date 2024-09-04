<?php
session_start();

require "funciones.php";


    $link = conectar();
    
    $idUser = getUsuarioByUser($_SESSION['usuario']);
    
    $sql = "INSERT INTO cuestionario
            (Numero,
             Usuario_idUsuario)
            VALUES ('{$_POST['numero']}',
                    '$idUser');";

    mysql_query($sql, $link);

    $id = mysql_insert_id();
    
    
    for ($i = 1; $i < 32; $i++) {

        $sql = "INSERT INTO pregunta
            (numero,
             respuesta,
             Cuestionario_idCuestionario)
            VALUES (
                    '$i',
                    '{$_POST['preg'.$i]}',
                    '$id');";

                    mysql_query($sql, $link);
    }
    
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: pruebas.php?estado=guardado");
    } else {
        header("Location: pruebas.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    
    mysql_close($link);