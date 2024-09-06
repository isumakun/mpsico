<?php
require "funciones.php";
session_start();

try {
    $link = conectar();

    // Actualizar consentimiento del usuario
    $sql = "UPDATE usuario
            SET consentimiento = 1
            WHERE usuario = :usuario";
    
    $stmt = $link->prepare($sql);
    $stmt->execute([
        ':usuario' => $_SESSION['usuario']
    ]);

    // Verificar si la consulta se ejecutó correctamente
    if ($stmt->rowCount() > 0) {
        header("Location: pruebas.php");
        exit();
    } else {
        throw new Exception("No se realizó ninguna actualización.");
    }
} catch (PDOException $e) {
    echo "<center><h1>" . htmlspecialchars($e->getMessage()) . "</h1></center>";
} catch (Exception $e) {
    echo "<center><h1>" . htmlspecialchars($e->getMessage()) . "</h1></center>";
}
?>
