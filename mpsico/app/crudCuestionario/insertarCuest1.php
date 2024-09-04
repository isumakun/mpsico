<?php

session_start();

require "../funciones.php";

$link = conectar();

$idasp = getIDByUser($_SESSION['usuario']);

$A = 0;
$B = 0;
$C = 0;
$D = 0;
$ResultA = 0;
$ResultB = 0;
$ResultC = 0;
$ResultD = 0;

for ($i = 1; $i <= 31; $i++) {

    $valor = asignarValor($i, $_POST['preg' . $i]);
    
    if (($i >= 1 && $i <= 8)) {
        $A += $valor;
    }else if (($i >= 9 && $i <= 12)) {
        $B += $valor;
    }else if (($i >= 13 && $i <= 22)) {
        $C += $valor;
    }else if (($i >= 23 && $i <= 31)) {
        $D += $valor;
    }
}

$ResultA = ($A/8)*4;
$ResultB = ($B/4)*3;
$ResultC = ($C/10)*2;
$ResultD = $D/9;

$puntajeBrutoTotal = round($ResultA+$ResultB+$ResultC+$ResultD, 1);

$puntajeTransformado = round(($puntajeBrutoTotal/61.16)*100, 1);

if($puntajeTransformado>100){
    $puntajeTransformado = 100;
}

if ($_SESSION['cargo'] == 'jefe') {
    $baremosPTC = baremosPTCEstresJefe($puntajeTransformado);
} else{
    $baremosPTC = baremosPTCEstresAux($puntajeTransformado);
}


$sql = "INSERT INTO cuestionario
            (Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
            VALUES ('{$_POST['numero']}',
                    '$puntajeTransformado',
                    '$baremosPTC',
                    '$idasp');";


mysql_query($sql, $link);

$error = mysql_error($link);

if ($error == null) {
    header("Location: ../cuestionarios.php?c=2");
} else {
    //header("Location: pruebas.php?estado=errordatos");
    echo "<center>";
    echo "<h1> " . $error . "</h1>";
    echo "</center>";
}

mysql_close($link);

function obtenerPuntajeBrutoTotal(){
    
}

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [1, 2, 3, 9, 13, 14, 15, 23, 24];

    $items2 = [4, 5, 6, 10, 11, 16, 17, 18, 19, 25,
        26, 27, 28];

    $items3 = [7, 8, 12, 20, 21, 22, 29, 30, 31];

    if (in_array($i, $items1)) {
        switch ($valor) {
            case "siempre":
                $nuevoValor = 9;
                break;
            case "casi siempre":
                $nuevoValor = 6;
                break;
            case "a veces":
                $nuevoValor = 3;
                break;
            case "nunca":
                $nuevoValor = 0;
                break;
            default :
                $nuevoValor = 0;
                break;
        }
    } else if (in_array($i, $items2)) {
        switch ($valor) {
            case "siempre":
                $nuevoValor = 6;
                break;
            case "casi siempre":
                $nuevoValor = 4;
                break;
            case "a veces":
                $nuevoValor = 2;
                break;
            case "nunca":
                $nuevoValor = 0;
                break;
            default :
                $nuevoValor = 0;
                break;
        }
    }else if (in_array($i, $items3)) {
        switch ($valor) {
            case "siempre":
                $nuevoValor = 3;
                break;
            case "casi siempre":
                $nuevoValor = 2;
                break;
            case "a veces":
                $nuevoValor = 1;
                break;
            case "nunca":
                $nuevoValor = 0;
                break;
            default :
                $nuevoValor = 0;
                break;
        }
    }

    return $nuevoValor;
}
