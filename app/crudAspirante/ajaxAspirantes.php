<?php
require_once 'funciones.php';

$link = conectar();

if(isset($_GET['empresa'])){
    if($_GET['empresa']=="all"){
        $sql = "SELECT * FROM aspirante";
    }else{
        $sql = 
        "SELECT a.*, ar.Nombre AS area, ar.idArea AS id_area , ft.idFichaTrabajo
        FROM aspirante a
        LEFT JOIN fichatrabajo ft
        ON ft.Aspirante_idAspirante = a.idAspirante
        LEFT JOIN area ar
        ON ar.idArea = ft.Area_idArea
        WHERE a.Empresa_idEmpresa = {$_GET['empresa']} 
        AND ar.Empresa_idEmpresa = {$_GET['empresa']} 
        ORDER BY a.idAspirante DESC";
    }
}else{
    $sql = "SELECT * FROM aspirante where Empresa_idEmpresa = 1 ORDER BY idAspirante DESC";
}

$query = mysql_query($sql, $link);

$sql_areas = "SELECT * FROM area
             WHERE Empresa_idEmpresa = {$_GET['empresa']} ";

$query_areas = mysql_query($sql_areas, $link);

$areas = array();
while ($row = mysql_fetch_assoc($query_areas)){
    array_push($areas, $row);
}


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

while ($line = mysql_fetch_assoc($query)) {
    echo '<tr>';
    echo "<td>" . $line['idAspirante'] . "</td>";
    echo "<td>" . $line['Cedula'] . "</td>";
    echo "<td>" . $line['Nombre'] . "</td>";
    echo "<td>" . $line['Apellido1'] . "</td>";
    echo "<td>" . $line['Apellido2'] . "</td>";
    echo "<td>" . $line['Email'] . "</td>";
    echo "<td>";
    ?>
    <select id="asp_<?=$line['idAspirante']?>" onchange="change_area(<?=$line['idAspirante']?>, <?=$line['idFichaTrabajo']?>)">
        <?php  foreach($areas AS $area){
            ?>
            <option value="<?=$area['idArea']?>" <?=($line['id_area'] == $area['idArea'] ? 'selected' : '')?>><?=$area['Nombre']?></option>
            <?php
            } ?>
    </select>
    <?php
    echo "</td>";
    if($line['Forma']==1){
        echo "<td>Forma A</td>";
    }else if($line['Forma']==2){
        echo "<td>Forma B</td>";
    }else{
        echo "<td>-</td>";
    }
    echo "<td>";
    echo '<a data-toggle="tooltip" title="Ver" href="javascript: verAspirante(' . $line["idAspirante"] . ')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
    echo '<a data-toggle="tooltip" title="Editar" href="#" onclick="editarAspirante(' . $line["idAspirante"] . ')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>';
    echo '<a data-toggle="tooltip" title="Eliminar" href="crudAspirante/eliminarAspirante.php?idAspirante=' . $line["idAspirante"] . '" '
    . 'class="btn btn-danger btn-sm"'
    . "onclick='return confirm(\"Seguro que desea eliminar este Aspirante?\")';'><span class='glyphicon glyphicon-minus'></span></a>";
    echo "</td>";

    echo "</tr>";
}

echo "</table>";

mysql_close($link);
