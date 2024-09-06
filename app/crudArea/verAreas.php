<?php

require_once 'entidades/area.php';
require_once 'funciones.php';

$pdo = conectar();

try {
    $lista = [];
    // Consulta para obtener las áreas
    $sql = "SELECT
                area.idArea,
                area.Nombre,
                area.Empresa_idEmpresa AS idEmpresa
            FROM area
            GROUP BY idArea";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($areas as $line) {
        echo '<tr>';
        echo "<td>" . htmlspecialchars($line['idArea'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";

        // Consulta para obtener el nombre de la empresa
        $sql2 = "SELECT
                    empresa.Nombre
                FROM empresa
                WHERE idEmpresa = :idEmpresa";

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':idEmpresa', $line['idEmpresa'], PDO::PARAM_INT);
        $stmt2->execute();
        $empresa = $stmt2->fetch(PDO::FETCH_ASSOC);

        echo "<td>" . htmlspecialchars($empresa['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";

        echo "<td>";
        echo '<a data-toggle="tooltip" title="Ver" href="#" onclick="verArea(' . htmlspecialchars($line["idArea"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
        echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarArea(' . htmlspecialchars($line["idArea"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
        echo '<a data-toggle="tooltip" title="Eliminar" href="crudArea/eliminarArea.php?idArea=' . htmlspecialchars($line["idArea"], ENT_QUOTES, 'UTF-8') . '" '
            . 'class="btn btn-danger btn-sm"'
            . "onclick='return confirm(\"Seguro que desea eliminar esta Area?\")';'><span class='glyphicon glyphicon-minus'></span></a>";
        echo "</td>";

        echo "</tr>";

        // Crear objeto de área y agregar a la lista
        $a = new area();
        $a->idArea = $line['idArea'];
        $a->nombre = $line['Nombre'];
        $a->idEmpresa = $line['idEmpresa'];

        $lista[] = $a;
    }

    // Codificar lista en formato JSON
    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h1></center>";
}

$pdo = null;
