<?php

require "../modelos/area.php";

if (!empty($_POST['idArea'])) {
    editarArea($_POST['idArea'],$_POST['nombre'], $_POST['empresa']);
}else {
    nuevaArea($_POST['nombre'], $_POST['empresa']);
}

