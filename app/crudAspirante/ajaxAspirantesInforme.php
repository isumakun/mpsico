<?php
require_once 'funciones.php';

$pdo = conectar();

try {
    if (isset($_GET['empresa'])) {
        if ($_GET['empresa'] === "all") {
            $sql = "SELECT * FROM aspirante";
            $stmt = $pdo->prepare($sql);
        } else {
            $sql = "SELECT * FROM aspirante WHERE Empresa_idEmpresa = :empresa ORDER BY idAspirante DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':empresa', $_GET['empresa'], PDO::PARAM_INT);
        }
        
        $stmt->execute();
        $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<table id="tabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th style="width: 15%"></th>
                    </tr>
                </thead>';

        foreach ($aspirantes as $line) {
            echo '<tr>';
            echo "<td>" . htmlspecialchars($line['idAspirante'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($line['Cedula'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($line['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($line['Apellido1'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($line['Apellido2'], ENT_QUOTES, 'UTF-8') . "</td>";

            $sql2 = "SELECT
                        cuestionario.idCuestionario,
                        cuestionario.Numero
                    FROM
                        cuestionario
                    WHERE
                        cuestionario.Aspirante_idAspirante = :idAspirante";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(':idAspirante', $line['idAspirante'], PDO::PARAM_INT);
            $stmt2->execute();
            $cuestionarios = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            echo "<td style='text-align: center'>";
            foreach ($cuestionarios as $row) {
                echo '<a target="_blank" data-toggle="tooltip" title="Cuestionario ' . htmlspecialchars($row['Numero'], ENT_QUOTES, 'UTF-8') . '" href="informeCuestionario.php?usuario=' . htmlspecialchars($line['idAspirante'], ENT_QUOTES, 'UTF-8') . '&numero=' . htmlspecialchars($row['Numero'], ENT_QUOTES, 'UTF-8') . '&empresa=' . htmlspecialchars($_GET['empresa'], ENT_QUOTES, 'UTF-8') . '" class="btn btn-info btn-sm">' . htmlspecialchars($row['Numero'], ENT_QUOTES, 'UTF-8') . '</a>';
            }
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        // Opcional: maneja el caso cuando 'empresa' no está establecido
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

$pdo = null;
