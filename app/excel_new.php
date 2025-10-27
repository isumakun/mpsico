<?php
require_once 'funciones.php';

// Verificar si se debe descargar el Excel
if (isset($_GET['download']) && $_GET['download'] == 'true') {
    exportToExcel();
    exit;
}

$title = 'Exportar Excel';
require './header.php';

function exportToExcel() {
    $pdo = conectar();
    
    $sql = "SELECT 
            a.idAspirante as ID, 
            CONCAT(a.Nombre, ' ', a.Apellido1, ' ', a.Apellido2) AS Aspirante, 
            e.Nombre as 'Empresa', 
            fp.Ciudad, 
            area.Nombre as 'Area', 
            a.Cedula,
            c.*,
            fp.*, 
            ft.*
            FROM aspirante as a
            INNER JOIN fichapersonal as fp
            ON fp.Aspirante_idAspirante = a.idAspirante
            INNER JOIN fichatrabajo as ft
            ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN area
            ON area.idArea = ft.Area_idArea
            INNER JOIN empresa as e
            ON e.idEmpresa = area.Empresa_idEmpresa
            INNER JOIN cuestionario as c
            ON c.Aspirante_idAspirante = a.idAspirante
            WHERE e.idEmpresa = '{$_GET['empresa']}' AND c.Numero = '{$_GET['numero']}'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Configurar headers para descarga de Excel
    $filename = ($_GET['numero'] == 3) ? 'Reporte_Intralaboral_FORMA_A.xls' : 'Reporte_Intralaboral_FORMA_B.xls';
    
    header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    // Crear contenido HTML para Excel con encoding UTF-8
    echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
    echo '<head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
    echo '<body>';
    echo '<table border="1">';
    
    // Generar encabezados
    echo '<tr>';
    $headers = getHeaders($_GET['numero']);
    foreach ($headers as $header) {
        echo '<th>' . htmlspecialchars($header, ENT_QUOTES, 'UTF-8') . '</th>';
    }
    echo '</tr>';
    
    // Generar datos
    foreach ($rows as $line) {
        echo '<tr>';
        generateRowData($line, $pdo);
        echo '</tr>';
    }
    
    echo '</table>';
    echo '</body>';
    echo '</html>';
}

function getHeaders($numero) {
    $baseHeaders = [
        'Empresa', 'Ciudad', 'Área', 'Cédula', 'Nombre', 'Genero', 'Estado Civil', 
        'Escolaridad', 'Estrato', 'Tipo Vivienda', 'Antiguedad', 'Tipo Cargo'
    ];
    
    if ($numero == 3) {
        $dimensionHeaders = [
            'Caracteristicas Liderazgo', 'Interpretación',
            'Relaciones Sociales', 'Interpretación',
            'Retroal. Desempeño', 'Interpretación',
            'Relación colaboradores', 'Interpretación',
            'Claridad de rol', 'Interpretación',
            'Capacitación', 'Interpretación',
            'Participación y manejo del cambio', 'Interpretación',
            'Oportunidades para el desarrollo', 'Interpretación',
            'Control y autonomia sobre el trabajo', 'Interpretación',
            'Demandas ambientales y de esfuerzo fisico', 'Interpretación',
            'Demandas emocionales', 'Interpretación',
            'Demandas cuantitativas', 'Interpretación',
            'Influencia sobre el entorno extra', 'Interpretación',
            'Exigencias de responsabilidad', 'Interpretación',
            'Demandas de carga menta', 'Interpretación',
            'Consistencia de rol', 'Interpretación',
            'Demandas de jornada laboral', 'Interpretación',
            'recompensas de pertenencia y trabajo', 'Interpretación',
            'Reconocimiento y compensación', 'Interpretación'
        ];
    } else {
        $dimensionHeaders = [
            'Caracteristicas Liderazgo', 'Interpretación',
            'Relaciones Sociales', 'Interpretación',
            'Retroal. Desempeño', 'Interpretación',
            'Claridad de rol', 'Interpretación',
            'Capacitación', 'Interpretación',
            'Participación y manejo del cambio', 'Interpretación',
            'Oportunidades para el desarrollo', 'Interpretación',
            'Control y autonomia sobre el trabajo', 'Interpretación',
            'Demandas ambientales y de esfuerzo fisico', 'Interpretación',
            'Demandas emocionales', 'Interpretación',
            'Demandas cuantitativas', 'Interpretación',
            'Influencia sobre el entorno extra', 'Interpretación',
            'Demandas de carga menta', 'Interpretación',
            'Demandas de jornada laboral', 'Interpretación',
            'Recompensas de pertenencia y trabajo', 'Interpretación',
            'Reconocimiento y compensación', 'Interpretación'
        ];
    }
    
    $domainHeaders = [
        'Liderazgo y relaciones sociales en el trabajo', 'Interpretación',
        'Control sobre el trabajo', 'Interpretación',
        'Demandas del Trabajo', 'Interpretación',
        'Recompensas', 'Interpretación',
        'Total Intralaboral Forma ' . ($numero == 3 ? 'A' : 'B'), 'Interpretación'
    ];
    
    $extraHeaders = [
        'Tiempo fuera del trabajo', 'Interpretación',
        'Relaciones familiares', 'Interpretación',
        'Comunicación y relaciones interpersonales', 'Interpretación',
        'Situación económica del grupo familiar', 'Interpretación',
        'Características de la vivienda y de su entorno', 'Interpretación',
        'Influencia del entorno extralaboral sobre el trabajo', 'Interpretación',
        'Desplazamiento vivienda, trabajo, vivienda', 'Interpretación',
        'Puntaje Extralaboral', 'Interpretación',
        'Puntaje Estres', 'Interpretación'
    ];
    
    return array_merge($baseHeaders, $dimensionHeaders, $domainHeaders, $extraHeaders);
}

