<?php

session_start();

require "../funciones.php";

$array_dimension[0] = [63, 64, 65, 66, 67, 68, 69, 70,
    71, 72, 73, 74, 75];

$array_dimension[1] = [76, 77, 78, 79, 80, 81, 82, 83,
    84, 85, 86, 87, 88, 89];

$array_dimension[2] = [90, 91, 92, 93, 94];

$array_dimension[3] = [115, 116, 117, 118, 119, 120,
    121, 122, 123];

$array_dimension[4] = [53, 54, 55, 56, 57, 58, 59];

$array_dimension[5] = [60, 61, 62];

$array_dimension[6] = [48, 49, 50, 51];

$array_dimension[7] = [39, 40, 41, 42];

$array_dimension[8] = [44, 45, 46];

$array_dimension[9] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

$array_dimension[10] = [106, 107, 108, 109, 110, 111,
    112, 113, 114];

$array_dimension[11] = [13, 14, 15, 32, 43, 47];

$array_dimension[12] = [35, 36, 37, 38];

$array_dimension[13] = [19, 22, 23, 24, 25, 26];

$array_dimension[14] = [16, 17, 18, 20, 21];

$array_dimension[15] = [27, 28, 29, 30, 52];

$array_dimension[16] = [31, 33, 34];

$array_dimension[17] = [95, 102, 103, 104, 105];

$array_dimension[18] = [96, 97, 98, 99, 100, 101];

$sumaDimension = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$baremosDimensiones = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$dominios = [0, 0, 0, 0];

$baremosDominios = [0, 0, 0, 0];

for ($i = 1; $i <= 123; $i++) {

    $valor = asignarValor($i, $_POST['preg' . $i]);

    if (($i >= 106 && $i <= 114)){
        if ($_POST['servicio'] == "no") {
            $valor = 0;
        }else{
            $valor = asignarValor($i, $_POST['preg' . $i]);
        }
    }
    
    if (($i >= 115 && $i <= 123)) {
        if ($_POST['jefe'] == "no") {
            $valor = 0;
        }else{
            $valor = asignarValor($i, $_POST['preg' . $i]);
        }
    }

    for ($j = 0; $j <= 18; $j++) {
        if (in_array($i, $array_dimension[$j])) {
            $sumaDimension[$j] += $valor;
        }
    }
}

for ($j = 0; $j <= 18; $j++) {
    if (($j == 0) || ($j < 4)) {
        $dominios[0] += $sumaDimension[$j];
    } else if (($j == 4) || ($j < 9)) {
        $dominios[1] += $sumaDimension[$j];
    } else if (($j == 9) || ($j < 17)) {
        $dominios[2] += $sumaDimension[$j];
    } else if (($j == 17) || ($j <= 18)) {
        $dominios[3] += $sumaDimension[$j];
    }
}

$factoresDimen = [52, 56, 20, 36, 28, 12, 16, 16, 12, 48, 36, 24, 16, 24, 20, 20, 12, 20, 24];
$factoresDomin = [164, 84, 200, 44];
$factorPTC = 492;

for ($j = 0; $j <= 18; $j++) {
    $baremosDimensiones[$j] = transformarForma($sumaDimension[$j], $factoresDimen[$j]);
}

for ($j = 0; $j <= 3; $j++) {
    $baremosDominios[$j] = transformarForma($dominios[$j], $factoresDomin[$j]);
}

$PTC = array_sum($dominios);

$trans = transformarForma($PTC, $factorPTC);

$baremosPTC = baremosTotalFormaA($trans);

$link = conectar();

$idasp = getIDByUser($_SESSION['usuario']);

$sql = "INSERT INTO cuestionario
            (Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
            VALUES ('{$_POST['numero']}',
                    '$trans',
                    '$baremosPTC',
                    '$idasp');";


mysql_query($sql, $link);

$id = mysql_insert_id();

for ($i = 0; $i <= 18; $i++) {

    $resultado = baremosDimensionesFormaA($baremosDimensiones[$i], $i);

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

for ($i = 0; $i <= 3; $i++) {

    $resultado = baremosDominiosFormaA($baremosDominios[$i], $i);

    $sql = "INSERT INTO dominio
            (
             Valor,
             Puntaje,
             Cuestionario_idCuestionario)
    VALUES ('$resultado',
            '$baremosDominios[$i]',
            '$id');";

    mysql_query($sql, $link);
}

$error = mysql_error($link);

if ($error == null) {
    header("Location: ../cuestionarios.php?c=4");
} else {
    //header("Location: pruebas.php?estado=errordatos");
    echo "<center>";
    echo "<h1> " . $error . "</h1>";
    echo "</center>";
}

mysql_close($link);

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [4, 5, 6, 9, 12, 14, 32, 34, 39, 40,
        41, 42, 43, 44, 45, 46, 47, 48, 49,
        50, 51, 53, 54, 55, 56, 57, 58, 59,
        60, 61, 62, 63, 64, 65, 66, 67, 68,
        69, 70, 71, 72, 73, 74, 75, 76, 77,
        78, 79, 81, 82, 83, 84, 85, 86, 87,
        88, 89, 90, 91, 92, 93, 94, 95, 96,
        97, 98, 99, 100, 101, 102, 103, 104,
        105];

    $items2 = [1, 2, 3, 7, 8, 10, 11, 13, 15, 16, 17,
                18, 19, 20, 21, 22, 23, 24, 25, 26,
                27, 28, 29, 30, 31, 33, 35, 36, 37,
                38, 52, 80, 106, 107, 108, 109, 110,
                111, 112, 113, 114, 115, 116, 117,
                118, 119, 120, 121, 122, 123];

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
