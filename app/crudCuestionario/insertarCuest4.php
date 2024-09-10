<?php

session_start();

require "../funciones.php";

$array_dimension = [
    [49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61],
    [62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73],
    [74, 75, 76, 77, 78],
    [41, 42, 43, 44, 45],
    [46, 47, 48],
    [38, 39, 40],
    [29, 30, 31, 32],
    [34, 35, 36],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
    [89, 90, 91, 92, 93, 94, 95, 96, 97],
    [13, 14, 15],
    [25, 26, 27, 28],
    [16, 17, 18, 19, 20],
    [21, 22, 23, 24, 33, 37],
    [85, 86, 87, 88],
    [79, 80, 81, 82, 83, 84]
];

$sumaDimension = array_fill(0, 16, 0);
$baremosDimensiones = array_fill(0, 16, 0);
$dominios = array_fill(0, 4, 0);
$baremosDominios = array_fill(0, 4, 0);

for ($i = 1; $i <= 97; $i++) {
    $valor = asignarValor($i, $_POST['preg' . $i]);

    if ($i > 88 && $i <= 97 && $_POST['servicio4'] == "no") {
        $valor = 0;
    }

    foreach ($array_dimension as $j => $dim) {
        if (in_array($i, $dim)) {
            $sumaDimension[$j] += $valor;
        }
    }
}

for ($j = 0; $j < 16; $j++) {
    if ($j <= 2) {
        $dominios[0] += $sumaDimension[$j];
    } elseif ($j <= 7) {
        $dominios[1] += $sumaDimension[$j];
    } elseif ($j <= 14) {
        $dominios[2] += $sumaDimension[$j];
    } else {
        $dominios[3] += $sumaDimension[$j];
    }
}

$factoresDimen = [52, 48, 20, 20, 12, 12, 16, 12, 48, 36, 12, 16, 20, 24, 16, 24];
$factoresDomin = [120, 72, 156, 40];
$factorPTC = 388;

foreach ($sumaDimension as $j => $sum) {
    $baremosDimensiones[$j] = transformarForma($sum, $factoresDimen[$j]);
}

foreach ($dominios as $j => $dom) {
    $baremosDominios[$j] = transformarForma($dom, $factoresDomin[$j]);
}

$PTC = array_sum($dominios);
$trans = transformarForma($PTC, $factorPTC);
$baremosPTC = baremosTotalFormaB($trans);

try{
    $link = conectar();
    $idasp = getIDByUser($_SESSION['usuario']);

    // Use plain query with variable interpolation
    $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante, Fecha)
            VALUES ('{$_POST['numero']}', '$trans', '$baremosPTC', '$idasp', now())";
    $link->query($sql);
    //get last inserted id
    $id = $link->lastInsertId();

    foreach ($baremosDimensiones as $i => $baremo) {
        $resultado = baremosDimensionesFormaB($baremo, $i);

        $sql = "INSERT INTO dimension (Valor, Puntaje, Cuestionario_idCuestionario)
                VALUES ('$resultado', '$baremo', '$id')";
        $link->query($sql);
    }

    foreach ($baremosDominios as $i => $baremo) {
        $resultado = baremosDominiosFormaB($baremo, $i);

        $sql = "INSERT INTO dominio (Valor, Puntaje, Cuestionario_idCuestionario)
                VALUES ('$resultado', '$baremo', '$id')";
        $link->query($sql);
    }

    header("Location: ../pruebas.php?estado=guardado");
}catch(Exception $e){
    echo "<center><h1>" . $e->getMessage() . "</h1></center>";
    // header("Location: ../nuevoEmpresa.php?estado=errordatos");
}

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [4, 5, 6, 9, 12, 14, 22, 24, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 97];
    $items2 = [1, 2, 3, 7, 8, 10, 11, 13, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 28, 66, 89, 90, 91, 92, 93, 94, 95, 96];

    $valorMap = [
        "siempre" => in_array($i, $items1) ? 0 : 4,
        "casi siempre" => in_array($i, $items1) ? 1 : 3,
        "a veces" => in_array($i, $items1) ? 2 : 2,
        "casi nunca" => in_array($i, $items1) ? 3 : 1,
        "nunca" => in_array($i, $items1) ? 4 : 0
    ];

    return isset($valorMap[$valor]) ? $valorMap[$valor] : 0;
}

?>
