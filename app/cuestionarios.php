<?php $title = 'Cuestionarios'; ?>
<?php
require './header.php';
include './funciones.php';
?>  
<link href="css/cuestionario.css" rel="stylesheet" media="all">
<style>
#modal-video{
    margin: 10px 10px;
    float: right;
    right: 0;
    bottom: 0;
    width: 320px;
    height: 240px;
    position: fixed;
    z-index: 998;
}
</style>
<div class="box box-primary">
    <div class="box-header">
        <ul class="nav nav-tabs">
            <li><a 
                <?php
                if (getCuestionarioRealizado($_SESSION['usuario'], 1)) {
                    echo 'href="#" id="1" onclick="return realizado();"';
                } else {
                    echo 'data-toggle="tab" id="f1" href="#c1"';
                }
                ?>>Cuestionario 1</a></li>
                <li><a 
                    <?php
                    if (getCuestionarioRealizado($_SESSION['usuario'], 2)) {
                        echo 'href="#" onclick="return realizado();"';
                    } else {
                        echo 'data-toggle="tab" id="f2" href="#c2"';
                    }
                    ?>>Cuestionario 2</a></li>
                    <?php if(getForma($_SESSION['usuario'], 1)){?>
                    <li><a 
                        <?php
                        if (getCuestionarioRealizado($_SESSION['usuario'], 3)) {
                            echo 'href="#" onclick="return realizado();"';
                        } else {
                            echo 'data-toggle="tab" id="f3" href="#c3"';
                        }
                        ?>>Cuestionario 3</a></li>
                        <?php }else if(getForma($_SESSION['usuario'], 2)){?>
                        <li><a 
                            <?php
                            if (getCuestionarioRealizado($_SESSION['usuario'], 4)) {
                                echo 'href="#" onclick="return realizado();"';
                            } else {
                                echo 'data-toggle="tab" id="f4" href="#c4"';
                            }
                            ?>>Cuestionario 4</a></li>
                            <?php }?>
                        </ul>
                    </div>

                    <div class="box-body">
                        <div id="content" class="row tab-content cuestionarios">
                            <div class="tab-pane fade" id="c1">
                                <?php include './cuestionario1.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="c2">
                                <?php include './cuestionario2.php'; ?>
                            </div>
                            <?php
                            if ($_SESSION['forma']==1) {
                                ?>
                                <div class="tab-pane fade" id="c3">
                                    <?php include './cuestionario3.php'; ?>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="tab-pane fade" id="c4">
                                    <?php include './cuestionario4.php'; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <!--<div class="show">
                    <div id="modal-video" class="modal-dialog">
                        <div>
                            <div>
                                <iframe width="320" height="240" src="<?php echo getLink() ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- dialog body -->
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <center><h3>Guardado</h3></center>
                            </div>
                            <!-- dialog buttons -->
                            <div class="modal-footer"><button type="button" class="btn btn-primary">OK</button></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require './footer.php'; ?>

        </div>
        <!-- end site wraper --> 
        <script type="text/javascript">
            $(document).ready(function(){
                var cuestionarios = <?= json_encode(getCuestionarioRealizadoString()) ?>;
                //console.log(cuestionarios);
                
                var param1var = getQueryVariable("c");                  
                
                $('#f<?=$_GET['c']?>').click();
            })

            function eventFire(el, etype){
              if (el.fireEvent) {
                el.fireEvent('on' + etype);
            } else {
                var evObj = document.createEvent('Events');
                evObj.initEvent(etype, true, false);
                el.dispatchEvent(evObj);
            }
        }

        function getQueryVariable(variable) {
          var query = window.location.search.substring(1);
          var vars = query.split("&");
          for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
              return pair[1];
          }
      } 
      alert('Query Variable ' + variable + ' not found');
  }

  function realizado() {
    swal(
      'Espera!',
      'Ya has realizado este test!',
      'error'
      )
    return false;
}

$("input:radio[name=servicio4]").click(function () {
            var value = $(this).val();
            if (value === "si") {
                $("#servicio4").show();
            } else if (value === "no") {
                $("#servicio4").hide();
            }
        });

        $("input:radio[name=servicio]").click(function () {
            var value = $(this).val();
            if (value === "si") {
                $("#servicio").show();
                $("#preg_jefe").show();
            } else if (value === "no") {
                $("#servicio").hide();
                $("#preg_jefe").show();
            }
        });

        $("input:radio[name=jefe]").click(function () {
            var value = $(this).val();
            if (value === "si") {
                $("#jefe").show();
            } else if (value === "no") {
                $("#jefe").hide();
            }
        });
</script>
</body>
</html>
