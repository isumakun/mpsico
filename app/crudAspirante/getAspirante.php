<?php
require_once '../funciones.php';

header('Content-Type: application/json');

class Aspirante {
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

try {
    $pdo = conectar();

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $sql = "SELECT * FROM aspirante WHERE idAspirante = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $lista = array();

    while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $a = new Aspirante();
        $a->idAspirante = $line['idAspirante'];
        $a->cedula = $line['Cedula'];
        $a->nombre = $line['Nombre'];
        $a->apellido1 = $line['Apellido1'];
        $a->apellido2 = $line['Apellido2'];
        $a->telefono = $line['Telefono'];
        $a->direccion = $line['Direccion'];
        $a->email = $line['Email'];
        $a->idEmpresa = $line['Empresa_idEmpresa'];

        $lista[] = $a;
    }

    echo json_encode($lista, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

$pdo = null;
