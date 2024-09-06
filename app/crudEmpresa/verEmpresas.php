<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';

$pdo = conectar();

try {
    $sql = "SELECT * FROM empresa";
    $stmt = $pdo->query($sql);

    $lista = array();
    $fila = 0;

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $line) {
        $nombre = mb_convert_encoding($line['Nombre'], "UTF-8", "ASCII");
        
        echo '<tr>';
        echo "<td>" . htmlspecialchars($line['idEmpresa'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Nit'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Telefono'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Sector'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($line['Ciudad'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>";
        echo '<a data-toggle="tooltip" title="Ver" href="#" onclick="verEmpresa(' . htmlspecialchars($line["idEmpresa"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
        echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarEmpresa(' . htmlspecialchars($line["idEmpresa"], ENT_QUOTES, 'UTF-8') . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
        echo '<a data-toggle="tooltip" title="Eliminar" href="crudEmpresa/eliminarEmpresa.php?idEmpresa=' . htmlspecialchars($line["idEmpresa"], ENT_QUOTES, 'UTF-8') . '" '
        . 'class="btn btn-danger btn-sm"'
        . "onclick='return confirm(\"Seguro que desea eliminar esta Empresa?\")';'><span class='glyphicon glyphicon-minus'></span></a>";
        echo "</td>";
        echo "</tr>";

        $a = new empresa();
        $a->idEmpresa = $line['idEmpresa'];
        $a->nit = $line['Nit'];
        $a->nombre = $line['Nombre'];
        $a->direccion = $line['Direccion'];
        $a->telefono = $line['Telefono'];
        $a->email = $line['Email'];
        $a->sector = $line['Sector'];
        $a->ciudad = $line['Ciudad'];
        $a->logo = $line['Logo'];

        $lista[$fila] = $a;
        $fila++;
    }

    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);
    echo "<script>console.log(" . json_encode($json) . ");</script>"; // Para depuración, opcional
} catch (PDOException $e) {
    echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
}

$pdo = null;
?>
