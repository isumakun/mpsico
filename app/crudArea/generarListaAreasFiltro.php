<?php

require_once 'funciones.php';
$pdo = conectar();

try {
    $sql = "SELECT 
                a.Nombre AS area, 
                e.Nombre AS empresa 
            FROM area AS a
            INNER JOIN empresa AS e
                ON e.idEmpresa = a.Empresa_idEmpresa
            GROUP BY e.idEmpresa";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Mostrar la consulta SQL para depuración
    echo htmlspecialchars($sql, ENT_QUOTES, 'UTF-8');

    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($areas as $line) {
        echo '<option value="' . htmlspecialchars($line['area'], ENT_QUOTES, 'UTF-8') . '">[' 
             . htmlspecialchars($line['empresa'], ENT_QUOTES, 'UTF-8') . '] ' 
             . htmlspecialchars($line['area'], ENT_QUOTES, 'UTF-8') . '</option>';
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

?>
