<?php

require "../modelos/empresa.php";


if (!empty($_POST['idEmpresa'])) {
    editarEmpresa($_POST['idEmpresa'], $_POST['nit'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['email'], $_POST['sector'], $_POST['ciudad'], $_FILES['imagen']);
}else {
    agregarEmpresa($_POST['nit'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['email'], $_POST['sector'], $_POST['ciudad'], $_FILES['imagen']);
}
?>
