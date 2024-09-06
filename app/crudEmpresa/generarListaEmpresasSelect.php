<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';

$pdo = conectar();

try {
    $sql = "SELECT * FROM empresa ORDER BY idEmpresa DESC";
    $stmt = $pdo->query($sql);
    $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($empresas as $line) {
        // Verificamos si la empresa está seleccionada
        if ($_GET['empresa'] === $line['idEmpresa']) {
            echo '<option selected value="' . $line['idEmpresa'] . '">' . htmlentities($line['Nombre']) . '</option>';
        } else {
            echo '<option value="' . $line['idEmpresa'] . '">' . htmlentities($line['Nombre']) . '</option>';
        }
    }
} catch (PDOException $e) {
    echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
}

$pdo = null;
?>
