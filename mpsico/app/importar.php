<?php $title = 'Importar Excel'; ?>
<?php
require './header.php';
?>  
<link href="css/cuestionario.css" rel="stylesheet" media="all">

<div class="row col-md-6">
<div class="box box-primary">
    <div class="box-body">
        <form id="form" method="POST" enctype="multipart/form-data" action="informes/procesarExcel.php">
            <div class="div-center">                            
                <div class="form-group">
                    <label class="control-label" for="inputDefault">Archivo Excel</label>
                    <input type="file" class="form-control" required="" accept=".xls

                    "  name="excel" id="excel" >
                    <span class="red-font">- El archivo debe estar en formato Excel 97 - 2003</span>
                    <br>
                    <span class="red-font">- No debe tener el archivo abierto al momento de importarlo</span>
                </div>
                <div class="form-group">
                    <label for="select" class="control-label">Empresa</label>
                    <select class="form-control" name="empresa" required=""  id="empresa">
                        <?php require_once './crudEmpresa/generarListaEmpresas.php'; ?>
                    </select>
                </div>
                <button type="submit" onclick="showModal();" class="btn btn-primary btn-raised ">Importar</button>
            </div>
        </form>
    </div>
</div>
</div>
<div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: justify">
                <center>
                    <h3>Por favor espere...</h3><br>
                    <img src="images/loading.gif" width="140" height="100"/></center>
                </div>
            </div>
        </div>
    </div>

    <!-- end section -->
    <div class="clearfix"></div>
    <?php require './footer.php'; ?>
</div>
<!-- end site wraper --> 

<!-- ============ JS FILES ============ --> 

<script type="text/javascript" src="js/universal/jquery.js"></script> 
<script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script> 
<script src="js/masterslider/jquery.easing.min.js"></script> 
<script src="js/masterslider/masterslider.min.js"></script> 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

<!-- DataTables Plugin -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    function showModal(){
        $('#modal-content').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    }
</script>
<script type="text/javascript">
    (function ($) {
        "use strict";
        var slider = new MasterSlider();
                // adds Arrows navigation control to the slider.
                slider.control('arrows');
                slider.control('bullets');

                slider.setup('masterslider', {
                    width: 1600, // slider standard width
                    height: 630, // slider standard height
                    space: 0,
                    speed: 45,
                    layout: 'fullwidth',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "parallaxMask"
                });

            })(jQuery);
        </script> 
        <script type="text/javascript">
            (function ($) {
                "use strict";
                var slider = new MasterSlider();

                slider.setup('masterslider2', {
                    width: 570, // slider standard width
                    height: 300, // slider standard height
                    space: 0,
                    speed: 27,
                    layout: 'boxed',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "basic",
                });
            }
            )(jQuery);
        </script> 
        <script src="js/mainmenu/customeUI.js"></script>  
        <script src="js/owl-carousel/owl.carousel.js"></script> 
        <script src="js/owl-carousel/custom.js"></script> 
        <script type="text/javascript" src="js/tabs/smk-accordion.js"></script>
        <script type="text/javascript" src="js/tabs/custom.js"></script> 
        <script src="js/scrolltotop/totop.js"></script> 
        <script src="js/mainmenu/jquery.sticky.js"></script> 
        <script src="js/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> 
        <script src="js/style-swicher/style-swicher.js"></script> 
        <script src="js/style-swicher/custom.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.form.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/additional-methods.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/smart-form.js"></script> 
        <script src="js/scripts/functions.js" type="text/javascript"></script>

    </body>

    <!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->
    </html>
