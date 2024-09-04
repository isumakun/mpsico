<?php

require_once 'funciones.php';
$link = conectar();

$sql = "SELECT
    area.idArea
    , area.Nombre
FROM
    area
    INNER JOIN empresa 
        ON (area.Empresa_idEmpresa = empresa.idEmpresa)
    INNER JOIN aspirante 
        ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
        WHERE aspirante.Cedula = ".$_SESSION['usuario'].""
        . " GROUP BY idArea";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {

echo '<option value="'.$line['idArea'].'">'.$line['Nombre'].'</option>';
}