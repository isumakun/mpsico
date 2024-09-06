<?php

require "../funciones.php";
session_start();
$link = conectar();

// Interpolación directa en la consulta SQL
$idArea = intval($_POST['idArea']);
$idAspirante = intval($_POST['idAspirante']);
$idFichaTrabajo = intval($_POST['idFichaTrabajo']);

$sql = "UPDATE fichatrabajo 
        SET Area_idArea = $idArea
        WHERE Aspirante_idAspirante = $idAspirante 
        AND idFichaTrabajo = $idFichaTrabajo";

if ($link->query($sql)) {
    echo "ok";
} else {
    echo "error";
}

?>
