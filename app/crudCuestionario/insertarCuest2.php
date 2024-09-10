<?php

session_start();

require "../funciones.php";

try {
    $pdo = conectar();

    $array_dimension = [
        [14, 15, 16, 17],
        [22, 25, 27],
        [18, 19, 20, 21, 23],
        [29, 30, 31],
        [5, 6, 7, 8, 9, 10, 11, 12, 13],
        [24, 26, 28],
        [1, 2, 3, 4]
    ];

    $sumaDimension = array_fill(0, 7, 0);
    $baremosDimensiones = array_fill(0, 7, 0);

    for ($i = 1; $i <= 31; $i++) {
        $valor = asignarValor($i, $_POST['preg' . $i]);

        if ($i > 88 && $i <= 31) {
            if ($_POST['servicio'] == "no") {
                $valor = 0;
            }
        }

        foreach ($array_dimension as $j => $dim) {
            if (in_array($i, $dim)) {
                $sumaDimension[$j] += $valor;
            }
        }
    }

    $factoresDimen = [16, 12, 20, 12, 36, 12, 16];
    $factorPTC = 124;

    foreach ($sumaDimension as $j => $suma) {
        $baremosDimensiones[$j] = transformarForma($suma, $factoresDimen[$j]);
    }

    $PTC = array_sum($sumaDimension);
    $trans = transformarForma($PTC, $factorPTC);

    $baremo = ($_SESSION['cargo'] == 'jefe')
        ? baremosPTCExtraJefe($trans)
        : baremosPTCExtraAux($trans);

    $idasp = getIDByUser($_SESSION['usuario']);

    $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante, Fecha)
            VALUES (:numero, :trans, :baremo, :idasp, now())";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':numero' => $_POST['numero'],
        ':trans' => $trans,
        ':baremo' => $baremo,
        ':idasp' => $idasp
    ]);

    $id = $pdo->lastInsertId();

    foreach ($baremosDimensiones as $i => $baremo) {
        $resultado = ($_SESSION['cargo'] == 'jefe')
            ? baremosDimensionesExtraJefe($baremo)
            : baremosDimensionesExtraAux($baremo);

        $sql = "INSERT INTO dimension (Valor, Puntaje, Cuestionario_idCuestionario)
                VALUES (:resultado, :baremo, :id)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resultado' => $resultado,
            ':baremo' => $baremo,
            ':id' => $id
        ]);
    }

    if ($_SESSION['forma'] == 1) {
        header("Location: ../cuestionarios.php?c=3");
    } else if ($_SESSION['forma'] == 2) {
        header("Location: ../cuestionarios.php?c=4");
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1></center>";
}

$pdo = null;

function asignarValor($i, $valor) {
    $items1 = [1, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 25, 27, 29];
    $items2 = [2, 3, 6, 24, 26, 28, 30, 31];

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