function generateRowData($line, $pdo) {
    // Datos básicos
    $basicData = [
        $line['Empresa'],
        $line['Ciudad'],
        $line['Area'],
        $line['Cedula'],
        $line['Aspirante'],
        $line['Sexo'],
        $line['EstadoCivil'],
        $line['NivelEstudios'],
        $line['Estrato'],
        $line['Vivienda'],
        $line['Tiempo'],
        $line['TipoCargo']
    ];
    
    foreach ($basicData as $data) {
        echo '<td>' . htmlspecialchars($data, ENT_QUOTES, 'UTF-8') . '</td>';
    }
    
    // Obtener dimensiones
    $sql2 = "SELECT dimension.Puntaje, dimension.Valor
            FROM dimension
            INNER JOIN cuestionario
            ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
            WHERE cuestionario.Aspirante_idAspirante = " . $line['ID'] . " AND Numero = " . $_GET['numero'];
    
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    $dimensiones = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    // Generar datos de dimensiones
    $aux = 0;
    foreach ($dimensiones as $dimension) {
        if ($aux == 3 && $_GET['numero'] == 3) {
            if ($line['TipoCargo'] == 'Jefatura - tiene personal a cargo') {
                echo '<td>' . $dimension['Puntaje'] . '</td>';
                echo '<td>' . htmlspecialchars($dimension['Valor'], ENT_QUOTES, 'UTF-8') . '</td>';
            } else {
                echo '<td>N/A</td>';
                echo '<td>N/A</td>';
            }
        } else {
            echo '<td>' . $dimension['Puntaje'] . '</td>';
            echo '<td>' . htmlspecialchars($dimension['Valor'], ENT_QUOTES, 'UTF-8') . '</td>';
        }
        $aux++;
    }
    
    // Obtener dominios
    $sql3 = "SELECT dominio.Puntaje AS 'dom_pun', 
            dominio.Valor AS 'dom_val'
            FROM dominio
            INNER JOIN cuestionario
            ON (dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario)
            WHERE cuestionario.Aspirante_idAspirante = {$line['ID']} AND Numero = " . $_GET['numero'];
    
    $stmt = $pdo->prepare($sql3);
    $stmt->execute();
    $dominios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Generar datos de dominios
    foreach ($dominios as $dominio) {
        echo '<td>' . $dominio['dom_pun'] . '</td>';
        echo '<td>' . htmlspecialchars($dominio['dom_val'], ENT_QUOTES, 'UTF-8') . '</td>';
    }
    
    // PTC y BaremoPTC del cuestionario actual
    echo '<td>' . $line['PTC'] . '</td>';
    echo '<td>' . htmlspecialchars($line['BaremoPTC'], ENT_QUOTES, 'UTF-8') . '</td>';
    
    // Dimensiones extralaborales
    $dimensionesExtra = "SELECT dimension.Puntaje, dimension.Valor
            FROM dimension
            INNER JOIN cuestionario
            ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
            WHERE cuestionario.Aspirante_idAspirante = " . $line['ID'] . " AND Numero = 2";
    
    $stmt3 = $pdo->prepare($dimensionesExtra);
    $stmt3->execute();
    $dimsExtra = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($dimsExtra as $dim) {
        echo '<td>' . $dim['Puntaje'] . '</td>';
        echo '<td>' . htmlspecialchars($dim['Valor'], ENT_QUOTES, 'UTF-8') . '</td>';
    }
    
    // PTC y BaremoPTC de extralaboral y estrés
    $sql5 = "SELECT c.*
            FROM cuestionario as c
            INNER JOIN aspirante as a ON c.Aspirante_idAspirante = a.idAspirante
            WHERE a.idAspirante = {$line['ID']} AND (c.Numero = 1 OR c.Numero = 2)
            ORDER BY c.Numero DESC";
    
    $stmt4 = $pdo->prepare($sql5);
    $stmt4->execute();
    $cuestionarios = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($cuestionarios as $cuest) {
        echo '<td>' . $cuest['PTC'] . '</td>';
        echo '<td>' . htmlspecialchars($cuest['BaremoPTC'], ENT_QUOTES, 'UTF-8') . '</td>';
    }
}

