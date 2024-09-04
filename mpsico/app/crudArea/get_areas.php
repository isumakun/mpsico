<?php

require_once 'funciones.php';
$link = conectar();

$sql = "SELECT a.idArea AS idArea,
        a.Nombre AS area, e.Nombre AS empresa, a.Empresa_idEmpresa AS idEmpresa
        FROM area AS a
        INNER JOIN empresa AS e
        ON e.idEmpresa = a.Empresa_idEmpresa";

$query = mysql_query($sql, $link);

//echo $sql;

$areas = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
   array_push($areas, $line);
}