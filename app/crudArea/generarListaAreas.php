<?php

require_once 'funciones.php';
$pdo = conectar();

try {
    $sql = "SELECT
                area.idArea,
                area.Nombre
            FROM
                area
                INNER JOIN empresa 
                    ON area.Empresa_idEmpresa = empresa.idEmpresa
                INNER JOIN aspirante 
                    ON aspirante.Empresa_idEmpresa = empresa.idEmpresa
            WHERE aspirante.Cedula = :usuario
            GROUP BY idArea";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario' => $_SESSION['usuario']]);

    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($areas as $line) {
        echo '<option value="' . htmlspecialchars($line['idArea'], ENT_QUOTES, 'UTF-8') . '">' 
             . htmlspecialchars($line['Nombre'], ENT_QUOTES, 'UTF-8') . '</option>';
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

?>
