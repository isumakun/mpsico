<?php
require_once 'funciones.php';
$link = conectar();

$id = $_GET['usuario'];

$sql = "SELECT *
    FROM
    cuestionario
    WHERE
    Aspirante_idAspirante = $id
    AND Numero = 2";

$query = mysql_query($sql, $link);

$sql2 = "SELECT *
FROM
    entrevistas.dimension
    INNER JOIN entrevistas.cuestionario 
        ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
        WHERE cuestionario.Numero = 2
        AND cuestionario.Aspirante_idAspirante = $id";

$query2 = mysql_query($sql2, $link);

$aux = 1;

while ($line = mysql_fetch_array($query)) {
    ?>
<div style="page-break-before: always; padding-top: 60px;" class="row">
        <div class="col-sm-12 col-xs-12" style="page-break-before: always">

            <div class="col-xs-12 text-center">
                <center><h5 class="uppercase"><b>Resultados del Cuestionario</h5></center>
                <div class="title-line-4 blue less-margin align-center"></div>
            </div>

            <div class="row">

                <div>
                    <div class="col-sm-6">
                        <br>
                        <label class="control-label">Dimensiones</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-6">
                            <label class="control-label">Puntaje <small>(transformado)</small></label>
                            <input type="text" class="form-control" disabled="" value="<?php echo $line['PTC']; ?>">
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Nivel de riesgo</label>
                            <input type="text" class="form-control" disabled="" value="<?php echo $line['BaremoPTC']; ?>">
                        </div>
                    </div>
                </div>
                <?php
                while ($line2 = mysql_fetch_array($query2)) {
                    echo '<div>';
                    if ($aux == 1) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Tiempo fuera del trabajo</label>
                </div>';
                    } else if ($aux == 2) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Relaciones familiares</label>
                </div>';
                    } else if ($aux == 3) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Comunicación y relaciones interpersonales</label>
                </div>';
                    } else if ($aux == 4) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Situación económica del grupo familiar</label>
                </div>';
                    } else if ($aux == 5) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Características de la vivienda y de su entorno</label>
                </div>';
                    } else if ($aux == 6) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Influencia del entorno extralaboral sobre el trabajo</label>
                </div>';
                    } else if ($aux == 7) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">Desplazamiento vivienda – trabajo – vivienda</label>
                </div>';
                    } else if ($aux == 8) {
                        echo '<div class="col-sm-6">
                    <br>
                    <label class="control-label">TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL EXTRALABORAL</label>
                </div>';
                    }

                    if ($aux < 8) {
                        echo '<div class="col-sm-6">
                    <div class="col-sm-6">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" disabled="" value="' . $line2['Puntaje'] . '">
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" disabled="" value="' . $line2['Valor'] . '">
                    </div>
                </div>';
                    } else {
                        echo '<div class="col-sm-6">
                    <div class="col-sm-6">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" disabled="" value="' . $line2['PTC'] . '">
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" disabled="" value="' . $line2['BaremoPTC'] . '">
                    </div>
                </div>';
                    }

                    echo '</div>';
                    $aux++;
                }
                ?>

            </div>

            <div style="padding-top: 10px">
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

            <div id="observaciones2">
                <div class="recuadro col-sm-12" style="page-break-before: always">

                    <div class="col-xs-12 text-center">
                        <center><h5 class="uppercase"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</h5></center>
                        <div class="title-line-4 blue less-margin align-center"></div>
                    </div>

                    <textarea id="observacion" name="observacion" class="col-sm-12 textarea"></textarea>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="recuadro col-sm-12">

                <div class="col-xs-12 text-center">
                    <center><h5 class="uppercase"><b>RECOMENDACIONES PARTICULARES</h5></center>
                    <div class="title-line-4 blue less-margin align-center"></div>
                </div>

                <textarea id="observacion" name="recomendaciones" class="col-sm-12 textarea"></textarea>

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
    <?php
}

mysql_close($link);

