<?php
require "funciones.php";
session_start();

    $link = conectar();
    $sql = "UPDATE usuario
    SET consentimiento = 1
    WHERE usuario = '{$_SESSION['usuario']}'";

    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: pruebas.php");
    } else {
        echo $sql;
        //header("Location: ../nuevoAspirante.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
