<?php

require './funciones.php';

$pdo = conectar();

try {
    $sql = "UPDATE prueba SET link = :link WHERE idPrueba = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['link' => $_POST['link']]);

    // Verificamos si la consulta fue exitosa
    if ($stmt->rowCount() > 0) {
        header('Location: configurarPruebas.php');
    } else {
        echo "<center><h1>No se realizaron cambios en la base de datos.</h1></center>";
    }
} catch (PDOException $e) {
    echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
}

$pdo = null;
?>
