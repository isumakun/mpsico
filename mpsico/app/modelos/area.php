<?php

require "../funciones.php";

function nuevaArea($nombre, $idEmpresa) {

    $link = conectar();

    $sql = "INSERT INTO area
            (
             Nombre,
             Empresa_idEmpresa)
            VALUES (
                    '$nombre',
                    '$idEmpresa');";

    mysql_query($sql, $link);

    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../areas.php?estado=guardado");
    } else {
        //header("Location: ../nuevoEmpresa.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }

    mysql_close($link);
}

function eliminarArea($idArea) {
    $link = conectar();
    $sql = "DELETE
            FROM area
            WHERE idArea = $idArea";

    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../areas.php");
    } else {
        header("Location: ../areas.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}

function editarArea($idArea, $nombre) {
    $link = conectar();

    $sql = "UPDATE area
            SET 
              Nombre = '$nombre'
            WHERE idArea = $idArea";

    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../areas.php?estado=guardado");
    } else {
        // header("Location: ../index3.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}
