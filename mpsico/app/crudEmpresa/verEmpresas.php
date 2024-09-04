<?php

require_once 'entidades/empresa.php';
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT * FROM empresa";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    $nombre = mb_convert_encoding($line['Nombre'], "UTF-8", "ASCII");
    echo '<tr>';
    echo "<td>" . $line['idEmpresa'] . "</td>";
    echo "<td>" . $line['Nit'] . "</td>";
    echo "<td>" . utf8_encode($line['Nombre']). "</td>";
    echo "<td>" . $line['Telefono'] . "</td>";
    echo "<td>" . $line['Sector'] . "</td>";
    echo "<td>" . $line['Ciudad'] . "</td>";
    echo "<td>";
    echo '<a data-toggle="tooltip" title="Ver" href="#" onclick="verEmpresa(' . $line["idEmpresa"] . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
    echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarEmpresa(' . $line["idEmpresa"] . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
    echo '<a data-toggle="tooltip" title="Eliminar" href="crudEmpresa/eliminarEmpresa.php?idEmpresa=' . $line["idEmpresa"] . '" '
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
mysql_close($link);
