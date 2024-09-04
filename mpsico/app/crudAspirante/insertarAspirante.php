<?php

require "../modelos/aspirante.php";

if (!empty($_POST['idAspirante'])) {
        editarAspirante($_POST['idAspirante'], $_POST['cedula'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['telefono'], $_POST['direccion'], $_POST['email'], $_POST['empresa'], $_POST['forma']);
}else {
    agregarAspirante($_POST['cedula'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['telefono'], $_POST['direccion'], $_POST['email'], $_POST['empresa'], $_POST['forma']);
}
?>
