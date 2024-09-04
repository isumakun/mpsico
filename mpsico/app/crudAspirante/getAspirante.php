<?php
require_once '../funciones.php';

header('Content-Type: application/json');

class aspirante {

    public $idAspirante;
    public $cedula;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $telefono;
    public $direccion;
    public $email;
    public $idEmpresa;
}

$link = conectar();

$sql = "SELECT * FROM aspirante where idAspirante = {$_GET['id']}";

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
