<?php
require "../modelos/empresa.php";

 if (isset($_GET['idEmpresa'])){
     eliminarEmpresa($_GET["idEmpresa"]);
    }  else {
        
}
   
?>
