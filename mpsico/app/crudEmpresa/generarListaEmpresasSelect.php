<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT * FROM empresa ORDER BY idEmpresa DESC";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    
    if($_GET['empresa']===$line['idEmpresa']){
        echo '<option selected="" value="'.$line['idEmpresa'].'">'.$line['Nombre'].'</option>';
    }else{
        echo '<option value="'.$line['idEmpresa'].'">'.htmlentities($line['Nombre']).'</option>';
    }
    
}