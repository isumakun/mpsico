<?php

require_once 'funciones.php';
$pdo = conectar();

try {
    $sql = "SELECT a.idArea AS idArea,
                   a.Nombre AS area, 
                   e.Nombre AS empresa, 
                   a.Empresa_idEmpresa AS idEmpresa
            FROM area AS a
            INNER JOIN empresa AS e
                ON e.idEmpresa = a.Empresa_idEmpresa";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Opcional: Puedes imprimir el SQL para depuración
    // echo htmlspecialchars($sql, ENT_QUOTES, 'UTF-8');

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

?>
