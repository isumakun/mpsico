<?php
require_once 'funciones.php';
$link = conectar();

$id = $_GET['usuario'];

// Preparamos la primera consulta
$sql = "SELECT *
    FROM
    cuestionario
    WHERE
    Aspirante_idAspirante = $id
    AND Numero = 2";

$stmt = $link->prepare($sql);
$stmt->execute();
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparamos la segunda consulta
$sql2 = "SELECT *
FROM
    dimension
    INNER JOIN cuestionario 
        ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
        WHERE cuestionario.Numero = 2
        AND cuestionario.Aspirante_idAspirante = $id";


$stmt2 = $link->prepare($sql2);
$stmt2->execute();
$query2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$aux = 1;

// Iteramos sobre los resultados de la primera consulta
foreach ($query as $line) {
?>
    <style>
        td, th {
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
    <div style="page-break-before: always; padding-top: 60px;" class="row">
        <div class="col-sm-12 col-xs-12" style="page-break-before: always">
            <div class="col-xs-12 text-center">
                <center>
                    <h5 class="uppercase"><b>Resultados del Cuestionario</h5>
                </center>
                <div class="title-line-4 blue less-margin align-center"></div>
            </div>

            <div class="row">
                <div>
                    <table class="table table-bordered">
                        <tr>
                            <td rowspan="2"><label class="control-label">Dimensiones</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="control-label">Puntaje <small>(transformado)</small></label>
                                <input type="text" class="form-control" disabled="" value="<?php echo $line['PTC']; ?>">
                            </td>
                            <td>
                                <label class="control-label">Nivel de riesgo</label>
                                <input type="text" class="form-control" disabled="" value="<?php echo $line['BaremoPTC']; ?>">
                            </td>
                        </tr>
                    </table>
                    <?php
// Iteramos sobre los resultados de la segunda consulta
                    echo '<table class="table table-bordered">';
                    echo '<tr><th>Descripción</th><th>Puntaje</th><th>Valor</th></tr>';
                    foreach ($query2 as $line2) {
                        echo '<tr>';
                        if ($aux == 1) {
                            echo '<td>Tiempo fuera del trabajo</td>';
                        } else if ($aux == 2) {
                            echo '<td>Relaciones familiares</td>';
                        } else if ($aux == 3) {
                            echo '<td>Comunicación y relaciones interpersonales</td>';
                        } else if ($aux == 4) {
                            echo '<td>Situación económica del grupo familiar</td>';
                        } else if ($aux == 5) {
                            echo '<td>Características de la vivienda y de su entorno</td>';
                        } else if ($aux == 6) {
                            echo '<td>Influencia del entorno extralaboral sobre el trabajo</td>';
                        } else if ($aux == 7) {
                            echo '<td>Desplazamiento vivienda – trabajo – vivienda</td>';
                        } else if ($aux == 8) {
                            echo '<td>TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL EXTRALABORAL</td>';
                        }

                        if ($aux < 8) {
                            echo '<td><input type="text" class="form-control" disabled="" value="' . $line2['Puntaje'] . '"></td>';
                            echo '<td><input type="text" class="form-control" disabled="" value="' . $line2['Valor'] . '"></td>';
                        } else {
                            echo '<td><input type="text" class="form-control" disabled="" value="' . $line2['PTC'] . '"></td>';
                            echo '<td><input type="text" class="form-control" disabled="" value="' . $line2['BaremoPTC'] . '"></td>';
                        }

                        echo '</tr>';
                        $aux++;
                    }
                    echo '</table>';
                    ?>
                </div>

                <!-- Resto del contenido de la página -->
            </div>
        </div>

    <?php
}
?>