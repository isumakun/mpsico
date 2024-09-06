<?php

require "../funciones.php";

function nuevaArea($nombre, $idEmpresa) {
    $link = conectar();

    $sql = "INSERT INTO area (Nombre, Empresa_idEmpresa) VALUES ('$nombre', $idEmpresa)";

    if ($res = $link->query($sql)) {
        header("Location: ../areas.php?estado=guardado");
    } else {
        //get if there is an error
        echo "<center><h1></h1></center>";
        // header("Location: ../nuevoEmpresa.php?estado=errordatos");
    }
}

function eliminarArea($idArea) {
    $link = conectar();
    
    $sql = "DELETE FROM area WHERE idArea = $idArea";

    if ($link->query($sql)) {
        header("Location: ../areas.php");
    } else {
        echo "<center><h1></h1></center>";
        header("Location: ../areas.php?estado=errordatos");
    }
}

function editarArea($idArea, $nombre) {
    $link = conectar();

    $sql = "UPDATE area SET Nombre = '$nombre' WHERE idArea = $idArea";

    if ($link->query($sql)) {
        header("Location: ../areas.php?estado=guardado");
    } else {
        echo "<center><h1></h1></center>";
        // header("Location: ../index3.php?estado=errordatos");
    }
}
