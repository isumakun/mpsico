<?php

require_once 'funciones.php';

$pdo = conectar();

try {
    $empresa = $_GET['empresa'];
    if (isset($_GET['empresa'])) {
        if ($_GET['empresa'] === "all") {
            $sql = "SELECT * FROM aspirante";
        } else {
            $sql = "SELECT a.*, ar.Nombre AS area, ar.idArea AS id_area, ft.idFichaTrabajo
                    FROM aspirante a
                    LEFT JOIN fichatrabajo ft ON ft.Aspirante_idAspirante = a.idAspirante
                    LEFT JOIN area ar ON ar.idArea = ft.Area_idArea
                    WHERE a.Empresa_idEmpresa = $empresa
                    ORDER BY a.idAspirante DESC";
        }
    } else {
        $sql = "SELECT * FROM aspirante WHERE Empresa_idEmpresa = 1 ORDER BY idAspirante DESC";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_areas = "SELECT * FROM area WHERE Empresa_idEmpresa = :empresa";
    $stmt_areas = $pdo->prepare($sql_areas);
    if (isset($_GET['empresa']) && $_GET['empresa'] !== "all") {
        $stmt_areas->bindParam(':empresa', $_GET['empresa'], PDO::PARAM_INT);
    } else {
        // Fallback for 'all' or no 'empresa' parameter
        $stmt_areas->bindValue(':empresa', 1, PDO::PARAM_INT);
    }
    $stmt_areas->execute();
    $areas = $stmt_areas->fetchAll(PDO::FETCH_ASSOC);

    echo '<table id="tabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido 1</th>
                    <th>Apellido 2</th>
                    <th>Email</th>
                    <th>Área</th>
                    <th>Forma</th>
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
        echo "<td>" . htmlspecialchars($line['Email'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>";
        ?>
        <select id="asp_<?= htmlspecialchars($line['idAspirante'], ENT_QUOTES, 'UTF-8') ?>" onchange="change_area(<?= htmlspecialchars($line['idAspirante'], ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($line['idFichaTrabajo'], ENT_QUOTES, 'UTF-8') ?>)">
            <?php foreach ($areas as $area) { ?>
                <option value="<?= htmlspecialchars($area['idArea'], ENT_QUOTES, 'UTF-8') ?>" <?= ($line['id_area'] == $area['idArea'] ? 'selected' : '') ?>><?= htmlspecialchars($area['Nombre'], ENT_QUOTES, 'UTF-8') ?></option>
            <?php } ?>
        </select>
        <?php
        echo "</td>";
        echo "<td>" . ($line['Forma'] == 1 ? "Forma A" : ($line['Forma'] == 2 ? "Forma B" : "-")) . "</td>";
        echo "<td>";
        echo '<a data-toggle="tooltip" title="Ver" href="javascript: verAspirante(' . htmlspecialchars($line["idAspirante"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
        echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarAspirante(' . htmlspecialchars($line["idAspirante"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
        echo '<a data-toggle="tooltip" title="Eliminar" href="crudAspirante/eliminarAspirante.php?idAspirante=' . htmlspecialchars($line["idAspirante"], ENT_QUOTES, 'UTF-8') . '" '
            . 'class="btn btn-danger btn-sm"'
            . "onclick='return confirm(\"Seguro que desea eliminar este Aspirante?\")';'><span class='glyphicon glyphicon-minus'></span></a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

$pdo = null;
