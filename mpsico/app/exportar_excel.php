<?php $title = 'Exportar Excel'; ?> 
        <link href="css/cuestionario.css" rel="stylesheet" media="all">
            <?php require './header.php'; ?>  
            
            
                <div class="box box-primary">
                    <div class="box-body">
                        <form id="form" method="GET" enctype="multipart/form-data" action="excel.php">
                            <div class="div-center">                            
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Seleccione la empresa para generar el informe</label>
                                    <select class="form-control" name="empresa" required=""  id="empresa">
                                        <?php require_once './crudEmpresa/generarListaEmpresasSelect.php'; ?>
                                    </select>
                                    <label class="control-label" for="inputDefault">Seleccione la Forma</label>
                                    <select class="form-control" name="numero" required=""  id="area">
                                        <option value="3">Forma A</option>
                                        <option value="4">Forma B</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-raised ">Generar</button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- end section -->
            <div class="clearfix"></div>
            <?php require './footer.php'; ?>

       
        <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('#tabla').DataTable();
            
            var empresa = <?php if(isset($_GET['empresa'])){
                echo $_GET['empresa'];
            }else{
                echo 0;
            }
            ?> ;
            
            if(empresa===0){
                empresa = $('#empresa').val();
                location.href = 'exportar_excel.php?empresa=' + empresa;
            }

            $('#empresa').on('change', function () {
                location.href = 'exportar_excel.php?empresa=' + this.value;
            });
        });
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
