<?php

session_start();

require "../funciones.php";

try {
    $pdo = conectar();

    $array_dimension = [
        [63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75],
        [76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89],
        [90, 91, 92, 93, 94],
        [115, 116, 117, 118, 119, 120, 121, 122, 123],
        [53, 54, 55, 56, 57, 58, 59],
        [60, 61, 62],
        [48, 49, 50, 51],
        [39, 40, 41, 42],
        [44, 45, 46],
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        [106, 107, 108, 109, 110, 111, 112, 113, 114],
        [13, 14, 15, 32, 43, 47],
        [35, 36, 37, 38],
        [19, 22, 23, 24, 25, 26],
        [16, 17, 18, 20, 21],
        [27, 28, 29, 30, 52],
        [31, 33, 34],
        [95, 102, 103, 104, 105],
        [96, 97, 98, 99, 100, 101]
    ];

    $sumaDimension = array_fill(0, 19, 0);
    $baremosDimensiones = array_fill(0, 19, 0);
    $dominios = array_fill(0, 4, 0);
    $baremosDominios = array_fill(0, 4, 0);

    for ($i = 1; $i <= 123; $i++) {
        $valor = asignarValor($i, $_POST['preg' . $i]);

        if ($i >= 106 && $i <= 114 && $_POST['servicio'] == "no") {
            $valor = 0;
        }

        if ($i >= 115 && $i <= 123 && $_POST['jefe'] == "no") {
            $valor = 0;
        }

        foreach ($array_dimension as $j => $dim) {
            if (in_array($i, $dim)) {
                $sumaDimension[$j] += $valor;
            }
        }
    }

    foreach ($sumaDimension as $j => $suma) {
        if ($j < 4) {
            $dominios[0] += $suma;
        } elseif ($j < 9) {
            $dominios[1] += $suma;
        } elseif ($j < 17) {
            $dominios[2] += $suma;
        } else {
            $dominios[3] += $suma;
        }
    }

    $factoresDimen = [52, 56, 20, 36, 28, 12, 16, 16, 12, 48, 36, 24, 16, 24, 20, 20, 12, 20, 24];
    $factoresDomin = [164, 84, 200, 44];
    $factorPTC = 492;

    foreach ($sumaDimension as $j => $suma) {
        $baremosDimensiones[$j] = transformarForma($suma, $factoresDimen[$j]);
    }

    foreach ($dominios as $j => $dominio) {
        $baremosDominios[$j] = transformarForma($dominio, $factoresDomin[$j]);
    }

    $PTC = array_sum($dominios);
    $trans = transformarForma($PTC, $factorPTC);
    $baremosPTC = baremosTotalFormaA($trans);

    $idasp = getIDByUser($_SESSION['usuario']);

    $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante, Fecha)
            VALUES (:numero, :trans, :baremo, :idasp, now())";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':numero' => $_POST['numero'],
        ':trans' => $trans,
        ':baremo' => $baremosPTC,
        ':idasp' => $idasp
    ]);

    $id = $pdo->lastInsertId();

    foreach ($baremosDimensiones as $i => $baremo) {
        $resultado = baremosDimensionesFormaA($baremo, $i);

        $sql = "INSERT INTO dimension (Valor, Puntaje, Cuestionario_idCuestionario)
                VALUES (:resultado, :baremo, :id)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resultado' => $resultado,
            ':baremo' => $baremo,
            ':id' => $id
        ]);
    }

    foreach ($baremosDominios as $i => $baremo) {
        $resultado = baremosDominiosFormaA($baremo, $i);

        $sql = "INSERT INTO dominio (Valor, Puntaje, Cuestionario_idCuestionario)
                VALUES (:resultado, :baremo, :id)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resultado' => $resultado,
            ':baremo' => $baremo,
            ':id' => $id
        ]);
    }

    header("Location: ../cuestionarios.php?c=4");

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1></center>";
}

$pdo = null;

function asignarValor($i, $valor) {
    $items1 = [4, 5, 6, 9, 12, 14, 32, 34, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
    $items2 = [1, 2, 3, 7, 8, 10, 11, 13, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 33, 35, 36, 37, 38, 52, 80, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123];

    $valores = [
        'siempre' => [0, 4],
        'casi siempre' => [1, 3],
        'a veces' => [2, 2],
        'casi nunca' => [3, 1],
        'nunca' => [4, 0]
    ];

    if (in_array($i, $items1)) {
        $nuevoValor = $valores[$valor][0] ?? 0;
    } else if (in_array($i, $items2)) {
        $nuevoValor = $valores[$valor][1] ?? 0;
    } else {
        $nuevoValor = 0;
    }

    return $nuevoValor;
}
