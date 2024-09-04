<?php

require_once 'entidades/aspirante.php';
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT
        aspirante.idAspirante
        , aspirante.Cedula
        , empresa.Nombre
        , empresa.idEmpresa
        FROM
        aspirante
        INNER JOIN empresa 
        ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa);";

$query = mysql_query($sql, $link);

$lista = array();
$fila = 0;
$n = 0;

while ($line = mysql_fetch_array($query)) {
    echo '<tr>';
    echo "<td style='text-align: center'>" . $line['idAspirante'] . "</td>";
    echo "<td style='text-align: center'>" . $line['Cedula'] . "</td>";
    echo "<td style='text-align: center'>" . $line['Nombre'] . "</td>";
    
    $sql2 = "SELECT
            aspirante.idAspirante
            , aspirante.Cedula
            , cuestionario.idCuestionario
            , cuestionario.Numero
            FROM
            cuestionario
            INNER JOIN aspirante 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            WHERE aspirante.idAspirante =".$line['idAspirante'];
    
    $query2 = mysql_query($sql2, $link);
    
    echo "<td style='text-align: center'>";
    while ($row = mysql_fetch_array($query2)) {
        echo '<a data-toggle="tooltip" title="Cuestionario '.$row['Numero'].'" href="informeCuestionario.php?usuario='.$row['idAspirante'].'&numero='.$row['Numero'].'&empresa='.$line['idEmpresa'].'" class="btn btn-info btn-sm">'.$row['Numero'].'</a>';
    }
    echo "</td>";

    echo "</tr>";
}

$json = json_encode($lista, JSON_UNESCAPED_UNICODE);
mysql_close($link);
