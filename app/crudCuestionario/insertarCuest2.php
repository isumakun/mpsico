<?php

session_start();

require "../funciones.php";

$array_dimension[0] = [14, 15, 16, 17];

$array_dimension[1] = [22, 25, 27];

$array_dimension[2] = [18, 19, 20, 21, 23];

$array_dimension[3] = [29, 30, 31];

$array_dimension[4] = [5, 6, 7, 8, 9, 10, 11, 12, 13];

$array_dimension[5] = [24, 26, 28];

$array_dimension[6] = [1, 2, 3, 4];


$sumaDimension = [0, 0, 0, 0, 0, 0, 0];

$baremosDimensiones = [0, 0, 0, 0, 0, 0, 0];

for ($i = 1; $i <= 31; $i++) {

    $valor = asignarValor($i, $_POST['preg' . $i]);

    if (($i > 88 && $i <= 31)) {
        if ($_POST['servicio'] == "no") {
            $valor = 0;
        }
    }


    for ($j = 0; $j <= 6; $j++) {
        if (in_array($i, $array_dimension[$j])) {
            $sumaDimension[$j] += $valor;
        }
    }
}


$factoresDimen = [16, 12, 20, 12, 36, 12, 16];
$factorPTC = 124;

for ($j = 0; $j <= 6; $j++) {
    $baremosDimensiones[$j] = transformarForma($sumaDimension[$j], $factoresDimen[$j]);
}

$PTC = array_sum($sumaDimension);

$trans = transformarForma($PTC, 124);

if ($_SESSION['cargo'] == 'jefe') {
        $baremo = baremosPTCExtraJefe($trans);
    } else{
        $baremo = baremosPTCExtraAux($trans);
    }

$link = conectar();

$idasp = getIDByUser($_SESSION['usuario']);

$sql = "INSERT INTO cuestionario
            (Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
            VALUES ('{$_POST['numero']}',
                    '$trans',
                    '$baremo',
                    '$idasp');";


mysql_query($sql, $link);

$id = mysql_insert_id();


for ($i = 0; $i <= 6; $i++) {

    if ($_SESSION['cargo'] == 'jefe') {
        $resultado = baremosDimensionesExtraJefe($baremosDimensiones[$i]);
    } else{
        $resultado = baremosDimensionesExtraAux($baremosDimensiones[$i]);
    }

    $sql = "INSERT INTO dimension
            (
             Valor,
             Puntaje,
             Cuestionario_idCuestionario)
    VALUES (
            '$resultado',
            '$baremosDimensiones[$i]',
            '$id');";

    mysql_query($sql, $link);
}

$error = mysql_error($link);

if ($error == null) {
    if ($_SESSION['forma']==1) {
        header("Location: ../cuestionarios.php?c=3");
    }else  if ($_SESSION['forma']==2) {
        header("Location: ../cuestionarios.php?c=4");
    }
} else {
    //header("Location: pruebas.php?estado=errordatos");
    echo "<center>";
    echo "<h1> " . $error . "</h1>";
    echo "</center>";
}

mysql_close($link);

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [1, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14,
        15, 16, 17, 18, 19, 20, 21, 22, 23,
        25, 27, 29];

    $items2 = [2, 3, 6, 24, 26, 28, 30, 31];

    if (in_array($i, $items1)) {
        switch ($valor) {
            case "siempre":
                $nuevoValor = 0;
                break;
            case "casi siempre":
                $nuevoValor = 1;
                break;
            case "a veces":
                $nuevoValor = 2;
                break;
            case "casi nunca":
                $nuevoValor = 3;
                break;
            case "nunca":
                $nuevoValor = 4;
                break;
            default :
                $nuevoValor = 0;
                break;
        }
    } else if (in_array($i, $items2)) {
        switch ($valor) {
            case "siempre":
                $nuevoValor = 4;
                break;
            case "casi siempre":
                $nuevoValor = 3;
                break;
            case "a veces":
                $nuevoValor = 2;
                break;
            case "casi nunca":
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
