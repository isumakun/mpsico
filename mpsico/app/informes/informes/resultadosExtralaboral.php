<?php
//require_once '../funciones.php';

$link = conectar();

$sql = "SELECT *
            FROM
            fichatrabajo
            INNER JOIN aspirante 
            ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN cuestionario 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN empresa 
            ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Numero = 2";

if ($_GET['empresa'] != 'all') {
    $sql .= " AND idEmpresa = {$_GET['empresa']}";
}

if ($_GET['area'] != 'all') {
    $sql .= " AND Area_idArea = {$_GET['area']}";
}

$sql .= " GROUP BY idFichaTrabajo";


$aspirantes = mysql_query($sql, $link);

$cantidad = mysql_num_rows($aspirantes);
//echo "cantidad aspirantes:" . $cantidad . "<br>";

$dim1 = array();
$dim2 = array();
$dim3 = array();
$dim4 = array();
$dim5 = array();
$dim6 = array();
$dim7 = array();

while ($line = mysql_fetch_array($aspirantes)) {

    $sql2 = "SELECT dimension.`Valor`
                FROM
                `dimension`
                INNER JOIN cuestionario
                    ON (`dimension`.`Cuestionario_idCuestionario` = `cuestionario`.`idCuestionario`)
                    WHERE `cuestionario`.`Aspirante_idAspirante` = " . $line['idAspirante'] . " AND `Numero` = 2";

    $valorDim = mysql_query($sql2, $link);

    array_push($dim1, mysql_result($valorDim, 0));
    array_push($dim2, mysql_result($valorDim, 1));
    array_push($dim3, mysql_result($valorDim, 2));
    array_push($dim4, mysql_result($valorDim, 3));
    array_push($dim5, mysql_result($valorDim, 4));
    array_push($dim6, mysql_result($valorDim, 5));
    array_push($dim7, mysql_result($valorDim, 6));
}

//print_r(array_count_values($dim1));

//echo calculateDimExtra();

$aux = 1;
$cont = 0;

?>
<div class="col-sm-12 col-xs-12">
    <table class="table table-bordered">
        <thead>
        <th>Dimensiones</th>
        <th colspan="2">Totales</th>
        </thead>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            echo '<tr>';

            if ($aux == 1) {
                echo '<td>Tiempo fuera del Trabajo</td>';
                echo setColorDimension($dim1, $cantidad);
            } else if ($aux == 2) {
                echo '<td>Relaciones familiares</td>';
                echo setColorDimension($dim2, $cantidad);
            } else if ($aux == 3) {
                echo '<td>Comunicación y relaciones interpersonales</td>';
                echo setColorDimension($dim3, $cantidad);
            } else if ($aux == 4) {
                echo '<td>Situación económica del grupo familiar</td>';
                echo setColorDimension($dim4, $cantidad);
            } else if ($aux == 5) {
                echo '<td>Características de la vivienda y su entorno</td>';
                echo setColorDimension($dim5, $cantidad);
            } else if ($aux == 6) {
                echo '<td>Influencia del entorno Extra laboral sobre el trabajo</td>';
                echo setColorDimension($dim6, $cantidad);
            } else if ($aux == 7) {
                echo '<td>Desplazamiento vivienda-trabajo-vivienda</td>';
                echo setColorDimension($dim7, $cantidad);
            }

            echo '</tr>';

            
            $aux++;
        }
        ?>
    </table>        
</div>
