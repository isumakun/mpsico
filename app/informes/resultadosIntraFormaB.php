<?php
//require_once '../funciones.php';
$link = conectar();

$sql = "SELECT *
        FROM fichatrabajo AS ft
        INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
        INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
        INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
        INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
        WHERE c.Numero = 4 ";

if ($_POST['empresa'] != 'all') {
    $sql .= "AND e.idEmpresa IN (".implode(',', $_POST['empresa']).")";
}

if ($_POST['area'] != 'all') {
    $sql .= " AND ar.idArea = ".$_POST['area'];
}

$sql .= " GROUP BY ft.idFichaTrabajo";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cantidad = count($aspirantes);

$dimensions = array_fill(1, 16, []);

foreach ($aspirantes as $line) {
    $sql3 = "SELECT dimension.Valor
             FROM dimension
             INNER JOIN cuestionario ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario
             WHERE cuestionario.Aspirante_idAspirante = :idAspirante AND cuestionario.Numero = :numero";

    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([
        'idAspirante' => $line['idAspirante'],
        'numero' => 4
    ]);

    $values = $stmt3->fetchAll(PDO::FETCH_COLUMN);

    foreach ($values as $index => $value) {
        if (isset($dimensions[$index + 1])) {
            $dimensions[$index + 1][] = $value;
        }
    }
}

$aux = 1;
$aux2 = 1;
$cont = 0;
?>
<div class="col-sm-12 col-xs-12">
    <table class="table table-bordered">
        <thead>
        <th>Dominios</th>
        <th>Dimensiones</th>
        <th>Totales</th>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">Liderazgo y relaciones sociales en el trabajo</td>
                <td>Características del liderazgo</td>
                <?php echo setColorDimension($dim[1], $cantidad);
                    array_push($dom1, calculateDim($dim[1], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Relaciones sociales en el trabajo</td>
                <?php echo setColorDimension($dim[2], $cantidad);
                    array_push($dom1, calculateDim($dim[2], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Retroalimentación del desempeño</td>
                <?php echo setColorDimension($dim[3], $cantidad);
                    array_push($dom1, calculateDim($dim[3], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                <?php //setColorDominio($dom1, 3)?>
            </tr>
            <tr>
                <td rowspan="5">Control sobre el trabajo</td>
                <td>Claridad de rol</td>
                <?php echo setColorDimension($dim[4], $cantidad);
                    array_push($dom2, calculateDim($dim[4], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Capacitación</td>
                <?php echo setColorDimension($dim[5], $cantidad);
                    array_push($dom2, calculateDim($dim[5], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Participación y manejo del cambio</td>
                <?php echo setColorDimension($dim[6], $cantidad);
                    array_push($dom2, calculateDim($dim[6], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                <?php echo setColorDimension($dim[7], $cantidad);
                    array_push($dom2, calculateDim($dim[7], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Control y autonomía sobre el trabajo</td>
                <?php echo setColorDimension($dim[8], $cantidad);
                    array_push($dom2, calculateDim($dim[8], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                <?php //setColorDominio($dom2, 5)?>
            </tr>
            <tr>
                <td rowspan="6">Demandas del trabajo</td>
                <td>Demandas ambientales y de esfuerzo físico</td>
                <?php echo setColorDimension($dim[9], $cantidad);
                    array_push($dom3, calculateDim($dim[9], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas emocionales</td>
                <?php echo setColorDimension($dim[10], $cantidad);
                    array_push($dom3, calculateDim($dim[10], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas cuantitativas</td>
                <?php echo setColorDimension($dim[11], $cantidad);
                    array_push($dom3, calculateDim($dim[11], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Influencia del trabajo sobre el entorno extralaboral</td>
                <?php echo setColorDimension($dim[12], $cantidad);
                    array_push($dom3, calculateDim($dim[12], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de carga mental</td>
                <?php echo setColorDimension($dim[13], $cantidad);
                    array_push($dom3, calculateDim($dim[13], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de la jornada de trabajo</td>
                <?php echo setColorDimension($dim[14], $cantidad);
                    array_push($dom3, calculateDim($dim[14], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">DEMANDAS SOBRE EL TRABAJO</td>
                <?php //setColorDominio($dom3, 6)?>
            </tr>
            <tr>
                <td rowspan="2">Recompensas</td>
                <td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <?php echo setColorDimension($dim[15], $cantidad);
                    array_push($dom4, calculateDim($dim[15], $cantidad));
                ?>
            </tr>
            <tr>
                <td>Reconocimiento y compensación</td>
                <?php echo setColorDimension($dim[16], $cantidad);
                    array_push($dom4, calculateDim($dim[16], $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">RECOMPENSAS</td>
                <?php //setColorDominio($dom4, 2)?>
            </tr>
        </tbody>
    </table>        
</div>
