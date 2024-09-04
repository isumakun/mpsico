<?php
require_once 'funciones.php';
$link = conectar();

$id = $_GET['usuario'];

$sql = "SELECT *
    FROM
    cuestionario
    WHERE
    Aspirante_idAspirante = $id
    AND Numero = 3";

$query = mysql_query($sql, $link);

$sql2 = "SELECT *
FROM
    dimension
    INNER JOIN cuestionario 
        ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
        WHERE cuestionario.Numero = 3
        AND cuestionario.Aspirante_idAspirante = $id";

$query2 = mysql_query($sql2, $link);

$sql3 = "SELECT *
FROM
    dominio
    INNER JOIN cuestionario 
        ON (dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario)
        WHERE cuestionario.Numero = 3
        AND cuestionario.Aspirante_idAspirante = $id";

$query3 = mysql_query($sql3, $link);

$aux = 1;
$aux2 = 1;
$cont = 0;
$dominiosPuntajes = array();
$dominiosValores = array();

while ($line3 = mysql_fetch_array($query3)) {
    array_push($dominiosPuntajes, $line3['Puntaje']);
    array_push($dominiosValores, $line3['Valor']);
}

while ($line = mysql_fetch_array($query)) {
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
                    while ($line2 = mysql_fetch_array($query2)) {
                        if ($aux == 19) {
                            break;
                        }
                        echo '<tr>';
                        if ($aux2 == 1) {
                            echo '<td rowspan="4">Liderazgo y relaciones sociales en el trabajo</td>';
                        } else if ($aux2 == 2) {
                            echo '<td rowspan="5">Control sobre el trabajo</td>';
                        } else if ($aux2 == 3) {
                            echo '<td rowspan="8">Demandas del trabajo</td>';
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
                        } else if ($aux == 4) {
                            echo '<td>Relación con los colaboradores (subordinados)</td>';
                            $aux2 = 2;
                        } else if ($aux == 5) {
                            echo '<td>Claridad de rol</td>';
                            $aux2 = 0;
                        } else if ($aux == 6) {
                            echo '<td>Capacitación</td>';
                        } else if ($aux == 7) {
                            echo '<td>Participación y manejo del cambio</td>';
                        } else if ($aux == 8) {
                            echo '<td>Oportunidades para el uso y desarrollo de habilidades y conocimientos</td>';
                        } else if ($aux == 9) {
                            echo '<td>Control y autonomía sobre el trabajo</td>';
                            $aux2 = 3;
                        } else if ($aux == 10) {
                            echo '<td>Demandas ambientales y de esfuerzo físico</td>';
                            $aux2 = 0;
                        } else if ($aux == 11) {
                            echo '<td>Demandas emocionales</td>';
                        } else if ($aux == 12) {
                            echo '<td>Demandas cuantitativas</td>';
                        } else if ($aux == 13) {
                            echo '<td>Influencia del trabajo sobre el entorno extralaboral</td>';
                        } else if ($aux == 14) {
                            echo '<td>Exigencias de responsabilidad del cargo</td>';
                        } else if ($aux == 15) {
                            echo '<td>Demandas de carga mental</td>';
                        } else if ($aux == 16) {
                            echo '<td>Consistencia del rol</td>';
                        } else if ($aux == 17) {
                            echo '<td>Demandas de la jornada de trabajo</td>';
                            $aux2 = 4;
                        } else if ($aux == 18) {
                            echo '<td>Recompensas derivadas de la pertenencia a la organización y del trabajo que se realiza</td>';
                            $aux2 = 0;
                        }

                        echo '<td>' . $line2['Puntaje'] . '</td>
                          <td>' . $line2['Valor'] . '</td>';

                        echo '</tr>';

                        if ($aux == 18) {
                            echo '<tr>';
                            echo '<td>Reconocimiento y compensación</td>';

                            echo '<td>' . $line2['Puntaje'] . '</td>
                          <td>' . $line2['Valor'] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">RECOMPENSAS</td>
                            <td>' . $dominiosPuntajes[$cont] . '</td>
                            <td>' . $dominiosValores[$cont] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL</td>
                            <td>' . $line['PTC'] . '</td>
                            <td>' . $line['BaremoPTC'] . '</td>';
                            echo '</tr>';
                        }

                        if ($aux == 4) {
                            echo '<tr>';
                            echo '<td colspan="2">LIDERAZGO Y RELACIONES SOCIALES EN EL TRABAJO</td>
                            <td>' . $dominiosPuntajes[$cont] . '</td>
                            <td>' . $dominiosValores[$cont] . '</td>';
                            $cont++;
                            echo '</tr>';
                        } else if ($aux == 9) {
                            echo '<tr>';
                            echo '<td colspan="2">CONTROL SOBRE EL TRABAJO</td>
                            <td>' . $dominiosPuntajes[$cont] . '</td>
                            <td>' . $dominiosValores[$cont] . '</td>';
                            $cont++;
                            echo '</tr>';
                        } else if ($aux == 17) {
                            echo '<tr>';
                            echo '<td colspan="2">DEMANDAS DEL TRABAJO</td>
                            <td>' . $dominiosPuntajes[$cont] . '</td>
                            <td>' . $dominiosValores[$cont] . '</td>';
                            $cont++;
                            echo '</tr>';
                        }
                        $aux++;
                    }
                    ?>
                </table>        
            </div>

            <div class="inter3">
                <div class="col-xs-12 text-center">
                    <center><h5 class="uppercase"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE RIESGO</h5></center>
                    <div class="title-line-4 blue less-margin align-center noprint"></div>
                </div>

                <div class="recuadro">
                    <p><b>- Sin riesgo o riesgo despreciable:</b> ausencia de riesgo o riesgo tan bajo que no amerita desarrollar actividades
                        de intervención. Las dimensiones que se encuentren bajo esta categoría serán objeto de acciones o
                        programas de promoción.<br>
                        <b>- Riesgo bajo :</b> no se espera que los factores psicosociales que obtengan puntuaciones de este nivel estén
                        relacionados con síntomas o respuestas de estrés significativas. Las dimensiones que se encuentren bajo
                        esta categoría serán objeto de acciones o programas de intervención, a fin de mantenerlos en los niveles de
                        riesgo más bajos posibles.<br>
                        <b>- Riesgo medio:</b> nivel de riesgo en el que se esperaría una respuesta de estrés moderada. Las dimensiones
                        que se encuentren bajo esta categoría ameritan observación y acciones sistemáticas de intervención para
                        prevenir efectos perjudiciales en la salud.<br>
                        <b>- Riesgo alto:</b> nivel de riesgo que tiene una importante posibilidad de asociación con respuestas de estrés alto
                        y por tanto, las dimensiones que se encuentren bajo esta categoría requieren intervención en el marco de un
                        sistema de vigilancia epidemiológica.<br>
                        <b>- Riesgo muy alto:</b> nivel de riesgo con amplia posibilidad de asociarse a respuestas muy altas de estrés. Por
                        consiguiente las dimensiones que se encuentren bajo esta categoría requieren intervención inmediata en el
                        marco de un sistema de vigilancia epidemiológica
                    </p>
                </div>
            </div>

            <div>
                <div class="recuadro col-sm-12">

                    <div class="col-xs-12 text-center">
                        <center><h5 class="uppercase"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</h5></center>
                        <div class="title-line-4 blue less-margin align-center"></div>
                    </div>

                    <textarea id="observacion" name="observacion" class="col-sm-12 textarea2"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="recuadro col-sm-12">

                        <div class="col-xs-12 text-center">
                            <center><h5 class="uppercase"><b>RECOMENDACIONES PARTICULARES</h5></center>
                            <div class="title-line-4 blue less-margin align-center"></div>
                        </div>

                        <textarea id="observacion" name="recomendaciones" class="col-sm-12 textarea2"></textarea>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Fecha de elaboración del informe</label>
                                <input type="text" class="form-control" required="" disabled=""  name="date" id="date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary hvr-bob noprint">Guardar Informe</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" onclick="window.print();
                                            return false;" class="noprint btn btn-primary hvr-bob">Imprimir Informe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

mysql_close($link);

