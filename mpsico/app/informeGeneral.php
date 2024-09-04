    <?php
    $title = '';
    require './header.php';
    require './funciones.php';
    error_reporting(0);
    $fichaTecnica = getFichaTecnica($_POST['empresa'], $_POST['area']);
    ?>  
    <link href="css/cuestionario.css" rel="stylesheet" media="all">
    <link href="css/informe_general.css" rel="stylesheet" media="all">

    <div class="box box-primary">
        <div class="box-header">
            <a href="informeOpciones.php" class="btn btn-default">Volver</a>
        </div>
        <div class="box-body">
            <section class="">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <center><h3><b>RESULTADOS SOCIODEMOGRAFICOS</b>
                            </h3></center>
                            <div class="title-line-4 blue less-margin align-center"></div>
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <table class="table" style="width: 100%">
                                <thead>
                                    <th></th>
                                    <th>Aspirantes</th>
                                </thead>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <?= count($fichaTecnica) ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-12">
                                <center>
                                    <div class="graphic" id="dist_genero"></div>
                                    <div class="graphic" id="dist_estado"></div>
                                    <div class="graphic" id="dist_estudios"></div>
                                    <div class="graphic" id="dist_estrato"></div>
                                </center>
                            </div>

                            <div class="col-sm-12">
                                <center>
                                    <div class="graphic" id="dist_vivienda"></div>
                                    <div class="graphic" id="dist_antiguedad"></div>
                                    <div class="graphic" id="dist_tipocargo"></div>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="row inter3" style="page-break-before: always">
                        <div class="col-xs-12 text-center" style="margin-top: 20px">
                            <center><h3><b>RESULTADOS RIESGO PSICOSOCIAL INTRALABORAL</b>
                            </h3></center>
                            <div class="title-line-4 blue less-margin align-center"></div>
                        </div>

                        <div class="col-sm-12 col-xs-12 form-group">
                            <div class="col-sm-12">
                                <center>
                                    <div id="dist_intralaboral_a"></div>
                                    <?php require './informes/resultadosIntraFormaA.php'; ?>
                                    <?php require './informes/porcentajesIntaFormaA.php'; ?>
                                    <br><br>
                                    <div id="dist_intralaboral_b"></div>
                                    <?php require './informes/resultadosIntraFormaB.php'; ?>
                                    <?php require './informes/porcentajesIntaFormaB.php'; ?>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="row inter3" style="page-break-before: always">
                        <div class="col-xs-12 text-center" style="margin-top: 20px">
                            <center><h3><b>RESULTADOS RIESGO PSICOSOCIAL EXTRALABORAL</b>
                            </h3></center>
                            <div class="title-line-4 blue less-margin align-center"></div>
                        </div>

                        <div class="col-sm-12 col-xs-12 form-group">
                            <div class="col-sm-12">
                                <center>
                                    <div class="graphic" id="dist_extralaboral"></div>
                                </center>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                require './informes/resultadosExtralaboral.php';
                                ?>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                require './informes/porcentajesExtra.php';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row inter3" style="page-break-before: always">
                        <div class="col-xs-12 text-center" style="margin-top: 20px">
                            <center><h3><b>RESULTADOS DE ÉSTRES</b>
                            </h3></center>
                            <div class="title-line-4 blue less-margin align-center"></div>
                        </div>

                        <div class="col-sm-12 col-xs-12 form-group">
                            <div class="col-sm-12">
                                <center>
                                    <div class="graphic" id="dist_estres"></div>
                                </center>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <?php require './footer.php'; ?>
        <!-- end site wraper --> 
        <script type="text/javascript">

            $(function () {
                <?php 

                $nHombres = 0;
                $nMujeres = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['Sexo']==('m')) {
                        $nHombres++;
                    }elseif ($ft['Sexo']==('f')) {
                        $nMujeres++;
                    }
                }
              ?>
                var nHombres = <?=$nHombres?>;
                var nMujeres = <?=$nMujeres?>;

                $('#dist_genero').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        width: 800,
                        height: 480,
                        type: 'pie'
                    },
                    title: {
                        text: 'Distribucion por Genero'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [{
                            name: 'Masculino ('+nHombres+')',
                            y: nHombres
                        }, {
                            name: 'Femenino ('+nMujeres+')',
                            y: nMujeres
                        }]
                    }]
                });
            });


            $(function () {
              <?php 
                $nSolteros = 0;
                $nCasados = 0;
                $nUnion = 0;
                $nDivorciados = 0;
                $nViudos = 0;
                $nSeparados = 0;
                $nSacer = 0;
                $debug = array();
                foreach ($fichaTecnica as $ft) {
                    if ($ft['EstadoCivil']==('Unión libre')) {
                        $nUnion++;
                    }elseif ($ft['EstadoCivil']==('Soltero (a)')) {
                        $nSolteros++;
                    }elseif ($ft['EstadoCivil']==('Casado (a)')) {
                        $nCasados++;
                    }elseif ($ft['EstadoCivil']==('Divorciado (a)')) {
                        $nDivorciados++;
                    }elseif ($ft['EstadoCivil']==('Viudo (a)')) {
                        $nViudos++;
                    }elseif ($ft['EstadoCivil']==('Separado (a)')) {
                        $nSeparados++;
                    }elseif ($ft['EstadoCivil']==('Sacerdote/Monja')) {
                        $nSacer++;
                    }else{
                        array_push($debug, $ft['EstadoCivil']);
                    }
                }
              ?>
               var nSolteros = <?=$nSolteros?>;
               var nCasados = <?=$nCasados?>;
               var nUnion = <?=$nUnion?>;
               var nDivorciados = <?=$nDivorciados?>;
               var nViudos = <?=$nViudos?>;
               var nSeparados = <?=$nSeparados?>;
               var nSacer = <?=$nSacer?>;

               $('#dist_estado').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    width: 800,
                    height: 480,
                    type: 'pie'
                },
                title: {
                    text: 'Distribución por estado civil'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Estados',
                    colorByPoint: true,
                    data: [{
                        name: 'Solteros (a) ('+nSolteros+')',
                        y: nSolteros
                    }, {
                        name: 'Casados (a) ('+nCasados+')',
                        y: nCasados
                    }, {
                        name: 'Unión Libre ('+nUnion+')',
                        y: nUnion
                    }, {
                        name: 'Divorciado (a) ('+nDivorciados+')',
                        y: nDivorciados
                    }, {
                        name: 'Viudo (a) ('+nViudos+')',
                        y: nViudos
                    }, {
                        name: 'Separado (a) ('+nSeparados+')',
                        y: nSeparados
                    }, {
                        name: 'Sacerdote/Monja ('+nSacer+')',
                        y: nSacer
                    }]
                }]
            });
           });

            $(function () {
                <?php 
                $PGCom = 0;
                $PGIncom = 0;
                $Militar = 0;
                $PCom = 0;
                $PIncom = 0;
                $TecCom = 0;
                $TecIncom = 0;
                $BaCom = 0;
                $BaIncom = 0;
                $PriCom = 0;
                $PriIncom = 0;
                $No = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['NivelEstudios']==('Post-grado completo')) {
                        $PGCom++;
                    }elseif ($ft['NivelEstudios']==('Post-grado incompleto')) {
                        $PGIncom++;
                    }elseif ($ft['NivelEstudios']==('Carrera Militar/policía')) {
                        $Militar++;
                    }elseif ($ft['NivelEstudios']==('Profesional completo')) {
                        $PCom++;
                    }elseif ($ft['NivelEstudios']==('Profesional incompleto')) {
                        $PIncom++;
                    }elseif ($ft['NivelEstudios']==('Técnico/Tecnólogo completo')) {
                        $TecCom++;
                    }elseif ($ft['NivelEstudios']==('Técnico/Tecnólogo incompleto')) {
                        $TecIncom++;
                    }elseif ($ft['NivelEstudios']==('Bachillerato completo')) {
                        $BaCom++;
                    }elseif ($ft['NivelEstudios']==('Bachillerato incompleto')) {
                        $BaIncom++;
                    }elseif ($ft['NivelEstudios']==('Primaria completa')) {
                        $PriCom++;
                    }elseif ($ft['NivelEstudios']==('Primaria incompleta')) {
                        $PriIncom++;
                    }elseif ($ft['NivelEstudios']==('Ninguno')) {
                        $No++;
                    }
                }
              ?>

               var PGCom = <?=$PGCom?>;
               var PGIncom = <?=$PGIncom?>;
               var Militar = <?=$Militar?>;
               var PCom = <?=$PCom?>;
               var PIncom = <?=$PIncom?>;
               var TecCom = <?=$TecCom?>;
               var TecIncom = <?=$TecIncom?>;
               var BaCom = <?=$BaCom?>;
               var BaIncom = <?=$BaIncom?>;
               var PriCom = <?=$PriCom?>;
               var PriIncom = <?=$PriIncom?>;
               var No = <?=$No?>;

               $('#dist_estudios').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    width: 800,
                    height: 480,
                    type: 'pie'
                },
                title: {
                    text: 'Distribución por escolaridad'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Estados',
                    colorByPoint: true,
                    data: [{
                        name: 'Post-grado completo ('+PGCom+')',
                        y: PGCom
                    }, {
                        name: 'Post-grado incompleto ('+PGIncom+')',
                        y: PGIncom
                    }, {
                        name: 'Carrera Militar/policía ('+Militar+')',
                        y: Militar
                    }, {
                        name: 'Profesional completo ('+PCom+')',
                        y: PCom
                    }, {
                        name: 'Profesional incompleto ('+PIncom+')',
                        y: PIncom
                    }, {
                        name: 'Técnico/Tecnólogo completo ('+TecCom+')',
                        y: TecCom
                    }, {
                        name: 'Técnico/Tecnólogo incompleto ('+TecIncom+')',
                        y: TecIncom
                    },{
                        name: 'Bachillerato completo('+BaCom+')',
                        y: BaCom
                    },{
                        name: 'Bachillerato incompleto ('+BaIncom+')',
                        y: BaIncom
                    },{
                        name: 'Primaria completa ('+PriCom+')',
                        y: PriCom
                    },{
                        name: 'Primaria incompleta ('+PriIncom+')',
                        y: PriIncom
                    },{
                        name: 'Ninguno ('+No+')',
                        y: No
                    }]
                }]
            });
           });

    $(function () {
        <?php 
                $nose = 0;
                $est1 = 0;
                $est2 = 0;
                $est3 = 0;
                $est4 = 0;
                $est5 = 0;
                $est6 = 0;
                $finca = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['Estrato']==('1')) {
                        $est1++;
                    }elseif ($ft['Estrato']==('2')) {
                        $est2++;
                    }elseif ($ft['Estrato']==('3')) {
                        $est3++;
                    }elseif ($ft['Estrato']==('4')) {
                        $est4++;
                    }elseif ($ft['Estrato']==('5')) {
                        $est5++;
                    }elseif ($ft['Estrato']==('6')) {
                        $est6++;
                    }elseif ($ft['Estrato']==('Finca')) {
                        $finca++;
                    }else{
                        $nose++;
                    }
                }
              ?>
        var est1 = <?= $est1 ?>;
        var est2 = <?= $est2 ?>;
        var est3 = <?= $est3 ?>;
        var est4 = <?= $est4 ?>;
        var est5 = <?= $est5 ?>;
        var est6 = <?= $est6 ?>;
        var estFinca = <?= $finca ?>;
        var estNo = <?= $nose ?>;

        $('#dist_estrato').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Distribución por estrato'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Estrato 1 ('+est1+')',
                    y: est1
                }, {
                    name: 'Estrato 2 ('+est2+')',
                    y: est2
                }, {
                    name: 'Estrato 3 ('+est3+')',
                    y: est3
                }, {
                    name: 'Estrato 4 ('+est4+')',
                    y: est4
                }, {
                    name: 'Estrato 5 ('+est5+')',
                    y: est5
                }, {
                    name: 'Estrato 6 ('+est6+')',
                    y: est6
                }, {
                    name: 'Finca ('+estFinca+')',
                    y: estFinca
                }, {
                    name: 'No Sabe ('+estNo+')',
                    y: estNo
                }]
            }]
        });
    });


    $(function () {
        <?php 

                $propia = 0;
                $arriendo = 0;
                $familiar = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['Vivienda']==('Propia')) {
                        $propia++;
                    }elseif ($ft['Vivienda']==('En arriendo')) {
                        $arriendo++;
                    }elseif ($ft['Vivienda']==('Familiar')) {
                        $familiar++;
                    }
                }
        ?>

        var propia = <?=$propia?>;
        var arriendo = <?=$arriendo?>;
        var familiar = <?=$familiar?>;

        $('#dist_vivienda').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Distribución por vivienda'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Propia ('+propia+')',
                    y: propia
                }, {
                    name: 'Arriendo ('+arriendo+')',
                    y: arriendo
                }, {
                    name: 'Familiar ('+familiar+')',
                    y: familiar
                }]
            }]
        });
    });

    $(function () {
        <?php 

                $menos1 = 0;
                $de1a5 = 0;
                $de5a10 = 0;
                $mas10 = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['Tiempo']==('Menos de un año')) {
                        $menos1++;
                    }elseif ($ft['Tiempo']==('De 1 a 5 años')) {
                        $de1a5++;
                    }elseif ($ft['Tiempo']==('De 5 a 10 años')) {
                        $de5a10++;
                    }else{
                        $mas10++;
                    }
                }
              ?>

        var menos1 = <?=$menos1?>;
        var de1a5 = <?=$de1a5?>;
        var de5a10 = <?=$de5a10?>;
        var mas10 = <?=$mas10?>;

        $('#dist_antiguedad').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Distribución por antiguedad'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Menos de un año ('+menos1+')',
                    y: menos1
                }, {
                    name: 'De 1 a 5 años ('+de1a5+')',
                    y: de1a5
                }, {
                    name: 'De 5 a 10 años ('+de5a10+')',
                    y: de5a10
                }, {
                    name: 'Más de 10 años ('+mas10+')',
                    y: mas10
                }]
            }]
        });
    });

    $(function () {
        <?php 

                $nJefe = 0;
                $nProfe = 0;
                $nAux = 0;
                $nOpe = 0;

                foreach ($fichaTecnica as $ft) {
                    if ($ft['TipoCargo']==('Jefatura - tiene personal a cargo')) {
                        $nJefe++;
                    }elseif ($ft['TipoCargo']==('Profesional, analista, técnico, tecnólogo')) {
                        $nProfe++;
                    }elseif ($ft['TipoCargo']==('Auxiliar, asistente administrativo, asistente técnico')) {
                        $nAux++;
                    }else{
                        $nOpe++;
                    }
                }
              ?>

        var nJefe = <?=$nJefe?>;
        var nProfe = <?=$nProfe?>;
        var nAux = <?=$nAux?>;
        var nOpe = <?=$nOpe?>;

        $('#dist_tipocargo').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Distribución por tipo de cargo'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Jefatura('+nJefe+')',
                    y: nJefe
                }, {
                    name: 'Profesional('+nProfe+')',
                    y: nProfe
                }, {
                    name: 'Auxiliar('+nAux+')',
                    y: nAux
                }, {
                    name: 'Operario ('+nOpe+')',
                    y: nOpe
                }]
            }]
        });
    });

    $(function () {
        var nMA = <?php echo getByIntralaboral('Riesgo muy alto', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nA = <?php echo getByIntralaboral('Riesgo alto', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nM = <?php echo getByIntralaboral('Riesgo medio', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nB = <?php echo getByIntralaboral('Riesgo bajo', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nMB = <?php echo getByIntralaboral('Riesgo muy bajo', $_POST['empresa'], $_POST['area'], "A") ?>;
        var NR = <?php echo getByIntralaboral('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area'], "A") ?>;

        $('#dist_intralaboral_a').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Intralaboral FORMA A'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Riesgo Muy Alto ('+nMA+')',
                    y: nMA
                }, {
                    name: 'Riesgo Alto ('+nA+')',
                    y: nA
                }, {
                    name: 'Riesgo Medio ('+nM+')',
                    y: nM
                }, {
                    name: 'Riesgo Bajo ('+nB+')',
                    y: nB
                }, {
                    name: 'Riesgo Muy Bajo ('+nMB+')',
                    y: nMB
                }, {
                    name: 'Sin riesgo o riesgo despreciable ('+NR+')',
                    y: NR
                }]
            }]
        });
    });

    $(function () {
        var nMA = <?php echo getByIntralaboral('Riesgo muy alto', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nA = <?php echo getByIntralaboral('Riesgo alto', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nM = <?php echo getByIntralaboral('Riesgo medio', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nB = <?php echo getByIntralaboral('Riesgo bajo', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nMB = <?php echo getByIntralaboral('Riesgo muy bajo', $_POST['empresa'], $_POST['area'], "B") ?>;
        var NR = <?php echo getByIntralaboral('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area'], "B") ?>;

        $('#dist_intralaboral_b').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Intralaboral FORMA B'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Riesgo Muy Alto ('+nMA+')',
                    y: nMA
                }, {
                    name: 'Riesgo Alto ('+nA+')',
                    y: nA
                }, {
                    name: 'Riesgo Medio ('+nM+')',
                    y: nM
                }, {
                    name: 'Riesgo Bajo ('+nB+')',
                    y: nB
                }, {
                    name: 'Riesgo Muy Bajo ('+nMB+')',
                    y: nMB
                }, {
                    name: 'Sin riesgo o riesgo despreciable ('+NR+')',
                    y: NR
                }]
            }]
        });
    });

    $(function () {
        var nMA = <?php echo getByExtralaboral('Riesgo muy alto', $_POST['empresa'], $_POST['area']) ?>;
        var nA = <?php echo getByExtralaboral('Riesgo alto', $_POST['empresa'], $_POST['area']) ?>;
        var nM = <?php echo getByExtralaboral('Riesgo medio', $_POST['empresa'], $_POST['area']) ?>;
        var nB = <?php echo getByExtralaboral('Riesgo bajo', $_POST['empresa'], $_POST['area']) ?>;
        var nMB = <?php echo getByExtralaboral('Riesgo muy bajo', $_POST['empresa'], $_POST['area']) ?>;
        var NR = <?php echo getByExtralaboral('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area']) ?>;

        $('#dist_extralaboral').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Extralaboral'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Riesgo Muy Alto ('+nMA+')',
                    y: nMA
                }, {
                    name: 'Riesgo Alto ('+nA+')',
                    y: nA
                }, {
                    name: 'Riesgo Medio ('+nM+')',
                    y: nM
                }, {
                    name: 'Riesgo Bajo ('+nB+')',
                    y: nB
                }, {
                    name: 'Riesgo Muy Bajo ('+nMB+')',
                    y: nMB
                }, {
                    name: 'Sin riesgo o riesgo despreciable ('+NR+')',
                    y: NR
                }]
            }]
        });
    });

    $(function () {
        var nMA = <?php echo getByEstres('Riesgo muy alto', $_POST['empresa'], $_POST['area']) ?>;
        var nA = <?php echo getByEstres('Riesgo alto', $_POST['empresa'], $_POST['area']) ?>;
        var nM = <?php echo getByEstres('Riesgo medio', $_POST['empresa'], $_POST['area']) ?>;
        var nB = <?php echo getByEstres('Riesgo bajo', $_POST['empresa'], $_POST['area']) ?>;
        var nMB = <?php echo getByEstres('Riesgo muy bajo', $_POST['empresa'], $_POST['area']) ?>;
        var NR = <?php echo getByEstres('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area']) ?>;


        $('#dist_estres').highcharts({
            chart: {
                plotBackgroundColor: null,
                width: 800,
                height: 480,
                type: 'pie'
            },
            title: {
                text: 'Puntaje total cuestionario de Evaluación para el Estrés'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Estados',
                colorByPoint: true,
                data: [{
                    name: 'Riesgo Muy Alto ('+nMA+')',
                    y: nMA
                }, {
                    name: 'Riesgo Alto ('+nA+')',
                    y: nA
                }, {
                    name: 'Riesgo Medio ('+nM+')',
                    y: nM
                }, {
                    name: 'Riesgo Bajo ('+nB+')',
                    y: nB
                }, {
                    name: 'Riesgo Muy Bajo ('+nMB+')',
                    y: nMB
                }, {
                    name: 'Sin riesgo o riesgo despreciable ('+NR+')',
                    y: NR
                }]
            }]
        });
    });

</script>

</body>
</html>
