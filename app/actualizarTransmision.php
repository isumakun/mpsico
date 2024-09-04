<?php

require './funciones.php';

$link = conectar();

$sql = "UPDATE prueba
SET link = '{$_POST['link']}'
WHERE idPrueba = '1'";

mysql_query($sql, $link);

    $error = mysql_error($link);

    if ($error == null) {
        header('Location: configurarPruebas.php');
    } else {
        //header("Location: ../nuevoAspirante.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }

//