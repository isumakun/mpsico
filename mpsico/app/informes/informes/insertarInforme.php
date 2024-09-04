<?php

require "../funciones.php";

$link = conectar();

$sql = "INSERT INTO informe
            (observaciones,
             recomendaciones,
             Usuario_idUsuario)
VALUES ('{$_POST['observaciones']}',
        '{$_POST['recomendaciones']}',
        'Usuario_idUsuario');";

