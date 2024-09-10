<?php
require_once 'funciones.php';
$link = conectar();

// Obtener el valor de GET de forma segura
$id = $_GET['usuario'];

// Consultar cuestionario
$sql = "SELECT * FROM cuestionario WHERE Aspirante_idAspirante = :id AND Numero = 3";
$stmt = $link->prepare($sql);
$stmt->execute(['id' => $id]);

// Consultar dimensiones
$sql2 = "SELECT * FROM dimension 
    INNER JOIN cuestionario ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario 
    WHERE cuestionario.Numero = 3 AND cuestionario.Aspirante_idAspirante = :id";
$stmt2 = $link->prepare($sql2);
$stmt2->execute(['id' => $id]);

// Consultar dominios
$sql3 = "SELECT * FROM dominio 
    INNER JOIN cuestionario ON dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario 
    WHERE cuestionario.Numero = 3 AND cuestionario.Aspirante_idAspirante = :id";
$stmt3 = $link->prepare($sql3);
$stmt3->execute(['id' => $id]);

$aux = 1;
$aux2 = 1;
$cont = 0;
$dominios_puntajes = [];
$dominios_valores = [];

// Almacenar los puntajes y valores de los dominios
while ($line3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $dominios_puntajes[] = $line3['Puntaje'];
    $dominios_valores[] = $line3['Valor'];
}

// Mostrar resultados del cuestionario
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
                    while ($line2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        if ($aux == 19) break;
                        echo '<tr>';

                        // Lógica para el rowspan
                        switch ($aux2) {
                            case 1:
                                echo '<td rowspan="4">Liderazgo y relaciones sociales en el trabajo</td>';
                                break;
                            case 2:
                                echo '<td rowspan="5">Control sobre el trabajo</td>';
                                break;
                            case 3:
                                echo '<td rowspan="8">Demandas del trabajo</td>';
                                break;
                            case 4:
                                echo '<td rowspan="2">Recompensas</td>';
                                break;
                        }

                        // Lógica para las dimensiones
                        switch ($aux) {
                            case 1:
                                echo '<td>Características del liderazgo</td>';
                                $aux2 = 0;
                                break;
                            case 2:
                                echo '<td>Relaciones sociales en el trabajo</td>';
                                break;
                            case 3:
                                echo '<td>Retroalimentación del desempeño</td>';
                                break;
                            case 4:
                                echo '<td>Relación con los colaboradores (subordinados)</td>';
                                $aux2 = 2;
                                break;
                            case 5:
                                echo '<td>Claridad de rol</td>';
                                $aux2 = 0;
                                break;
                            case 6:
                                echo '<td>Capacitación</td>';
                                break;
                            case 7:
                                echo '<td>Participación y manejo del cambio</td>';
                                break;
                            case 8:
                                echo '<td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>';
                                break;
                            case 9:
                                echo '<td>Control y autonomía sobre el trabajo</td>';
                                $aux2 = 3;
                                break;
                            case 10:
                                echo '<td>Demandas ambientales y de esfuerzo físico</td>';
                                $aux2 = 0;
                                break;
                            case 11:
                                echo '<td>Demandas emocionales</td>';
                                break;
                            case 12:
                                echo '<td>Demandas cuantitativas</td>';
                                break;
                            case 13:
                                echo '<td>Influencia del trabajo sobre el entorno extralaboral</td>';
                                break;
                            case 14:
                                echo '<td>Exigencias de responsabilidad del cargo</td>';
                                break;
                            case 15:
                                echo '<td>Demandas de carga mental</td>';
                                break;
                            case 16:
                                echo '<td>Consistencia del rol</td>';
                                break;
                            case 17:
                                echo '<td>Demandas de la jornada de trabajo</td>';
                                $aux2 = 4;
                                break;
                            case 18:
                                echo '<td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>';
                                $aux2 = 0;
                                break;
                        }

                        echo '<td>' . htmlspecialchars($line2['Puntaje']) . '</td>';
                        echo '<td>' . htmlspecialchars($line2['Valor']) . '</td>';
                        echo '</tr>';

                        if ($aux == 18) {
                            echo '<tr>';
                            echo '<td>Reconocimiento y compensación</td>';
                            echo '<td>' . htmlspecialchars($line2['Puntaje']) . '</td>';
                            echo '<td>' . htmlspecialchars($line2['Valor']) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">RECOMPENSAS</td>';
                            echo '<td>' . htmlspecialchars($dominios_puntajes[$cont]) . '</td>';
                            echo '<td>' . htmlspecialchars($dominios_valores[$cont]) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL</td>';
                            echo '<td>' . htmlspecialchars($line['PTC']) . '</td>';
                            echo '<td>' . htmlspecialchars($line['BaremoPTC']) . '</td>';
                            echo '</tr>';
                        }

                        if (in_array($aux, [4, 9, 17])) {
                            $domain_label = match($aux) {
                                4 => 'LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO',
                                9 => 'CONTROL SOBRE EL TRABAJO',
                                17 => 'DEMANDAS DEL TRABAJO',
                            };
                            echo '<tr>';
                            echo "<td colspan='2'>$domain_label</td>";
                            echo '<td>' . htmlspecialchars($dominios_puntajes[$cont]) . '</td>';
                            echo '<td>' . htmlspecialchars($dominios_valores[$cont]) . '</td>';
                            echo '</tr>';
                            $cont++;
                        }

                        $aux++;
                    }
                    ?>
                </table>        
            </div>

            <!-- Interpretación genérica de los niveles de riesgo -->
            <div class="inter3">
                <div class="col-xs-12 text-center">
                    <center><h5 class="uppercase"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</h5></center>
                    <div class="title-line-4 blue less-margin align-center noprint"></div>
                </div>
                <div class="recuadro">
                    <p>
                        <b>- Sin riesgo o riesgo despreciable:</b> ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades de intervención. <br>
                        <b>- Riesgo bajo:</b> no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén relacionados con síntomas de estrés significativos. <br>
                        <b>- Riesgo medio:</b> nivel de riesgo en el que se esperaría una respuesta de estrés moderada. <br>
                        <b>- Riesgo alto:</b> nivel de riesgo con posibilidad de asociarse a respuestas de estrés alto. <br>
                        <b>- Riesgo muy alto:</b> amplia posibilidad de asociarse a respuestas muy altas de estrés.
                    </p>
                </div>
            </div>

            <!-- Observaciones y comentarios del evaluador -->
            <div class="recuadro col-sm-12">
                <div class="col-xs-12 text-center">
                    <center><h5 class="uppercase"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</h5></center>
                    <div class="title-line-4 blue less-margin align-center"></div>
                </div>
                <textarea id="observacion" name="observacion" class="form-control text-uppercase" rows="6" readonly><?= htmlspecialchars($line['Observaciones']) ?></textarea>
            </div>
        </div>
    </div>
    <?php
}
?>
