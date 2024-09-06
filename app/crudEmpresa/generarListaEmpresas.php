<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';

$pdo = conectar();

try {
    $sql = "SELECT * FROM empresa ORDER BY Nombre";
    $stmt = $pdo->query($sql);

    $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($empresas as $line) {
        $nombre = mb_convert_encoding($line['Nombre'], "UTF-8", "ASCII");
        echo '<option value="' . $line['idEmpresa'] . '">' . $nombre . '</option>';
    }
} catch (PDOException $e) {
    echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
}

$pdo = null;
?>
