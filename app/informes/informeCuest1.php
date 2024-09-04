<?php
require_once 'funciones.php';
$link = conectar();

$id = $_GET['usuario'];

$sql = "SELECT
*
FROM
    `aspirante`
    INNER JOIN `cuestionario` 
        ON (`aspirante`.`idAspirante` = `cuestionario`.`Aspirante_idAspirante`)
        WHERE `Numero` = 1
        AND aspirante.idAspirante = $id
        AND aspirante.`Empresa_idEmpresa` = {$_GET['empresa']}";

$query = mysql_query($sql, $link);


while ($line = mysql_fetch_array($query)) {
    ?>
    <div id="resultados" class="row" style="page-break-before: always">
        <div class="col-sm-12 col-xs-12">

            <div class="col-xs-12 text-center">
                <center><h5 class="uppercase"><b>Resultados del Cuestionario</h5></center>
                <div class="title-line-4 blue less-margin align-center"></div>
            </div>

            <div class="col-sm-6">
                <br>
                <label class="control-label uppercase">TOTAL GENERAL SÍNTOMAS DE ESTRÉS</label>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <label class="control-label">Puntaje <small>(transformado)</small></label>
                    <input type="text" class="form-control" disabled="" value="<?php echo $line['PTC']; ?>">
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Nivel de estrés</label>
                    <input type="text" class="form-control" disabled="" value="<?php echo $line['BaremoPTC']; ?>">
                </div>
            </div>

            <div id="interpretacion">
                <div class="col-xs-12 text-center">
                    <center><h5 class="uppercase"><b>INTERPRETACIÓN GENÉRICA DE LOS NIVELES DE ESTRÉS - TERCERA VERSIÓN</h5></center>
                    <div class="title-line-4 blue less-margin align-center"></div>
                </div>

                <div class="recuadro">
                    <p><b>- Muy bajo:</b> ausencia de síntomas de estrés u ocurrencia muy rara que no amerita desarrollar actividades de
                        intervención específicas, salvo acciones o programas de promoción en salud.<br>
                        <b>- Bajo:</b> es indicativo de baja frecuencia de síntomas de estrés y por tanto escasa afectación del estado general
                        de salud. Es pertinente desarrollar acciones o programas de intervención, a fin de mantener la baja frecuencia
                        de síntomas.<br>
                        <b>- Medio:</b> la presentación de síntomas es indicativa de una respuesta de estrés moderada. Los síntomas más
                        frecuentes y críticos ameritan observación y acciones sistemáticas de intervención para prevenir efectos
                        perjudiciales en la salud. Además, se sugiere identificar los factores de riesgo psicosocial intra y extralaboral
                        que pudieran tener alguna relación con los efectos identificados.<br>
                        <b>- Alto:</b> la cantidad de síntomas y su frecuencia de presentación es indicativa de una respuesta de estrés alto.
                        Los síntomas más críticos y frecuentes requieren intervención en el marco de un sistema de vigilancia
                        epidemiológica. Además, es muy importante identificar los factores de riesgo psicosocial intra y extralaboral
                        que pudieran tener alguna relación con los efectos identificados.<br>
                        <b>- Muy alto:</b> la cantidad de síntomas y su frecuencia de presentación es indicativa de una respuesta de estrés
                        severa y perjudicial para la salud. Los síntomas más críticos y frecuentes requieren intervención inmediata en
                        el marco de un sistema de vigilancia epidemiológica. Así mismo, es imperativo identificar los factores de
                        riesgo psicosocial intra y extralaboral que pudieran tener alguna relación con los efectos identificados.
                    </p>
                </div>
            </div>

            <div id="">
                <div class="recuadro col-sm-12">

                    <div class="col-xs-12 text-center">
                        <center><h5 class="uppercase"><b>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</h5></center>
                        <div class="title-line-4 blue less-margin align-center"></div>
                    </div>

                    <textarea id="observacion" name="observacion" class="col-sm-12 textarea"></textarea>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="row" id="recomendaciones" style="page-break-before: always">
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
                                        <button type="button" onclick="window.print();return false;" class="noprint btn btn-primary hvr-bob">Imprimir Informe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php
}

mysql_close($link);

