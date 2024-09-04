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
        WHERE cuestionario.Numero = 3";

if ($_GET['empresa'] != 'all') {
    $sql .= " AND idEmpresa = {$_GET['empresa']}";
}

if ($_GET['area'] != 'all') {
    $sql .= " AND Area_idArea = {$_GET['area']}";
}

$sql .= " GROUP BY idFichaTrabajo";

$aspirantes = mysql_query($sql, $link);

$cantidad = mysql_num_rows($aspirantes);

$dom1 = array();
$dom2 = array();
$dom3 = array();
$dom4 = array();

$dim1 = array();
$dim2 = array();
$dim3 = array();
$dim4 = array();
$dim5 = array();
$dim6 = array();
$dim7 = array();
$dim9 = array();
$dim10 = array();
$dim11 = array();
$dim12 = array();
$dim13 = array();
$dim14 = array();
$dim15 = array();
$dim16 = array();
$dim17 = array();
$dim18 = array();
$dim19 = array();

while ($line = mysql_fetch_array($aspirantes)) {

    $sql3 = "SELECT dimension.`Valor`
                FROM
                `dimension`
                INNER JOIN cuestionario
                    ON (`dimension`.`Cuestionario_idCuestionario` = `cuestionario`.`idCuestionario`)
                    WHERE `cuestionario`.`Aspirante_idAspirante` = " . $line['idAspirante'] . " AND `Numero` = 3";

    $valorDim = mysql_query($sql3, $link);

    /*while($row = mysql_fetch_assoc($puntajeDim)){
        var_dump($row);
        echo "<br>";
    }*/

    array_push($dim1, mysql_result($valorDim, 0));
    array_push($dim2, mysql_result($valorDim, 1));
    array_push($dim3, mysql_result($valorDim, 2));
    array_push($dim4, mysql_result($valorDim, 3));
    array_push($dim5, mysql_result($valorDim, 4));
    array_push($dim6, mysql_result($valorDim, 5));
    array_push($dim7, mysql_result($valorDim, 6));
    array_push($dim8, mysql_result($valorDim, 7));
    array_push($dim9, mysql_result($valorDim, 8));
    array_push($dim10, mysql_result($valorDim, 9));
    array_push($dim11, mysql_result($valorDim, 10));
    array_push($dim12, mysql_result($valorDim, 11));
    array_push($dim13, mysql_result($valorDim, 12));
    array_push($dim14, mysql_result($valorDim, 13));
    array_push($dim15, mysql_result($valorDim, 14));
    array_push($dim16, mysql_result($valorDim, 15));
    array_push($dim17, mysql_result($valorDim, 16));
    array_push($dim18, mysql_result($valorDim, 17));
    array_push($dim19, mysql_result($valorDim, 18));
}

$aux = 1;
$aux2 = 1;
$cont = 0;
?>
<div class="col-sm-12 col-xs-12" style="page-break-before: always; padding-top: 100px">
    <table class="table table-bordered">
        <thead>
        <th>Dominios</th>
        <th>Dimensiones</th>
        <th>Totales</th>
        </thead>
        <tbody>
            <tr>
                <td rowspan="4">Liderazgo y relaciones sociales en el trabajo</td>
                <td>Características del liderazgo</td>
                <?php echo setColorDimension($dim1, $cantidad);
                    array_push($dom1, calculateDim($dim1, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Relaciones sociales en el trabajo</td>
                <?php echo setColorDimension($dim2, $cantidad);
                    array_push($dom1, calculateDim($dim2, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Retroalimentación del desempeño</td>
                <?php echo setColorDimension($dim3, $cantidad);
                    array_push($dom1, calculateDim($dim3, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Relación con los colaboradores (subordinados)</td>
                <?php echo setColorDimension($dim4, $cantidad);
                    array_push($dom1, calculateDim($dim4, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                <?php echo setColorDimension($dom1, 4)?>
            </tr>
            <tr>
                <td rowspan="5">Control sobre el trabajo</td>
                <td>Claridad de rol</td>
                <?php echo setColorDimension($dim5, $cantidad);
                    array_push($dom2, calculateDim($dim5, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Capacitación</td>
                <?php echo setColorDimension($dim6, $cantidad);
                    array_push($dom2, calculateDim($dim6, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Participación y manejo del cambio</td>
                <?php echo setColorDimension($dim7, $cantidad);
                    array_push($dom2, calculateDim($dim7, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                <?php echo setColorDimension($dim8, $cantidad);
                    array_push($dom2, calculateDim($dim8, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Control y autonomía sobre el trabajo</td>
                <?php echo setColorDimension($dim9, $cantidad);
                    array_push($dom2, calculateDim($dim9, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                <?php echo setColorDimension($dom2, 5)?>
            </tr>
            <tr>
                <td rowspan="8">Demandas del trabajo</td>
                <td>Demandas ambientales y de esfuerzo físico</td>
                <?php echo setColorDimension($dim10, $cantidad);
                    array_push($dom3, calculateDim($dim10, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas emocionales</td>
                <?php echo setColorDimension($dim11, $cantidad);
                    array_push($dom3, calculateDim($dim11, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas cuantitativas</td>
                <?php echo setColorDimension($dim12, $cantidad);
                    array_push($dom3, calculateDim($dim12, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Influencia del trabajo sobre el entorno extralaboral</td>
                <?php echo setColorDimension($dim13, $cantidad);
                    array_push($dom3, calculateDim($dim13, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Exigencias de responsabilidad del cargo</td>
                <?php echo setColorDimension($dim14, $cantidad);
                    array_push($dom3, calculateDim($dim14, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de carga mental</td>
                <?php echo setColorDimension($dim15, $cantidad);
                    array_push($dom3, calculateDim($dim15, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Consistencia del rol</td>
                <?php echo setColorDimension($dim16, $cantidad);
                    array_push($dom3, calculateDim($dim16, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de la jornada de trabajo</td>
                <?php echo setColorDimension($dim17, $cantidad);
                    array_push($dom3, calculateDim($dim17, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">DEMANDAS SOBRE EL TRABAJO</td>
                <?php echo setColorDimension($dom3, 8)?>
            </tr>
            <tr>
                <td rowspan="2">Recompensas</td>
                <td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <?php echo setColorDimension($dim18, $cantidad);
                    array_push($dom4, calculateDim($dim, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Reconocimiento y compensación</td>
                <?php echo setColorDimension($dim19, $cantidad);
                    array_push($dom4, calculateDim($dim19, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">RECOMPENSAS</td>
                <?php echo setColorDimension($dom4, 2)?>
            </tr>
        </tbody>
    </table>        
</div>
