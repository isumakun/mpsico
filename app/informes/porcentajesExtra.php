<table class="table table-bordered">
    <tr>
        <td colspan="7"><b><center>RESULTADO DE LAS CONDICIONES EXTRALABORAL EVALUADAS</center></b></td>
    </tr>
    <tr>
        <td rowspan="2"><b><center>RESULTADO DE LAS CONDICIONES EXTRALABORAL EVALUADAS</center></b></td>
        <td colspan="5"><b><center>PORCENTAJE DE TRABAJADORES</center></b></td>
    </tr>
    <tr>
        <td><b>SIN<br>RIESGO</b></td>
        <td><b>RIESGO<br>BAJO</b></td>
        <td><b>RIESGO<br>MEDIO</b></td>
        <td><b>RIESGO<br>ALTO</b></td>
        <td><b>RIESGO<br>MUY ALTO</b></td>
    </tr>
    
    <tr>
        <td>Tiempo fuera del Trabajo</td>
        <td><?= get_numero(0, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(0, "Riesgo bajo"); ?></td>
        <td><?= get_numero(0, "Riesgo medio"); ?></td>
        <td><?= get_numero(0, "Riesgo alto"); ?></td>
        <td><?= get_numero(0, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Relaciones familiares</td>
        <td><?= get_numero(1, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(1, "Riesgo bajo"); ?></td>
        <td><?= get_numero(1, "Riesgo medio"); ?></td>
        <td><?= get_numero(1, "Riesgo alto"); ?></td>
        <td><?= get_numero(1, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Comunicación y relaciones interpersonales</td>
        <td><?= get_numero(2, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(2, "Riesgo bajo"); ?></td>
        <td><?= get_numero(2, "Riesgo medio"); ?></td>
        <td><?= get_numero(2, "Riesgo alto"); ?></td>
        <td><?= get_numero(2, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Situación económica del grupo familiar</td>
        <td><?= get_numero(3, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(3, "Riesgo bajo"); ?></td>
        <td><?= get_numero(3, "Riesgo medio"); ?></td>
        <td><?= get_numero(3, "Riesgo alto"); ?></td>
        <td><?= get_numero(3, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Características de la vivienda y su entorno</td>
        <td><?= get_numero(4, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(4, "Riesgo bajo"); ?></td>
        <td><?= get_numero(4, "Riesgo medio"); ?></td>
        <td><?= get_numero(4, "Riesgo alto"); ?></td>
        <td><?= get_numero(4, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Influencia del entorno Extra laboral sobre el trabajo</td>
        <td><?= get_numero(5, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(5, "Riesgo bajo"); ?></td>
        <td><?= get_numero(5, "Riesgo medio"); ?></td>
        <td><?= get_numero(5, "Riesgo alto"); ?></td>
        <td><?= get_numero(5, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Desplazamiento vivienda-trabajo-vivienda</td>
        <td><?= get_numero(6, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?= get_numero(6, "Riesgo bajo"); ?></td>
        <td><?= get_numero(6, "Riesgo medio"); ?></td>
        <td><?= get_numero(6, "Riesgo alto"); ?></td>
        <td><?= get_numero(6, "Riesgo muy alto"); ?></td>
    </tr>
</table>

<?php

function get_numero($pos, $baremo) {
    $link = conectar();

    $sql = "SELECT *
            FROM fichatrabajo AS ft
            INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE c.Numero = 2";

    if ($_POST['empresa'] != 'all') {
        $sql .= " AND (";
        $placeholders = [];
        $empresa_params = [];
        foreach ($_POST['empresa'] as $index => $empresa) {
            $placeholders[] = ":empresa_$index";
            $empresa_params[":empresa_$index"] = $empresa;
        }
        $sql .= "e.idEmpresa IN (" . implode(',', $placeholders) . "))";
    }

    if ($_POST['area'] != 'all') {
        $sql .= " AND ar.idArea = :area";
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    $stmt = $link->prepare($sql);

    if ($_POST['empresa'] != 'all') {
        foreach ($empresa_params as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value, PDO::PARAM_INT);
        }
    }
    if ($_POST['area'] != 'all') {
        $stmt->bindValue(':area', $_POST['area'], PDO::PARAM_INT);
    }

    $stmt->execute();
    $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cantidad = count($aspirantes);
    $count = 0;

    foreach ($aspirantes as $line) {
        $sql3 = "SELECT dimension.Valor
                 FROM dimension
                 INNER JOIN cuestionario ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario
                 WHERE cuestionario.Aspirante_idAspirante = :idAspirante AND Numero = 2";

        $stmt3 = $link->prepare($sql3);
        $stmt3->bindValue(':idAspirante', $line['idAspirante'], PDO::PARAM_INT);
        $stmt3->execute();

        $val_dim = $stmt3->fetchAll(PDO::FETCH_COLUMN);

        $aux = $val_dim[$pos] ?? null;

        if ($aux === $baremo) {
            $count++;
        }
    }

    $porcentaje = ($count * 100) / $cantidad;
    $result = round($porcentaje, 0) . "%";
    return $result;
}
