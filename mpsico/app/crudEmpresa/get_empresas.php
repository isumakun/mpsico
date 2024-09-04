<?php

$link = conectar();

$sql = "SELECT * FROM empresa ORDER BY idEmpresa DESC";

$query = mysql_query($sql, $link);

$empresas = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
   array_push($empresas, $line);
}