// Si no es descarga, mostrar la página
if (!isset($_GET['download'])) {
    $pdo = conectar();
    $sql = "SELECT 
            a.idAspirante as ID, 
            CONCAT(a.Nombre, ' ', a.Apellido1, ' ', a.Apellido2) AS Aspirante, 
            e.Nombre as 'Empresa', 
            fp.Ciudad, 
            area.Nombre as 'Area', 
            a.Cedula,
            c.*,
            fp.*, 
            ft.*
            FROM aspirante as a
            INNER JOIN fichapersonal as fp
            ON fp.Aspirante_idAspirante = a.idAspirante
            INNER JOIN fichatrabajo as ft
            ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN area
            ON area.idArea = ft.Area_idArea
            INNER JOIN empresa as e
            ON e.idEmpresa = area.Empresa_idEmpresa
            INNER JOIN cuestionario as c
            ON c.Aspirante_idAspirante = a.idAspirante
            WHERE e.idEmpresa = '{$_GET['empresa']}' AND c.Numero = '{$_GET['numero']}'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style type="text/css">
    td,
    th {
        font-size: 12px !important;
    }
    
    .preview-table {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .export-info {
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }
</style>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-file-excel-o"></i> 
            Exportar a Excel - <?= ($_GET['numero'] == 3) ? 'Forma A' : 'Forma B' ?>
        </h3>
    </div>
    
    <div class="box-body">
        <div class="export-info">
            <h4><i class="fa fa-info-circle"></i> Información del Reporte</h4>
            <p><strong>Registros encontrados:</strong> <?= count($rows) ?></p>
            <p><strong>Tipo de cuestionario:</strong> <?= ($_GET['numero'] == 3) ? 'Intralaboral Forma A' : 'Intralaboral Forma B' ?></p>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?php if ($_GET['numero'] == 3) { ?>
                    <a href="excel_new.php?empresa=<?= $_GET['empresa'] ?>&numero=<?= $_GET['numero'] ?>&download=true" 
                       class="btn btn-success btn-lg">
                        <i class="fa fa-download"></i> Descargar Reporte Intralaboral FORMA A
                    </a>
                <?php } else { ?>
                    <a href="excel_new.php?empresa=<?= $_GET['empresa'] ?>&numero=<?= $_GET['numero'] ?>&download=true" 
                       class="btn btn-success btn-lg">
                        <i class="fa fa-download"></i> Descargar Reporte Intralaboral FORMA B
                    </a>
                <?php } ?>
                
                <a href="informeOpciones.php" class="btn btn-default btn-lg">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        
        <?php if (count($rows) > 0) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <h4>Vista Previa de Datos</h4>
                <div class="preview-table">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Ciudad</th>
                                    <th>Área</th>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Género</th>
                                    <th>Estado Civil</th>
                                    <th>Escolaridad</th>
                                    <th>Estrato</th>
                                    <th>Tipo Vivienda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($rows, 0, 10) as $line) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($line['Empresa']) ?></td>
                                    <td><?= htmlspecialchars($line['Ciudad']) ?></td>
                                    <td><?= htmlspecialchars($line['Area']) ?></td>
                                    <td><?= htmlspecialchars($line['Cedula']) ?></td>
                                    <td><?= htmlspecialchars($line['Aspirante']) ?></td>
                                    <td><?= htmlspecialchars($line['Sexo']) ?></td>
                                    <td><?= htmlspecialchars($line['EstadoCivil']) ?></td>
                                    <td><?= htmlspecialchars($line['NivelEstudios']) ?></td>
                                    <td><?= htmlspecialchars($line['Estrato']) ?></td>
                                    <td><?= htmlspecialchars($line['Vivienda']) ?></td>
                                </tr>
                                <?php } ?>
                                <?php if (count($rows) > 10) { ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        <em>... y <?= count($rows) - 10 ?> registros más</em>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> 
                    No se encontraron registros para exportar con los criterios seleccionados.
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php require './footer.php'; ?>