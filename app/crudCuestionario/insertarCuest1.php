<?php

session_start();

require "../funciones.php";

try {
    $pdo = conectar();

    $idasp = getIDByUser($_SESSION['usuario']);

    $A = $B = $C = $D = 0;
    $ResultA = $ResultB = $ResultC = $ResultD = 0;

    for ($i = 1; $i <= 31; $i++) {
        $valor = asignarValor($i, $_POST['preg' . $i]);

        if ($i >= 1 && $i <= 8) {
            $A += $valor;
        } else if ($i >= 9 && $i <= 12) {
            $B += $valor;
        } else if ($i >= 13 && $i <= 22) {
            $C += $valor;
        } else if ($i >= 23 && $i <= 31) {
            $D += $valor;
        }
    }

    $ResultA = ($A / 8) * 4;
    $ResultB = ($B / 4) * 3;
    $ResultC = ($C / 10) * 2;
    $ResultD = $D / 9;

    $puntajeBrutoTotal = round($ResultA + $ResultB + $ResultC + $ResultD, 1);
    $puntajeTransformado = round(($puntajeBrutoTotal / 61.16) * 100, 1);

    if ($puntajeTransformado > 100) {
        $puntajeTransformado = 100;
    }

    $baremosPTC = ($_SESSION['cargo'] == 'jefe') 
        ? baremosPTCEstresJefe($puntajeTransformado) 
        : baremosPTCEstresAux($puntajeTransformado);

    $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante)
            VALUES (:numero, :puntajeTransformado, :baremosPTC, :idasp)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':numero', $_POST['numero'], PDO::PARAM_STR);
    $stmt->bindParam(':puntajeTransformado', $puntajeTransformado, PDO::PARAM_STR);
    $stmt->bindParam(':baremosPTC', $baremosPTC, PDO::PARAM_STR);
    $stmt->bindParam(':idasp', $idasp, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../cuestionarios.php?c=2");
    } else {
        echo "<center><h1>Error al guardar los datos</h1></center>";
    }

} catch (PDOException $e) {
    echo "<center><h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1></center>";
}

$pdo = null;

function asignarValor($i, $valor) {
    $nuevoValor = 0;
    $items1 = [1, 2, 3, 9, 13, 14, 15, 23, 24];
    $items2 = [4, 5, 6, 10, 11, 16, 17, 18, 19, 25, 26, 27, 28];
    $items3 = [7, 8, 12, 20, 21, 22, 29, 30, 31];

    $valores = [
        'siempre' => [9, 6, 3],
        'casi siempre' => [6, 4, 2],
        'a veces' => [3, 2, 1],
        'nunca' => [0, 0, 0],
    ];

    if (in_array($i, $items1)) {
        $nuevoValor = $valores[$valor][0] ?? 0;
    } else if (in_array($i, $items2)) {
        $nuevoValor = $valores[$valor][1] ?? 0;
    } else if (in_array($i, $items3)) {
        $nuevoValor = $valores[$valor][2] ?? 0;
    }

    return $nuevoValor;
}
