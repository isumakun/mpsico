<?php
//require_once '../funciones.php';
$link = conectar();

$sql = "SELECT *
        FROM fichatrabajo AS ft
        INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
        INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
        INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
        INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
        WHERE c.Numero = :numero";

$params = ['numero' => 4];

if ($_POST['empresa'] != 'all') {
    $empresaPlaceholders = implode(',', array_fill(0, count($_POST['empresa']), '?'));
    $sql .= " AND e.idEmpresa IN ($empresaPlaceholders)";
    $params = array_merge($params, $_POST['empresa']);
}

if ($_POST['area'] != 'all') {
    $sql .= " AND ar.idArea = ?";
    $params[] = $_POST['area'];
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
                <td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                <?php //setColorDominio($dom1, 3)?>
            </tr>
            <tr>
                <td rowspan="5">Control sobre el trabajo</td>
                <td>Claridad de rol</td>
                <?php echo setColorDimension($dim4, $cantidad);
                    array_push($dom2, calculateDim($dim4, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Capacitación</td>
                <?php echo setColorDimension($dim5, $cantidad);
                    array_push($dom2, calculateDim($dim5, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Participación y manejo del cambio</td>
                <?php echo setColorDimension($dim6, $cantidad);
                    array_push($dom2, calculateDim($dim6, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
                <?php echo setColorDimension($dim7, $cantidad);
                    array_push($dom2, calculateDim($dim7, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Control y autonomía sobre el trabajo</td>
                <?php echo setColorDimension($dim8, $cantidad);
                    array_push($dom2, calculateDim($dim8, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                <?php //setColorDominio($dom2, 5)?>
            </tr>
            <tr>
                <td rowspan="6">Demandas del trabajo</td>
                <td>Demandas ambientales y de esfuerzo físico</td>
                <?php echo setColorDimension($dim9, $cantidad);
                    array_push($dom3, calculateDim($dim9, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas emocionales</td>
                <?php echo setColorDimension($dim10, $cantidad);
                    array_push($dom3, calculateDim($dim10, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas cuantitativas</td>
                <?php echo setColorDimension($dim11, $cantidad);
                    array_push($dom3, calculateDim($dim11, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Influencia del trabajo sobre el entorno extralaboral</td>
                <?php echo setColorDimension($dim12, $cantidad);
                    array_push($dom3, calculateDim($dim12, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de carga mental</td>
                <?php echo setColorDimension($dim13, $cantidad);
                    array_push($dom3, calculateDim($dim13, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Demandas de la jornada de trabajo</td>
                <?php echo setColorDimension($dim14, $cantidad);
                    array_push($dom3, calculateDim($dim14, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">DEMANDAS SOBRE EL TRABAJO</td>
                <?php //setColorDominio($dom3, 6)?>
            </tr>
            <tr>
                <td rowspan="2">Recompensas</td>
                <td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
                <?php echo setColorDimension($dim15, $cantidad);
                    array_push($dom4, calculateDim($dim15, $cantidad));
                ?>
            </tr>
            <tr>
                <td>Reconocimiento y compensación</td>
                <?php echo setColorDimension($dim16, $cantidad);
                    array_push($dom4, calculateDim($dim16, $cantidad));
                ?>
            </tr>
            <tr>
                <td colspan="2">RECOMPENSAS</td>
                <?php //setColorDominio($dom4, 2)?>
            </tr>
        </tbody>
    </table>        
</div>
