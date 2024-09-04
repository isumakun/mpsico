<?php

require_once 'entidades/area.php';
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT
    area.idArea
    , area.Nombre
    , area.Empresa_idEmpresa AS idEmpresa
FROM
    area
Group By idArea";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    echo '<tr>';
    echo "<td>" . $line['idArea'] . "</td>";
    echo "<td>" . $line['Nombre'] . "</td>";
    

    $sql2 = "SELECT
            empresa.Nombre
        FROM
            empresa
        Where idEmpresa = ".$line['idEmpresa'];

    $query2 = mysql_query($sql2, $link);
    
    while ($line2 = mysql_fetch_array($query2)) {
        echo "<td>" . $line2['Nombre'] . "</td>";
    }

    echo "<td>";
    echo '<a data-toggle="tooltip" title="Ver" href="#" onclick="verArea(' . $line["idArea"] . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
    echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarArea(' . $line["idArea"] . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
    echo '<a data-toggle="tooltip" title="Eliminar" href="crudArea/eliminarArea.php?idArea=' . $line["idArea"] . '" '
    . 'class="btn btn-danger btn-sm"'
    . "onclick='return confirm(\"Seguro que desea eliminar esta Area?\")';'><span class='glyphicon glyphicon-minus'></span></a>";
    echo "</td>";

    echo "</tr>";
    $a = new area();
    $a->idArea = $line['idArea'];
    $a->nombre = $line['Nombre'];
    $a->idEmpresa = $line['idEmpresa'];

    $lista[$fila] = $a;
    $fila++;
}

$json = json_encode($lista, JSON_UNESCAPED_UNICODE);
mysql_close($link);
