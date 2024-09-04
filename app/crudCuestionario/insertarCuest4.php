<?php

session_start();

require "../funciones.php";


$array_dimension[0] = [49, 50, 51, 52, 53, 54,
55, 56, 57, 58, 59, 60, 61];

$array_dimension[1] = [62, 63, 64, 65, 66, 67,
68, 69, 70, 71, 72, 73];

$array_dimension[2] = [74, 75, 76, 77, 78];

$array_dimension[3] = [41, 42, 43, 44, 45];

$array_dimension[4] = [46, 47, 48];

$array_dimension[5] = [38, 39, 40];

$array_dimension[6] = [29, 30, 31, 32];

$array_dimension[7] = [34, 35, 36];

$array_dimension[8] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
11, 12];

$array_dimension[9] = [89, 90, 91, 92, 93, 94,
95, 96, 97];

$array_dimension[10] = [13, 14, 15];

$array_dimension[11] = [25, 26, 27, 28];

$array_dimension[12] = [16, 17, 18, 19, 20];

$array_dimension[13] = [21, 22, 23, 24, 33, 37];

$array_dimension[14] = [85, 86, 87, 88];

$array_dimension[15] = [79, 80, 81, 82, 83, 84];

$sumaDimension = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$baremosDimensiones = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$dominios = [0, 0, 0, 0];

$baremosDominios = [0, 0, 0, 0];

for ($i = 1; $i <= 97; $i++) {

    $valor = asignarValor($i, $_POST['preg' . $i]);

    if (($i > 88 && $i <= 97)) {
        if ($_POST['servicio4'] == "no") {
            $valor = 0;
        }
    }


    for ($j = 0; $j <= 15; $j++) {
        if (in_array($i, $array_dimension[$j])) {
            $sumaDimension[$j] += $valor;
        }
    }
}

for ($j = 0; $j < 16; $j++) {
    if (($j == 0) || ($j < 3)) {
        $dominios[0] += $sumaDimension[$j];
    } else if (($j == 3) || ($j < 8)) {
        $dominios[1] += $sumaDimension[$j];
    } else if (($j == 8) || ($j < 15)) {
        $dominios[2] += $sumaDimension[$j];
    } else if (($j == 15) || ($j <= 16)) {
        $dominios[3] += $sumaDimension[$j];
    }
}

$factoresDimen = [52, 48, 20, 20, 12, 12, 16, 12, 48, 36, 12, 16, 20, 24, 16, 24];
$factoresDomin = [120, 72, 156, 40];
$factorPTC = 388;

for ($j = 0; $j <= 15; $j++) {
    $baremosDimensiones[$j] = transformarForma($sumaDimension[$j], $factoresDimen[$j]);
}

for ($j = 0; $j <= 3; $j++) {
    $baremosDominios[$j] = transformarForma($dominios[$j], $factoresDomin[$j]);
}

$PTC = array_sum($dominios);

$trans = transformarForma($PTC, $factorPTC);

$baremosPTC = baremosTotalFormaB($trans);

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

for ($i = 0; $i <= 15; $i++) {

    $resultado = baremosDimensionesFormaB($baremosDimensiones[$i], $i);

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

    $resultado = baremosDominiosFormaB($baremosDominios[$i], $i);

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
    header("Location: ../pruebas.php?estado=guardado");
} else {
    //header("Location: pruebas.php?estado=errordatos");
    echo "<center>";
    echo "<h1> " . $error . "</h1>";
    echo "</center>";
}

mysql_close($link);

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [4, 5, 6, 9, 12, 14, 22, 24, 29, 30,
        31, 32, 33, 34, 35, 36, 37, 38, 39,
        40, 41, 42, 43, 44, 45, 46, 47, 48,
        49, 50, 51, 52, 53, 54, 55, 56, 57,
        58, 59, 60, 61, 62, 63, 64, 65, 67,
        68, 69, 70, 71, 72, 73, 74, 75, 76,
        77, 78, 79, 80, 81, 82, 83, 84, 85,
        86, 87, 88, 97];

    $items2 = [1, 2, 3, 7, 8, 10, 11, 13, 15, 16, 17,
        18, 19, 20, 21, 23, 25, 26, 27, 28,
        66, 89, 90, 91, 92, 93, 94, 95, 96];

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
