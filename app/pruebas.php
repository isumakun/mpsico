<?php $title = 'Pruebas'; ?>
<?php require './header.php'; 
require 'funciones.php';?>  

<?php
            require './menuPruebas.php';
            ?>

            <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>RIESGO PSICOSOCIAL Y CONSENTIMIENTO</h3>
                        </div>
                        <div class="modal-body" style="text-align: justify">
                            <p>Señor colaborador; como parte del programa de salud ocupacional, en lo referente al riesgo psicosocial y haciendo cumplimiento 
                                de la resolución 2646 del 17 de julio 2008, nuestra empresa le solicita a Psicocupacional, asesoría y acompañamiento en una medición que 
                                tiene por objeto conocer la satisfacción que tienen los colaboradores con respecto al riesgo psicosocial y cuáles son los factores 
                                que afectan directamente la actitud, la motivación y el desempeño de los colaboradores. <br><br>
                                Su participación es voluntaria, si usted accede a la aplicación del instrumento, se le pedirá responder una encuesta. Esto tomará 
                                aproximadamente 40 minutos de su tiempo.<br><br>
                                La información suministrada será confidencial y no se usará para ningún otro propósito, como tampoco se tomaran ningún tipo de 
                                medidas en contra de las personas que participan en esta aplicación. El propósito como ya se ha mencionado es mejorar la 
                                gestión del factor de riesgo psicosocial y conocer los factores que afectan directamente la actitud, la motivación y el desempeño 
                                de los colaboradores. <br><br>
                                Si tiene alguna duda sobre ésta encuesta, puede hacer preguntas en cualquier momento durante la aplicación de la misma; 
                                igualmente puede retirarse de la aplicación cuando usted lo considere sin que esto lo perjudique en alguna forma. <br><br>
                                Queremos recordarle que usted esta protegido por la Constitución Nacional, Articulo 15 que reza: “Todas las personas tienen 
                                derecho a su intimidad personal y familiar y a su buen nombre, y el Estado debe respetarlos y hacerlos respetar. De igual modo, 
                                tienen derecho a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bancos de datos y en 
                                archivos de entidades públicas y privadas. En la recolección, tratamiento y circulación de datos se respetarán la libertad y demás 
                                garantías consagradas en la Constitución...”. <br><br>
                                De acuerdo a lo anterior le agradecemos se tome el tiempo necesario para expresar de manera sincera su opinión y sentimientos 
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
    $(document).ready(function () {
        var r = <?php echo getConsentimiento($_SESSION['usuario']); ?>;
        if ( r == false) {
            $('#modal-content').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        } else  if ( r == true){
            
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
