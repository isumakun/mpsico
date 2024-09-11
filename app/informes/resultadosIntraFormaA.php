<?php
error_reporting(E_ERROR);
ini_set('display_errors', 1);

$pdo = conectar();

$sql = "SELECT *
        FROM fichatrabajo AS ft
        INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
        INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
        INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
        INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
        WHERE c.Numero = 3 ";

if ($_POST['empresa'] != 'all') {
    $sql .= "AND e.idEmpresa IN (".implode(',', $_POST['empresa']).")";
}

if ($_POST['area'] != 'all') {
    $sql .= " AND ar.idArea = ".$_POST['area'];
}

$sql .= " GROUP BY ft.idFichaTrabajo";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cantidad = count($aspirantes);

$dom1 = array();
$dom2 = array();
$dom3 = array();
$dom4 = array();

$dimensions = array_fill(1, 19, []);

foreach ($aspirantes as $line) {
    $sql3 = "SELECT dimension.Valor
             FROM dimension
             INNER JOIN cuestionario ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario
             WHERE cuestionario.Aspirante_idAspirante = :idAspirante AND cuestionario.Numero = :numero";

    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([
        'idAspirante' => $line['idAspirante'],
        'numero' => 3
    ]);

    $values = $stmt3->fetchAll(PDO::FETCH_COLUMN);

    foreach ($values as $index => $value) {
        if (isset($dimensions[$index + 1])) {
            $dimensions[$index + 1][] = $value;
        }
    }
}

// Process or output the dimensions as needed
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
                <?php echo setColorDimension($dimensions[1], $cantidad);
                    array_push($dom1, calculateDim($dimensions[1], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Relaciones sociales en el trabajo</td>
                <?php echo setColorDimension($dimensions[2], $cantidad);
                    array_push($dom1, calculateDim($dimensions[2], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Retroalimentación del desempeño</td>
                <?php echo setColorDimension($dimensions[3], $cantidad);
                    array_push($dom1, calculateDim($dimensions[3], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Relación con los colaboradores (subordinados)</td>
                <?php echo setColorDimension($dimensions[4], $cantidad);
                    array_push($dom1, calculateDim($dimensions[4], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                <td><?php //setColorDominio($dom1, 4)?></td>
            </tr>
            <tr>
                <td rowspan="5">Control sobre el trabajo</td>
                <td>Claridad de rol</td>
                <?php echo setColorDimension($dimensions[5], $cantidad);
                    array_push($dom2, calculateDim($dimensions[5], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Capacitación</td>
                <?php echo setColorDimension($dimensions[6], $cantidad);
                    array_push($dom2, calculateDim($dimensions[6], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Participación y manejo del cambio</td>
                <?php echo setColorDimension($dimensions[7], $cantidad);
                    array_push($dom2, calculateDim($dimensions[7], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                
                <?php echo setColorDominio($dimensions[8], $cantidad);
                    array_push($dom2, calculateDim($dimensions[8], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Control y autonomía sobre el trabajo</td>
                <?php echo setColorDimension($dimensions[9], $cantidad);
                    array_push($dom2, calculateDim($dimensions[9], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                <td><?php //setColorDominio($dom2, 5)?></td>
            </tr>
            <tr>
                <td rowspan="8">Demandas del trabajo</td>
                <td>Demandas ambientales y de esfuerzo físico</td>
                <?php echo setColorDimension($dimensions[10], $cantidad);
                    array_push($dom3, calculateDim($dimensions[10], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas emocionales</td>
                <?php echo setColorDimension($dimensions[11], $cantidad);
                    array_push($dom3, calculateDim($dimensions[11], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas cuantitativas</td>
                <?php echo setColorDimension($dimensions[12], $cantidad);
                    array_push($dom3, calculateDim($dimensions[12], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Influencia del trabajo sobre el entorno extralaboral</td>
                <?php echo setColorDimension($dimensions[13], $cantidad);
                    array_push($dom3, calculateDim($dimensions[13], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Exigencias de responsabilidad del cargo</td>
                <?php echo setColorDimension($dimensions[14], $cantidad);
                    array_push($dom3, calculateDim($dimensions[14], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de carga mental</td>
                <?php echo setColorDimension($dimensions[15], $cantidad);
                    array_push($dom3, calculateDim($dimensions[15], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Consistencia del rol</td>
                <?php echo setColorDimension($dimensions[16], $cantidad);
                    array_push($dom3, calculateDim($dimensions[16], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de la jornada de trabajo</td>
                <?php echo setColorDimension($dimensions[17], $cantidad);
                    array_push($dom3, calculateDim($dimensions[17], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">DEMANDAS SOBRE EL TRABAJO</td>
                <td><?php //setColorDominio($dom3, 8)?></td>
            </tr>
            <tr>
                <td rowspan="2">Recompensas</td>
                <td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <?php echo setColorDimension($dimensions[18], $cantidad);
                    array_push($dom4, calculateDim($dimensions[18], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Reconocimiento y compensación</td>
                <?php echo setColorDimension($dimensions[19], $cantidad);
                    array_push($dom4, calculateDim($dimensions[19], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">RECOMPENSAS</td>
                <td><?php //setColorDominio($dom4, 2)?></td>
            </tr>
        </tbody>
    </table>        
</div>