<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<!--<![endif]-->
<!--<![endif]-->
<html lang="en">

    <!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:30 GMT -->
    <head>
        <title>Generación de Informes</title>
        <?php require './head.php'; ?>  
        <link href="css/cuestionario.css" rel="stylesheet" media="all">

        <style>
            .feature-box-86{
                background-color: #3fc35f !important;
            }

            .bg-color-light{
                background-color: #4ece6d !important;
            }
            .btn {
                padding: 5px 10px;
            }

            .div-center{
                margin: auto;
                width: 40%;
            }

            .header-inner.two {
                height: 130px;
            }

            .header-inner .title {
                padding: 40px 0 0 0;
            }
        </style>
    </head>

    <body onload="initialize()">
        <div class="site_wrapper">
            <?php require './header.php'; ?>  
            <!-- masterslider -->

            <section>
                <div class="header-inner two">
                    <div class="inner text-center">
                        <h4 class="title text-white uppercase">Informes</h4>
                        <h5 class="text-white uppercase">generar excel</h5>
                    </div>
                    <div class="overlay bg-opacity-5"></div>
                    <img src="images/header-informes.jpg" alt="" class="img-responsive"/> </div>
            </section>
            <!-- end header inner -->
            <div class="clearfix"></div>

            <section class="sec-padding">
                <div class="container">
                    <div class="row">
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
                    <br>
                </div>
            </section>

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
                location.href = 'makeExcel.php?empresa=' + empresa;
            }

            $('#empresa').on('change', function () {
                location.href = 'makeExcel.php?empresa=' + this.value;
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
