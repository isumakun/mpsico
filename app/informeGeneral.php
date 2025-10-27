    <?php
    $title = '';
    require './header.php';
    require './funciones.php';
    error_reporting(0);
    $fichaTecnica = getFichaTecnica($_POST['empresa'], $_POST['area']);

    // Funciones para verificar la existencia de datos
    function verificarDatosFormaA($empresa, $area) {
        $pdo = conectar();
        $sql = "SELECT COUNT(DISTINCT ft.idFichaTrabajo)
                FROM fichatrabajo AS ft
                INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
                INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
                INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
                INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
                WHERE c.Numero = 3";

        if ($empresa != 'all') {
            $sql .= " AND e.idEmpresa IN (".implode(',', $empresa).")";
        }
        if ($area != 'all') {
            $sql .= " AND ar.idArea = ".$area;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    function verificarDatosFormaB($empresa, $area) {
        $pdo = conectar();
        $sql = "SELECT COUNT(DISTINCT ft.idFichaTrabajo)
                FROM fichatrabajo AS ft
                INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
                INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante
                INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
                INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
                WHERE c.Numero = 4";

        if ($empresa != 'all') {
            $sql .= " AND e.idEmpresa IN (".implode(',', $empresa).")";
        }
        if ($area != 'all') {
            $sql .= " AND ar.idArea = ".$area;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verificar si hay datos disponibles para FormaA y FormaB
    $tieneFormaA = verificarDatosFormaA($_POST['empresa'], $_POST['area']);
    $tieneFormaB = verificarDatosFormaB($_POST['empresa'], $_POST['area']);
    $tieneDatos = $tieneFormaA || $tieneFormaB;
    ?>  
    <link href="css/cuestionario.css" rel="stylesheet" media="all">
    <link href="css/informe_general.css" rel="stylesheet" media="all">

    <style>
        /* Estilos personalizados para el informe */
        .informe-section {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .informe-header {
            background: #3c8dbc;
            color: #fff;
            padding: 15px 20px;
            margin: -15px -15px 20px -15px;
            border-radius: 3px 3px 0 0;
        }

        .informe-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .table-responsive {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            border: 1px solid #ddd;
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
        }

        .table > thead > tr > th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }

        .table-striped > tbody > tr:nth-child(odd) > td,
        .table-striped > tbody > tr:nth-child(odd) > th {
            background-color: #f9f9f9;
        }

        /* Loading spinner */
        .chart-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 480px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 10px 0;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3c8dbc;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .chart-container {
            min-height: 480px;
            margin: 20px 0;
            width: 100%;
            overflow: hidden;
        }

        .no-data-message {
            background: #d9edf7;
            border: 1px solid #bce8f1;
            color: #31708f;
            border-radius: 4px;
            padding: 30px;
            text-align: center;
            margin: 20px 0;
        }

        .no-data-message h4 {
            color: #31708f;
            margin-bottom: 10px;
        }

        /* Responsive para gráficas */
        @media (max-width: 768px) {
            .chart-container {
                min-height: 300px;
            }
            
            .chart-loading {
                height: 300px;
            }
        }
        
        @media (max-width: 480px) {
            .chart-container {
                min-height: 250px;
            }
            
            .chart-loading {
                height: 250px;
            }
        }
    </style>

    <div class="box box-primary">
        <div class="box-header">
            <a href="informeOpciones.php" class="btn btn-default">Volver</a>
        </div>
        <div class="box-body">
            <section class="">
                <!-- SECCIÓN SOCIODEMOGRÁFICA -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info informe-section">
                            <div class="box-header informe-header">
                                <h3 class="box-title">
                                    <i class="fa fa-users"></i> RESULTADOS SOCIODEMOGRÁFICOS
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Descripción</th>
                                                        <th class="text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Total de Aspirantes</strong></td>
                                                        <td class="text-center">
                                                            <span class="badge bg-blue"><?= count($fichaTecnica) ?></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_genero">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_genero" style="display: none;"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_estado">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_estado" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_estudios">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_estudios" style="display: none;"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_estrato">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_estrato" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_vivienda">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_vivienda" style="display: none;"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="chart-loading" id="loading_antiguedad">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_antiguedad" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <div class="chart-loading" id="loading_tipocargo">
                                                    <div class="spinner"></div>
                                                    <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                </div>
                                                <div class="chart-container" id="dist_tipocargo" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN INTRALABORAL -->
                <div class="row" style="page-break-before: always">
                    <div class="col-xs-12">
                        <div class="box box-success informe-section">
                            <div class="box-header informe-header" style="background: #00a65a;">
                                <h3 class="box-title">
                                    <i class="fa fa-building"></i> RESULTADOS RIESGO PSICOSOCIAL INTRALABORAL
                                </h3>
                            </div>
                            <div class="box-body">
                                <?php if (!$tieneDatos): ?>
                                    <div class="no-data-message">
                                        <h4><i class="fa fa-info-circle"></i> No hay datos disponibles</h4>
                                        <p>No se encontraron registros para los filtros seleccionados en las evaluaciones intralaborales.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <?php if ($tieneFormaA): ?>
                                        <div class="col-xs-12">
                                            <div class="box box-solid">
                                                <div class="box-header" style="background: #3c8dbc; color: white;">
                                                    <h4 class="box-title">
                                                        <i class="fa fa-pie-chart"></i> FORMA A - Cuestionario Intralaboral
                                                    </h4>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="chart-loading" id="loading_intralaboral_a">
                                                                <div class="spinner"></div>
                                                                <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                            </div>
                                                            <div class="chart-container" id="dist_intralaboral_a" style="display: none;"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                                <?php require './informes/resultadosIntraFormaA.php'; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="table-responsive">
                                                                <?php require './informes/porcentajesIntaFormaA.php'; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($tieneFormaB): ?>
                                        <div class="col-xs-12">
                                            <div class="box box-solid">
                                                <div class="box-header" style="background: #dd4b39; color: white;">
                                                    <h4 class="box-title">
                                                        <i class="fa fa-pie-chart"></i> FORMA B - Cuestionario Intralaboral
                                                    </h4>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="chart-loading" id="loading_intralaboral_b">
                                                                <div class="spinner"></div>
                                                                <span style="margin-left: 10px;">Cargando gráfica...</span>
                                                            </div>
                                                            <div class="chart-container" id="dist_intralaboral_b" style="display: none;"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                                <?php require './informes/resultadosIntraFormaB.php'; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="table-responsive">
                                                                <?php require './informes/porcentajesIntaFormaB.php'; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN EXTRALABORAL -->
                <div class="row" style="page-break-before: always">
                    <div class="col-xs-12">
                        <div class="box box-warning informe-section">
                            <div class="box-header informe-header" style="background: #f39c12;">
                                <h3 class="box-title">
                                    <i class="fa fa-home"></i> RESULTADOS RIESGO PSICOSOCIAL EXTRALABORAL
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="chart-loading" id="loading_extralaboral">
                                            <div class="spinner"></div>
                                            <span style="margin-left: 10px;">Cargando gráfica...</span>
                                        </div>
                                        <div class="chart-container" id="dist_extralaboral" style="display: none;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <?php require './informes/resultadosExtralaboral.php'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <?php require './informes/porcentajesExtra.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN ESTRÉS -->
                <div class="row" style="page-break-before: always">
                    <div class="col-xs-12">
                        <div class="box box-danger informe-section">
                            <div class="box-header informe-header" style="background: #dd4b39;">
                                <h3 class="box-title">
                                    <i class="fa fa-exclamation-triangle"></i> RESULTADOS DE ESTRÉS
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="chart-loading" id="loading_estres">
                                            <div class="spinner"></div>
                                            <span style="margin-left: 10px;">Cargando gráfica...</span>
                                        </div>
                                        <div class="chart-container" id="dist_estres" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php require './footer.php'; ?>
    <!-- end site wraper --> 
    <script type="text/javascript">
        // Función para mostrar gráfica después del loading
        function showChart(chartId, loadingId) {
            setTimeout(function() {
                $('#' + loadingId).hide();
                $('#' + chartId).show();
            }, 500);
        }

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
                        type: 'pie'
                    },
                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    },
                    title: {
                        text: 'Distribucion por Genero'
                    },
                    tooltip: {
                        useHTML: true,
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                useHTML: true,
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
                
                // Mostrar gráfica después del loading
                showChart('dist_genero', 'loading_genero');
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
                    type: 'pie'
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                },
                title: {
                    text: 'Distribución por estado civil'
                },
                tooltip: {
                    useHTML: true,
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            useHTML: true,
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
            
            // Mostrar gráfica después del loading
            showChart('dist_estado', 'loading_estado');
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
                    type: 'pie'
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                },
                title: {
                    text: 'Distribución por escolaridad'
                },
                tooltip: {
                    useHTML: true,
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            useHTML: true,
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
            
            // Mostrar gráfica después del loading
            showChart('dist_estudios', 'loading_estudios');
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Distribución por estrato'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_estrato', 'loading_estrato');
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Distribución por vivienda'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_vivienda', 'loading_vivienda');
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Distribución por antiguedad'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_antiguedad', 'loading_antiguedad');
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Distribución por tipo de cargo'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_tipocargo', 'loading_tipocargo');
    });

    $(function () {
        <?php if ($tieneFormaA): ?>
        var nMA = <?php echo getByIntralaboral('Riesgo muy alto', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nA = <?php echo getByIntralaboral('Riesgo alto', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nM = <?php echo getByIntralaboral('Riesgo medio', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nB = <?php echo getByIntralaboral('Riesgo bajo', $_POST['empresa'], $_POST['area'], "A") ?>;
        var nMB = <?php echo getByIntralaboral('Riesgo muy bajo', $_POST['empresa'], $_POST['area'], "A") ?>;
        var NR = <?php echo getByIntralaboral('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area'], "A") ?>;

        $('#dist_intralaboral_a').highcharts({
            chart: {
                plotBackgroundColor: null,
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Intralaboral FORMA A'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
                    name: 'Sin riesgo o <br> riesgo despreciable ('+NR+')',
                    y: NR
                }]
            }]
        });
        
        // Mostrar gráfica después del loading
        showChart('dist_intralaboral_a', 'loading_intralaboral_a');
        <?php endif; ?>
    });

    $(function () {
        <?php if ($tieneFormaB): ?>
        var nMA = <?php echo getByIntralaboral('Riesgo muy alto', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nA = <?php echo getByIntralaboral('Riesgo alto', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nM = <?php echo getByIntralaboral('Riesgo medio', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nB = <?php echo getByIntralaboral('Riesgo bajo', $_POST['empresa'], $_POST['area'], "B") ?>;
        var nMB = <?php echo getByIntralaboral('Riesgo muy bajo', $_POST['empresa'], $_POST['area'], "B") ?>;
        var NR = <?php echo getByIntralaboral('Sin riesgo o riesgo despreciable', $_POST['empresa'], $_POST['area'], "B") ?>;

        $('#dist_intralaboral_b').highcharts({
            chart: {
                plotBackgroundColor: null,
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Intralaboral FORMA B'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_intralaboral_b', 'loading_intralaboral_b');
        <?php endif; ?>
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Puntaje total cuestionario de Riesgo Psicosocial Extralaboral'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_extralaboral', 'loading_extralaboral');
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
                type: 'pie'
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            title: {
                text: 'Puntaje total cuestionario de Evaluación para el Estrés'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        useHTML: true,
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
        
        // Mostrar gráfica después del loading
        showChart('dist_estres', 'loading_estres');
    });

</script>

</body>
</html>
