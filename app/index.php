<?php
$title = ''; 
require './header.php'; 
if (validarAdmin()) {
        ?>

        <div class="row">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Empresas</h3>

              <p>Gestión de empresas</p>
            </div>
            <div class="iconx">
              <i class="fa fa-building"></i>
            </div>
            <a href="empresas.php" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>Aspirantes</h3>

              <p>Gestión de aspirantes</p>
            </div>
            <div class="iconx">
              <i class="fa fa-users"></i>
            </div>
            <a href="aspirantes.php" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Informes</h3>

              <p>Generador de informes</p>
            </div>
            <div class="iconx">
              <i class="fa fa-pie-chart"></i>
            </div>
            <a href="informes.php" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Ajustes</h3>

              <p>Ajustes de pruebas</p>
            </div>
            <div class="iconx">
              <i class="fa fa-gears"></i>
            </div>
            <a href="configurarPruebas.php" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
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
</section>

<?php require './footer.php'; ?>
