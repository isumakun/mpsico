<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT * FROM empresa ORDER BY Nombre";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
        $nombre = mb_convert_encoding($line['Nombre'], "UTF-8", "ASCII");
        echo '<option value="'.$line['idEmpresa'].'">'.$nombre.'</option>';
    
}