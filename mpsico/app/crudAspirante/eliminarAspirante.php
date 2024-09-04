<?php
require "../modelos/aspirante.php";

 if (isset($_GET['idAspirante'])){
     eliminarAspirante($_GET["idAspirante"]);
    }  else {
        
}
   
?>
