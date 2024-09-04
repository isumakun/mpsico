<?php $title = '' ?>
<?php require './header.php'; ?>  
<link href="css/cuestionario.css" rel="stylesheet" media="all">

<div class="row">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><b>General</b></h4>

              <p>Informe General</p>
            </div>
            <div class="iconx">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="informeOpciones.php" class="small-box-footer">Generar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
             <div class="inner">
              <h4><b>Individual</b></h4>

              <p>Generar Informe Individual</p>
            </div>
            <div class="iconx">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="informeIndividual.php" class="small-box-footer">Generar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><b>Importar</b></h4>

              <p>Importar datos de Excel</p>
            </div>
            <div class="iconx">
              <i class="fa fa-file-excel-o"></i>
            </div>
            <a href="importar.php" class="small-box-footer">Generar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><b>Exportar</b></h4>

              <p>Exportar datos a Excel</p>
            </div>
            <div class="iconx">
              <i class="fa fa-file-excel-o"></i>
            </div>
            <a href="exportar_excel.php" class="small-box-footer">Exportar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

<?php require './footer.php'; ?>
