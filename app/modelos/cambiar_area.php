<?php

require "../funciones.php";
session_start();
$link = conectar();

$sql = 
	"UPDATE `fichatrabajo` 
	SET `Area_idArea` = '{$_POST['idArea']}'
	WHERE `Aspirante_idAspirante` = '{$_POST['idAspirante']}'
	AND idFichaTrabajo = '{$_POST['idFichaTrabajo']}'";

mysql_query($sql, $link);

$error = mysql_error($link);

if ($error == null) {
    echo "ok";
} else {
    echo "error";
}
mysql_close($link);

?>