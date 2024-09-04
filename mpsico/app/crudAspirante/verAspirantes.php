<?php
require_once 'entidades/aspirante.php';
header('Content-Type: application/json');

$link = conectar();

if(isset($_GET['empresa'])){
    if($_GET['empresa']=="all"){
        $sql = "SELECT * FROM aspirante";
    }else{
        $sql = "SELECT * FROM aspirante where Empresa_idEmpresa = {$_GET['empresa']}";
    }
}else{
    $sql = "SELECT * FROM aspirante";
}

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    $a = new aspirante();
    $a->idAspirante = $line['idAspirante'];
    $a->cedula = $line['Cedula'];
    $a->nombre = $line['Nombre'];
    $a->apellido1 = $line['Apellido1'];
    $a->apellido2 = $line['Apellido2'];
    $a->telefono = $line['Telefono'];
    $a->direccion = $line['Direccion'];
    $a->email = $line['Email'];
    $a->idEmpresa = $line['Empresa_idEmpresa'];

    $lista[$fila] = $a;
    $fila++;
}

echo json_encode($lista, JSON_UNESCAPED_UNICODE);

mysql_close($link);
