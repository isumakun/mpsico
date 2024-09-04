<?php
require_once 'funciones.php';

$link = conectar();

if(isset($_GET['empresa'])){
    if($_GET['empresa']=="all"){
        $sql = "SELECT * FROM aspirante";
    }else{
        $sql = "SELECT * FROM aspirante where Empresa_idEmpresa = {$_GET['empresa']} ORDER BY idAspirante DESC";
    }

    $query = mysql_query($sql, $link);

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

    while ($line = mysql_fetch_array($query)) {
        echo '<tr>';
        echo "<td>" . $line['idAspirante'] . "</td>";
        echo "<td>" . $line['Cedula'] . "</td>";
        echo "<td>" . $line['Nombre'] . "</td>";
        echo "<td>" . $line['Apellido1'] . "</td>";
        echo "<td>" . $line['Apellido2'] . "</td>";
       
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
            echo '<a target="_blank" data-toggle="tooltip" title="Cuestionario '.$row['Numero'].'" href="informeCuestionario.php?usuario='.$row['idAspirante'].'&numero='.$row['Numero'].'&empresa='.$_GET['empresa'].'" class="btn btn-info btn-sm">'.$row['Numero'].'</a>';
        }
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    mysql_close($link);

}else{
    
}