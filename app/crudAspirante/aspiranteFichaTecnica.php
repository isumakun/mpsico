<?php
require_once 'funciones.php';

$pdo = conectar();

try {
    $sql = "SELECT
                aspirante.Nombre,
                aspirante.Apellido1,
                aspirante.Apellido2
            FROM
                aspirante
            INNER JOIN usuario 
                ON aspirante.Usuario_idUsuario = usuario.idUsuario
            WHERE usuario.usuario = :usuario
            ORDER BY aspirante.idAspirante DESC
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_STR);
    $stmt->execute();

    $line = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($line) {
        ?>

        <div class="form-group">
            <label class="control-label" for="nombre">Nombre</label>
            <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['Nombre'], ENT_QUOTES, 'UTF-8'); ?>" name="nombre" id="nombre" placeholder="Nombre del aspirante">
        </div>

        <div class="form-group">
            <label class="control-label" for="apellido1">Primer Apellido</label>
            <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['Apellido1'], ENT_QUOTES, 'UTF-8'); ?>" name="apellido1" id="apellido1" placeholder="Primer Apellido del aspirante">
        </div>

        <div class="form-group">
            <label class="control-label" for="apellido2">Segundo Apellido</label>
            <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['Apellido2'], ENT_QUOTES, 'UTF-8'); ?>" name="apellido2" id="apellido2" placeholder="Segundo Apellido del aspirante">
        </div>

        <?php
    } else {
        echo "<p>No se encontró el aspirante.</p>";
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

$pdo = null;
