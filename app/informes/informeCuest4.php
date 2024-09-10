<?php
require_once 'funciones.php';
$link = conectar(); // Make sure this function returns a PDO instance

$id = $_GET['usuario'];

// Prepare the first query
$sql = "SELECT * FROM cuestionario WHERE Aspirante_idAspirante = :id AND Numero = 4";
$stmt = $link->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Prepare the second query
$sql2 = "SELECT *
FROM
    dimension
    INNER JOIN cuestionario 
        ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario
WHERE cuestionario.Numero = 4
    AND cuestionario.Aspirante_idAspirante = :id";

$stmt2 = $link->prepare($sql2);
$stmt2->bindParam(':id', $id, PDO::PARAM_INT);
$stmt2->execute();

// Prepare the third query
$sql3 = "SELECT *
FROM
    dominio
    INNER JOIN cuestionario 
        ON dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario
WHERE cuestionario.Numero = 4
    AND cuestionario.Aspirante_idAspirante = :id";

$stmt3 = $link->prepare($sql3);
$stmt3->bindParam(':id', $id, PDO::PARAM_INT);
$stmt3->execute();

// Initialize variables
$aux = 1;
$aux2 = 1;
$cont = 0;
$dominiosPuntajes = [];
$dominiosValores = [];

// Fetch the results of the third query
while ($line3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    array_push($dominiosPuntajes, $line3['Puntaje']);
    array_push($dominiosValores, $line3['Valor']);
}

// Fetch the results of the first query
while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div id="resultados" class="row">
        <div class="col-sm-12 col-xs-12">

            <div class="col-xs-12 text-center">
                <center><h5 class="uppercase"><b>Resultados del Cuestionario</h5></center>
                <div class="title-line-4 blue less-margin align-center"></div>
            </div>

            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <th>Dominios</th>
                    <th>Dimensiones</th>
                    <th>Puntaje <small>(transformado)</small></th>
                    <th>Nivel de riesgo</th>
                    </thead>
                    <?php
                    // Fetch the results of the second query
                    while ($line2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        if ($aux2 == 1) {
                            echo '<td rowspan="3">Liderazgo y relaciones sociales en el trabajo</td>';
                        } else if ($aux2 == 2) {
                            echo '<td rowspan="5">Control sobre el trabajo</td>';
                        } else if ($aux2 == 3) {
                            echo '<td rowspan="6">Demandas del trabajo</td>';
                        } else if ($aux2 == 4) {
                            echo '<td rowspan="2">Recompensas</td>';
                        }

                        if ($aux == 1) {
                            echo '<td>Características del liderazgo</td>';
                            $aux2 = 0;
                        } else if ($aux == 2) {
                            echo '<td>Relaciones sociales en el trabajo</td>';
                        } else if ($aux == 3) {
                            echo '<td>Retroalimentación del desempeño</td>';
                            $aux2 = 2;
                        } else if ($aux == 4) {
                            echo '<td>Claridad de rol</td>';
                            $aux2 = 0;
                        } else if ($aux == 5) {
                            echo '<td>Capacitación</td>';
                        } else if ($aux == 6) {
                            echo '<td>Participación y manejo del cambio</td>';
                        } else if ($aux == 7) {
                            echo '<td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>';
                        } else if ($aux == 8) {
                            echo '<td>Control y autonomía sobre el trabajo</td>';
                            $aux2 = 3;
                        } else if ($aux == 9) {
                            echo '<td>Demandas ambientales y de esfuerzo físico</td>';
                            $aux2 = 0;
                        } else if ($aux == 10) {
                            echo '<td>Demandas emocionales</td>';
                        } else if ($aux == 11) {
                            echo '<td>Demandas cuantitativas</td>';
                        } else if ($aux == 12) {
                            echo '<td>Influencia del trabajo sobre el entorno extralaboral</td>';
                        } else if ($aux == 13) {
                            echo '<td>Demandas de carga mental</td>';
                        } else if ($aux == 14) {
                            echo '<td>Demandas de la jornada de trabajo</td>';
                            $aux2 = 4;
                        } else if ($aux == 15) {
                            echo '<td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>';
                            $aux2 = 0;
                        } else if ($aux == 16) {
                            echo '<td>Reconocimiento y compensación</td>';
                        }

                        echo '<td>' . htmlspecialchars($line2['Puntaje']) . '</td>
                              <td>' . htmlspecialchars($line2['Valor']) . '</td>';

                        echo '</tr>';

                        if ($aux == 16) {
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">RECOMPENSAS</td>
                            <td>' . htmlspecialchars($dominiosPuntajes[$cont]) . '</td>
                            <td>' . htmlspecialchars($dominiosValores[$cont]) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL</td>
                            <td>' . htmlspecialchars($line['PTC']) . '</td>
                            <td>' . htmlspecialchars($line['BaremoPTC']) . '</td>';
                            echo '</tr>';
                        }

                        if ($aux == 3) {
                            echo '<tr>';
                            echo '<td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                            <td>' . htmlspecialchars($dominiosPuntajes[$cont]) . '</td>
                            <td>' . htmlspecialchars($dominiosValores[$cont]) . '</td>';
                            $cont++;
                            echo '</tr>';
                        } else if ($aux == 8) {
                            echo '<tr>';
                            echo '<td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                            <td>' . htmlspecialchars($dominiosPuntajes[$cont]) . '</td>
                            <td>' . htmlspecialchars($dominiosValores[$cont]) . '</td>';
                            $cont++;
                            echo '</tr>';
                        } else if ($aux == 14) {
                            echo '<tr>';
                            echo '<td colspan="2">DEMANDAS DEL TRABAJO</td>
                            <td>' . htmlspecialchars($dominiosPuntajes[$cont]) . '</td>
                            <td>' . htmlspecialchars($dominiosValores[$cont]) . '</td>';
                            $cont++;
                            echo '</tr>';
                        }
                        $aux++;
                    }
                    ?>
                </table>        
            </div>

            <!-- The rest of the HTML structure remains unchanged -->

        </div>
    </div>
    <?php
}

// Close the connection
$link = null;
?>
