<?php
// Verificación inicial de datos para FormaA
$pdo = conectar();
$sql_check = "SELECT COUNT(DISTINCT ft.idFichaTrabajo)
              FROM fichatrabajo AS ft
              INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
              INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
              INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
              INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
              WHERE c.Numero = 3";

if ($_POST['empresa'] != 'all') {
    $sql_check .= " AND e.idEmpresa IN (".implode(',', $_POST['empresa']).")";
}

if ($_POST['area'] != 'all') {
    $sql_check .= " AND ar.idArea = ".$_POST['area'];
}

$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute();
$count_aspirantes = $stmt_check->fetchColumn();

if ($count_aspirantes == 0) {
    // Solo mostrar mensaje si no está siendo llamado desde informeGeneral.php
    if (!isset($tieneDatos)) {
        echo '<div class="alert alert-info text-center">
                <h4>No hay datos disponibles</h4>
                <p>No se encontraron registros para los filtros seleccionados en la Forma A.</p>
              </div>';
    }
    return;
}
?>

<table class="table table-bordered table-striped table-hover">
    <thead class="bg-primary">
        <tr>
            <th colspan="6" class="text-center"><strong>RESULTADO DE LAS CONDICIONES INTRALABORALES EVALUADAS</strong></th>
        </tr>
        <tr>
            <th rowspan="2" class="text-center align-middle"><strong>RESULTADO DE LAS CONDICIONES INTRALABORALES EVALUADAS</strong></th>
            <th colspan="5" class="text-center"><strong>PORCENTAJE DE TRABAJADORES</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-info">
            <th class="text-center"><strong>SIN<br>RIESGO</strong></th>
            <th class="text-center"><strong>RIESGO<br>BAJO</strong></th>
            <th class="text-center"><strong>RIESGO<br>MEDIO</strong></th>
            <th class="text-center"><strong>RIESGO<br>ALTO</strong></th>
            <th class="text-center"><strong>RIESGO<br>MUY ALTO</strong></th>
        </tr>
        <tr class="warning">
            <td colspan="6" class="text-center"><strong>LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</strong></td>
        </tr>
        <tr>
            <td class="text-left"><strong>Características del liderazgo</strong></td>
            <td class="text-center"><?php echo getNumeroA(0, "Sin riesgo o riesgo despreciable"); ?></td>
            <td class="text-center"><?php echo getNumeroA(0, "Riesgo bajo"); ?></td>
            <td class="text-center"><?php echo getNumeroA(0, "Riesgo medio"); ?></td>
            <td class="text-center"><?php echo getNumeroA(0, "Riesgo alto"); ?></td>
            <td class="text-center"><?php echo getNumeroA(0, "Riesgo muy alto"); ?></td>
        </tr>
    <tr>
        <td>Relaciones sociales en el trabajo</td>
        <td><?php echo getNumeroA(1, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(1, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(1, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(1, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(1, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Retroalimentación del desempeño</td>
        <td><?php echo getNumeroA(2, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(2, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(2, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(2, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(2, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Relación con los colaboradores (subordinados)</td>
        <td><?php echo getNumeroA(3, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(3, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(3, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(3, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(3, "Riesgo muy alto"); ?></td>
    </tr>
    <tr><td colspan="6"><b>CONTROL SOBRE EL TRABAJO</b></td></tr>
    <tr>
        <td>Claridad de rol</td>
        <td><?php echo getNumeroA(4, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(4, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(4, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(4, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(4, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Capacitación</td>
        <td><?php echo getNumeroA(5, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(5, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(5, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(5, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(5, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Participación y manejo del cambio</td>
        <td><?php echo getNumeroA(6, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(6, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(6, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(6, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(6, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>
        <td><?php echo getNumeroA(7, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(7, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(7, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(7, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(7, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Control y autonomía sobre el trabajo</td>
        <td><?php echo getNumeroA(8, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(8, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(8, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(8, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(8, "Riesgo muy alto"); ?></td>
    </tr>
    <tr><td colspan="6"><b>DEMANDAS DEL TRABAJO</b></td></tr>
    <tr>
        <td>Demandas ambientales y de esfuerzo físico</td>
        <td><?php echo getNumeroA(9, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(9, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(9, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(9, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(9, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Demandas emocionales</td>
        <td><?php echo getNumeroA(10, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(10, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(10, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(10, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(10, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Demandas cuantitativas</td>
        <td><?php echo getNumeroA(11, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(11, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(11, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(11, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(11, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Influencia del trabajo sobre el entorno extralaboral</td>
        <td><?php echo getNumeroA(12, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(12, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(12, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(12, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(12, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Exigencias de responsabilidad del cargo</td>
        <td><?php echo getNumeroA(13, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(13, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(13, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(13, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(13, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Demandas de carga mental</td>
        <td><?php echo getNumeroA(14, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(14, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(14, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(14, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(14, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Consistencia del rol</td>
        <td><?php echo getNumeroA(15, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(15, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(15, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(15, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(15, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Demandas de la jornada de trabajo</td>
        <td><?php echo getNumeroA(16, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(16, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(16, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(16, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(16, "Riesgo muy alto"); ?></td>
    </tr>
    <tr><td colspan="6"><b>RECOMPENSAS</b></td></tr>
    <tr>
        <td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>
        <td><?php echo getNumeroA(17, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(17, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(17, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(17, "Riesgo alto"); ?></td>
        <td><?php echo getNumeroA(17, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Reconocimiento y compensación</td>
        <td><?php echo getNumeroA(18, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumeroA(18, "Riesgo bajo"); ?></td>
        <td><?php echo getNumeroA(18, "Riesgo medio"); ?></td>
        <td><?php echo getNumeroA(18, "Riesgo alto"); ?></td>
        <td class="text-center"><?php echo getNumeroA(18, "Riesgo muy alto"); ?></td>
        </tr>
    </tbody>
</table>

<?php
function get_numero_a($pos, $baremo) {
    $link = conectar();

    $sql = "SELECT *
            FROM fichatrabajo AS ft
            INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE c.Numero = 3";

    // Añadir filtros de empresa
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

    // Añadir filtro de área
    if ($_POST['area'] != 'all') {
        $sql .= " AND ar.idArea = :area";
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    $stmt = $link->prepare($sql);

    // Asignar parámetros de empresa
    if ($_POST['empresa'] != 'all') {
        foreach ($empresa_params as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value, PDO::PARAM_INT);
        }
    }
    // Asignar parámetro de área
    if ($_POST['area'] != 'all') {
        $stmt->bindValue(':area', $_POST['area'], PDO::PARAM_INT);
    }

    $stmt->execute();
    $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cantidad = count($aspirantes);
    
    // Si no hay datos, retornar mensaje
    if ($cantidad == 0) {
        return "0%";
    }
    
    $count = 0;

    // Procesar cada aspirante
    foreach ($aspirantes as $line) {
        $sql3 = "SELECT d.Valor
                 FROM dimension AS d
                 INNER JOIN cuestionario AS c ON d.Cuestionario_idCuestionario = c.idCuestionario
                 WHERE c.Aspirante_idAspirante = :idAspirante AND Numero = 3";

        $stmt3 = $link->prepare($sql3);
        $stmt3->bindValue(':idAspirante', $line['idAspirante'], PDO::PARAM_INT);
        $stmt3->execute();

        $val_dim = $stmt3->fetchAll(PDO::FETCH_COLUMN);

        // Obtener el valor de la posición deseada
        $aux = $val_dim[$pos] ?? null;

        if ($aux === $baremo) {
            $count++;
        }
    }

    $porcentaje = ($count * 100) / $cantidad;
    $result = round($porcentaje, 0) . "%";
    return $result;
}

// Función alias para compatibilidad
function getNumeroA($pos, $baremo) {
    return get_numero_a($pos, $baremo);
}
