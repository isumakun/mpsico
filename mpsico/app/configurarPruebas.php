<link href="css/cuestionario.css" rel="stylesheet" media="all">
<?php $title = ''; ?>
<?php require './header.php'; ?>
<?php require './funciones.php'; ?>

<section class="sec-padding">
    <div class="container">
        <div class="row">
            <div class="div-center">
                <form method="POST" action="actualizarTransmision.php">
                    <div class="form-group">
                        <label for="link">Link de la transmisión</label>
                        <input type="text" class="form-control" <?php 
                        $valor = getLink();
                        if($valor!=""){
                            echo "value='$valor'";
                        }?> id="link" name="link" placeholder="https://www.youtube.com/watch?v=I4Z_smu1m2Y">
                    </div>
                    <button type="submit" class="btn btn-primary btn-raised">Actualizar</button>
                </form>
            </div>             
        </div>
    </div>
</section>
<?php require './footer.php'; ?>