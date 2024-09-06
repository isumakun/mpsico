<?php

$pdo = conectar();

try {
    $sql = "SELECT * FROM empresa ORDER BY idEmpresa DESC";
    $stmt = $pdo->query($sql);
    
    $empresas = array();
    
    // Obtener los resultados y agregarlos al array
    while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $empresas[] = $line;
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
}

$pdo = null;
?>
