
<div class="row">
    <div class="col-lg-3 col-xs-12" id="cuestionario1">
        <a class="button" href="cuestionarios.php?c=1"
        <?php
        if (getCuestiorioRealizado($_SESSION['usuario'], 1)) {
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
    <a class="button" href="cuestionarios.php?c=2"
    <?php
    if (getCuestiorioRealizado($_SESSION['usuario'], 2)) {
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
    <a class="button" href="cuestionarios.php?c=3"
    <?php
    if (getCuestiorioRealizado($_SESSION['usuario'], 3)) {
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
    <a class="button" href="cuestionarios.php?c=4"
    <?php
    if (getCuestiorioRealizado($_SESSION['usuario'], 4)) {
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
  <br/>
</a> 
</div>
</div>