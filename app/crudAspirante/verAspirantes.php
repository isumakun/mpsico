<?php
require_once 'entidades/aspirante.php';
header('Content-Type: application/json');

try {
    $pdo = conectar();

    if (isset($_GET['empresa'])) {
        if ($_GET['empresa'] === "all") {
            $sql = "SELECT * FROM aspirante";
        } else {
            $sql = "SELECT * FROM aspirante WHERE Empresa_idEmpresa = :empresa";
        }
    } else {
        $sql = "SELECT * FROM aspirante";
    }

    $stmt = $pdo->prepare($sql);

    if (isset($_GET['empresa']) && $_GET['empresa'] !== "all") {
        $stmt->bindParam(':empresa', $_GET['empresa'], PDO::PARAM_INT);
    }

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
