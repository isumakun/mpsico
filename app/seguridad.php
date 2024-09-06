<?php

session_start();

function validarAuth() {
    if (isset($_SESSION["login"])) {
        if (!$_SESSION["login"] && $_SESSION["usuario"] != 'admin') {
            //si no existe, envio a la página de autentificacion 
            header("Location: login.php");
            //ademas salgo de este script 
            exit();
        }
    }else{
        header("Location: login.php");
        //ademas salgo de este script 
        exit();
    }
}

function validarAdmin() {
    if ($_SESSION["tipo"] == 1) {
        return true;
    } else {
        return false;
    }
}
