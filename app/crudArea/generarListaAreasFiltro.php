<?php

require_once 'funciones.php';
$link = conectar();

$sql = "SELECT 
        a.Nombre AS area, e.Nombre AS empresa FROM area AS a
        INNER JOIN empresa AS e
        ON e.idEmpresa = a.Empresa_idEmpresa
        GROUP BY Empresa_idEmpresa";

$query = mysql_query($sql, $link);

echo $sql;

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    echo '<option value="' . $line['area'] . '">['.$line['empresa'].'] '.$line['area'].'</option>';
}