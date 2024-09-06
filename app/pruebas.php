<?php $title = 'Pruebas'; ?>
<?php require './header.php'; 
require './funciones.php';
?>

<div class="row">
    <div class="col-lg-3 col-xs-12" id="cuestionario1">
        <a class="button" href="cuestionarios.php?c=1" <?php
        if (getCuestionarioRealizado($_SESSION['usuario'], 1)) {
            echo 'onclick="return realizado();"';
        }
        ?>>
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h4><b>Prueba 1</b></h4>

                    <p>Estres</p>
                </div>
                <div class="iconx">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <span lass="small-box-footer"></span>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-xs-12" id="cuestionario2">
        <a class="button" href="cuestionarios.php?c=2" <?php
    if (getCuestionarioRealizado($_SESSION['usuario'], 2)) {
        echo 'onclick="return realizado();"';
    }
    ?>>
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h4><b>Prueba 2</b></h4>

                    <p>Factores Extralaborales</p>
                </div>
                <div class="iconx">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <span lass="small-box-footer"></span>
            </div>
        </a>
    </div>
    <?php 
if(getForma($_SESSION['usuario'], 1)){?>
    <div class="col-lg-3 col-xs-12" id="cuestionario3">
        <a class="button" href="cuestionarios.php?c=3" <?php
    if (getCuestionarioRealizado($_SESSION['usuario'], 3)) {
        echo 'onclick="return realizado();"';
    }
    ?>>
            <div class="small-box bg-purple">
                <div class="inner">
                    <h4><b>Prueba 3</b></h4>

                    <p>Factores Intralaborales A</p>
                </div>
                <div class="iconx">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <span lass="small-box-footer"></span>
            </div>
        </a>
    </div>
    <?php }else if(getForma($_SESSION['usuario'], 2)){?>
    <div class="col-lg-3 col-xs-12" id="cuestionario4">
        <a class="button" href="cuestionarios.php?c=4" <?php
    if (getCuestionarioRealizado($_SESSION['usuario'], 4)) {
        echo 'onclick="return realizado();"';
    }
    ?>>
            <div class="small-box bg-purple">
                <div class="inner">
                    <h4><b>Prueba 3</b></h4>

                    <p>Factores Intralaborales B</p>
                </div>
                <div class="iconx">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <span lass="small-box-footer"></span>
            </div>
            <?php }?>
            <div class="clearfix"></div>
            <br />
        </a>
    </div>
</div>

<div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>RIESGO PSICOSOCIAL Y CONSENTIMIENTO</h3>
            </div>
            <div class="modal-body" style="text-align: justify">
                <p>Señor colaborador; como parte del programa de salud ocupacional, en lo referente al riesgo
                    psicosocial y haciendo cumplimiento
                    de la resolución 2646 del 17 de julio 2008, nuestra empresa le solicita a Psicocupacional, asesoría
                    y acompañamiento en una medición que
                    tiene por objeto conocer la satisfacción que tienen los colaboradores con respecto al riesgo
                    psicosocial y cuáles son los factores
                    que afectan directamente la actitud, la motivación y el desempeño de los colaboradores. <br><br>
                    Su participación es voluntaria, si usted accede a la aplicación del instrumento, se le pedirá
                    responder una encuesta. Esto tomará
                    aproximadamente 40 minutos de su tiempo.<br><br>
                    La información suministrada será confidencial y no se usará para ningún otro propósito, como tampoco
                    se tomaran ningún tipo de
                    medidas en contra de las personas que participan en esta aplicación. El propósito como ya se ha
                    mencionado es mejorar la
                    gestión del factor de riesgo psicosocial y conocer los factores que afectan directamente la actitud,
                    la motivación y el desempeño
                    de los colaboradores. <br><br>
                    Si tiene alguna duda sobre ésta encuesta, puede hacer preguntas en cualquier momento durante la
                    aplicación de la misma;
                    igualmente puede retirarse de la aplicación cuando usted lo considere sin que esto lo perjudique en
                    alguna forma. <br><br>
                    Queremos recordarle que usted esta protegido por la Constitución Nacional, Articulo 15 que reza:
                    “Todas las personas tienen
                    derecho a su intimidad personal y familiar y a su buen nombre, y el Estado debe respetarlos y
                    hacerlos respetar. De igual modo,
                    tienen derecho a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre
                    ellas en bancos de datos y en
                    archivos de entidades públicas y privadas. En la recolección, tratamiento y circulación de datos se
                    respetarán la libertad y demás
                    garantías consagradas en la Constitución...”. <br><br>
                    De acuerdo a lo anterior le agradecemos se tome el tiempo necesario para expresar de manera sincera
                    su opinión y sentimientos
                    personales con respecto a cada una de las frases que conforman el formulario.</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="insertarConsentimiento.php">
                    <a href="login.php?estado=logout" class="btn">No Aceptar</a>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<!-- end section -->
<div class="clearfix"></div>
<?php
    require './footer.php';
    ?>
</div>
<!-- end site wraper -->
<script type="text/javascript" src="js/autoNumeric.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var r = <?php echo getConsentimiento($_SESSION['usuario']); ?>;
    if (r == false) {
        $('#modal-content').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    } else if (r == true) {

    }
});

function realizado() {
    swal(
        'Espera!',
        'Ya has realizado este test!',
        'error'
    )
    return false;
}
</script>
</body>

<!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->

</html>