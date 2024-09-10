<?php
$title = '';
require './header.php';
require './funciones.php';
error_reporting(E_ALL);
?>
<style type="text/css" media="print">
    @page {
        size: auto;
        /* auto is the initial value */
        margin-top: 0mm;
        margin-bottom: 0mm;
        /* this affects the margin in the printer settings */
    }

    @media print {

        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12 {
            float: left;
        }

        .col-sm-12 {
            width: 100%;
        }

        .col-sm-11 {
            width: 91.66666666666666%;
        }

        .col-sm-10 {
            width: 83.33333333333334%;
        }

        .col-sm-9 {
            width: 75%;
        }

        .col-sm-8 {
            width: 66.66666666666666%;
        }

        .col-sm-7 {
            width: 58.333333333333336%;
        }

        .col-sm-6 {
            width: 50%;
        }

        .col-sm-5 {
            width: 41.66666666666667%;
        }

        .col-sm-4 {
            width: 33.33333333333333%;
        }

        .col-sm-3 {
            width: 25%;
        }

        .col-sm-2 {
            width: 16.666666666666664%;
        }

        .col-sm-1 {
            width: 8.333333333333332%;
        }

        body {
            background-color: #FFFFFF;
            background-image: none;
            color: #000000;
            font-size: 10px
        }

        #footer {
            display: none;
        }

        #header {
            display: none;
        }

        #resultados {
            padding-top: 60px
        }

        #interpretacion {
            padding-top: 60px !important;
        }

        #recomendaciones {
            padding-top: 20px
        }

        .noprint {
            display: none
        }

        .sec-padding {
            padding: 0px 0 20px 0;
        }

        .title-line-4 {
            width: 34px;
            height: 2px;
            float: left;
            padding: 0px;
            margin: 0 auto 60px auto;
            background-color: #161616;
        }

        h5 {
            font-size: 12px !important;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .form-group {
            padding-bottom: 5px;
        }

        .form-control {
            font-size: 10px;
        }

        #resultados3 {
            padding-top: 30px;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 6px;
            line-height: 1;
        }
    .feature-box-86 {
        background-color: #3fc35f !important;
    }

    .bg-color-light {
        background-color: #4ece6d !important;
    }

    .btn {
        padding: 5px 10px;
    }

    .div-center {
        margin: auto;
        width: 40%;
    }

    .header-inner.two {
        height: 130px;
    }

    .header-inner .title {
        padding: 40px 0 0 0;
    }

    .red-font {
        color: red;
        font-weight: bold;
    }

    #interpretacion {
        padding-top: 160px !important;
    }

    .sec-padding {
        padding: 50px 0 80px 0;
    }

    .recuadro {
        border: 2px solid #000000;
        text-align: justify;
        padding: 10px;
        font-weight: normal;
    }

    .textarea {
        height: 200px;
    }

    .textarea2 {
        height: 150px;
    }

    .padding-up {
        padding-top: 50px;
    }
</style>

<div class="box box-primary">
    <div class="box-header">
    </div>
    <div class="box-body">
        <form id="form" method="POST" enctype="multipart/form-data" action="informes/insertarInforme.php">
            <div class="row">
                <input hidden="" name="numero" value="<?php echo $_GET['numero']; ?>" />
                <div class="col-xs-12 text-center">
                    <center>
                        <h5>
                            <?php
                                if($_GET['numero']==1){
                                    echo '<b>INFORME DE RESULTADOS DEL CUESTIONARIO PARA LA EVALUACIÓN
                                        <br> DEL ESTRÉS - TERCERA VERSIÓN</b>';
                                }else if($_GET['numero']==2){
                                    echo '<b>CUESTIONARIO DE FACTORES PSICOSOCIALES
                                                    <br> EXTRALABORALES</b>';
                                }else if($_GET['numero']==3){
                                    echo '<b>CUESTIONARIO DE FACTORES PSICOSOCIALES
                                            <br> INTRALABORALES FORMA A</b>';
                                }else if($_GET['numero']==4){
                                    echo '<b>CUESTIONARIO DE FACTORES PSICOSOCIALES
                                            <br> INTRALABORALES FORMA B</b>';
                                }
                                    ?>
                        </h5>
                    </center>
                    <div class="title-line-4 blue less-margin align-center"></div>
                </div>

                <?php require_once './informes/getInfo.php'; ?>

                <div class="col-sm-12 col-xs-12">

                    <div class="col-xs-12 text-center">
                        <center>
                            <h5 class="uppercase"><b>Datos del Evaluador</h5>
                        </center>
                        <div class="title-line-4 blue less-margin align-center"></div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="inputDefault">Nombre del Evaluador</label>
                            <input type="text" class="form-control" required="" name="nombreEva" id="nombreEva">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">No. Identificación (C.C.)</label>
                            <input type="text" class="form-control" required="" name="cedulaEva" id="cedulaEva">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">Profesion</label>
                            <input type="text" class="form-control" required="" name="profesionEva" id="profesionEva">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">Posgrado</label>
                            <input type="text" class="form-control" required="" name="posgradoEva" id="posgradoEva">
                        </div>
                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">No. Tarjeta Profesional</label>
                            <input type="text" class="form-control" required="" name="noTarjeta" id="noTarjeta">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">No. Licencia Salud Ocupaiconal</label>
                            <input type="text" class="form-control" required="" name="noLicencia" id="noLicencia">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault">Fecha de expedición de la licencia en salud
                                ocupacional*:</label>
                            <input type="date" class="form-control" required="" name="fechaExp" id="fechaExp">
                        </div>
                    </div>

                </div>

            </div>

            <?php
                if (isset($_GET['numero'])) {
                    if ($_GET['numero'] == 1) {
                        require './informes/informeCuest1.php';
                    } else if ($_GET['numero'] == 2) {
                        require './informes/informeCuest2.php';
                    } else if ($_GET['numero'] == 3) {
                        require './informes/informeCuest3.php';
                    } else if ($_GET['numero'] == 4) {
                        require './informes/informeCuest4.php';
                    }
                }
            ?>
            </section>
        </form>

    </div>
</div>

<!-- end section -->
<div class="clearfix"></div>
<?php require './footer.php'; ?>
</div>
<!-- end site wraper -->

<script type="text/javascript">
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!

var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}
var today = dd + '/' + mm + '/' + yyyy;
document.getElementById("date").value = today;
</script>
</body>

</html>