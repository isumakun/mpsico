<section class="sec-padding">
    <?php if (validarAdmin()) {
        ?>

        <div class="container">
            <div class="row no-gutter">
                <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                    <a class="button hvr-float" href="empresas.php">
                        <div class="feature-box-86 bg-color-light"> <img src="images/company.png" alt=""/>
                            <div class="clearfix"></div>
                            <h3 class="text-white paddtop1">Empresas</h3>
                            <p class="text-white">Inscripción Empresas</p>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </a> 
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                    <a class="button hvr-float" href="aspirantes.php">
                        <div class="feature-box-86"> <img src="images/users.png" alt=""/>
                            <div class="clearfix"></div>
                            <h3 class="text-white paddtop1">Aspirantes</h3>
                            <p class="text-white">Inscripción Aspirantes</p>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </a> 
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                    <a class="button hvr-float" href="informes.php">
                        <div class="feature-box-86 bg-color-light"> <img src="images/reports.png" alt=""/>
                            <div class="clearfix"></div>
                            <h3 class="text-white paddtop1">Informes</h3>
                            <p class="text-white">Generar Informes</p>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </a> 
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                    <a class="button hvr-float" href="configurarPruebas.php">
                        <div class="feature-box-86"> <img src="images/test.png" alt=""/>
                            <div class="clearfix"></div>
                            <h3 class="text-white paddtop1">Pruebas</h3>
                            <p class="text-white">Consola de Pruebas</p>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </a> 
                </div>

            <?php } else {
                ?>
                <div class="col-md-4 col-sm-12 col-xs-12 text-center">

                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                    <a class="button hvr-float" href="pruebas.php">
                        <div class="feature-box-86"> <img src="images/test.png" alt=""/>
                            <div class="clearfix"></div>
                            <h3 class="text-white paddtop1">Pruebas</h3>
                            <p class="text-white">Presentar Pruebas</p>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </a> 
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 text-center">

                </div>
                <?php
            }
            ?>

            <!--end item-->
        </div>
    </div>
</section>