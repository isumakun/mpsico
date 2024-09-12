<?php

$link = conectar();

// Prepare the SQL query
$sql = "SELECT *
        FROM fichatrabajo AS ft
        INNER JOIN aspirante AS a ON (ft.Aspirante_idAspirante = a.idAspirante)
        INNER JOIN cuestionario AS c ON (c.Aspirante_idAspirante = a.idAspirante)
        INNER JOIN empresa AS e ON (a.Empresa_idEmpresa = e.idEmpresa)
        INNER JOIN area AS ar ON (ar.idArea = ft.Area_idArea)
        WHERE c.Numero = 2";

$empresa = $_POST['empresa'] ?? 'all';
$area = $_POST['area'] ?? 'all';

if ($empresa !== 'all') {
    $in_empresas = implode(',', array_map('intval', $empresa));
    $sql .= " AND e.idEmpresa IN ($in_empresas)";
}

if ($area !== 'all') {
    $sql .= " AND ar.idArea = $area";
}

$sql .= " GROUP BY ft.idFichaTrabajo";

$stmt = $link->prepare($sql);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cantidad = !empty($result) ? count($result) : 0;

$dim = array_fill(1, 7, []);

foreach ($results as $line) {
    $sql2 = "SELECT dimension.Valor
             FROM dimension
             INNER JOIN cuestionario ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
             WHERE cuestionario.Aspirante_idAspirante = '{$line['idAspirante']}' AND Numero = 2";

    $stmt2 = $link->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result2 as $row) {
        $dim[count($dim)][] = $row[0];
    }
}

$aux = 1;
?>
<div class="col-sm-12 col-xs-12">
    <table class="table table-bordered">
        <thead>
            <th>Dimensiones</th>
            <th colspan="2">Totales</th>
        </thead>
        <?php
        $dim_labels = [
            1 => 'Tiempo fuera del Trabajo',
            2 => 'Relaciones familiares',
            3 => 'Comunicación y relaciones interpersonales',
            4 => 'Situación económica del grupo familiar',
            5 => 'Características de la vivienda y su entorno',
            6 => 'Influencia del entorno Extra laboral sobre el trabajo',
            7 => 'Desplazamiento vivienda-trabajo-vivienda'
        ];

        foreach ($dim_labels as $i => $label) {
            echo '<tr>';
            echo "<td>$label</td>";
            echo setColorDimension($dim[$i], $cantidad);
            echo '</tr>';
        }
        ?>
    </table>
</div>
