<?php

include '../excel_reader/excel_reader.php';
include '../funciones.php';

ini_set('max_execution_time', 300);

$mensaje;
$target_dir = "../informes/";
$target_file = $target_dir . basename($_FILES["excel"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["excel"]["tmp_name"]);
    if ($check !== false) {
        $mensaje = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $mensaje = "File is not an image.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    $mensaje = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
        
    } else {
        $mensaje = "Sorry, there was an error uploading your file.";
    }
}

$excel = new PhpExcelReader;
$excel->read($target_dir . basename($_FILES["excel"]["name"]));

function insertar_dominio($puntaje, $valor, $id) {
    $link = conectar();
    $pun = round($puntaje, 1);

    $sql = "INSERT INTO dominio (Valor, Puntaje, Cuestionario_idCuestionario)
            VALUES (:valor, :puntaje, :id)";
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':puntaje', $pun);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function insertar_dimension($puntaje, $valor, $id) {
    $link = conectar();

    $sql = "INSERT INTO dimension (Valor, Puntaje, Cuestionario_idCuestionario)
            VALUES (:valor, :puntaje, :id)";
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':puntaje', $puntaje);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function insertar_aspirante($nombre, $id) {
    $link = conectar();
    $nombre = utf8_encode($nombre);

    $sql = "INSERT INTO aspirante (idAspirante, Nombre, Empresa_idEmpresa)
            VALUES (:id, :nombre, :empresa)";
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':empresa', $_POST['empresa']);
    $stmt->execute();
}

function insertar_cuestionario($datos, $datos2, $puntajesDom, $valoresDom, $numero, $id) {
    $link = conectar();

    if ($numero == 1) {
        $puntaje = $datos[0];
        $valor = $datos[1];

        $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante)
                VALUES (:numero, :puntaje, :valor, :id)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':puntaje', $puntaje);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } else if ($numero == 2) {
        $sumaDimension = [];
        $factoresDimen = [16, 12, 20, 12, 36, 12, 16];
        for ($j = 0; $j <= 6; $j++) {
            array_push($sumaDimension, transformarInversaExtra($datos[$j], $factoresDimen[$j]));
        }

        $PTC = array_sum($sumaDimension);
        $trans = transformarForma($PTC, 124);
        $baremo = baremosPTCExtraAux($trans);

        $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante)
                VALUES (:numero, :trans, :baremo, :id)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':trans', $trans);
        $stmt->bindParam(':baremo', $baremo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $idCuestionario = $link->lastInsertId();
        for ($i = 0; $i <= 6; $i++) {
            insertar_dimension($datos[$i], $datos2[$i], $idCuestionario);
        }
    } else if ($numero == 3) {
        $sumaDom = [];
        $factoresDomin = [164, 84, 200, 44];
        for ($j = 0; $j <= 2; $j++) {
            array_push($sumaDom, transformarInversaExtra($datos[$j], $factoresDomin[$j]));
        }

        $PTC = array_sum($sumaDom);
        $trans = transformarForma($PTC, 492);
        $baremo = baremosTotalFormaA($trans);

        $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante)
                VALUES (:numero, :trans, :baremo, :id)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':trans', $trans);
        $stmt->bindParam(':baremo', $baremo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $idCuestionario = $link->lastInsertId();
        for ($i = 0; $i <= 18; $i++) {
            insertar_dimension($datos[$i], $datos2[$i], $idCuestionario);
        }
        for ($i = 0; $i <= 3; $i++) {
            insertar_dominio($puntajesDom[$i], $valoresDom[$i], $idCuestionario);
        }
    } else if ($numero == 4) {
        $sumaDom = [];
        $factoresDomin = [120, 72, 156, 40];
        for ($j = 0; $j <= 2; $j++) {
            array_push($sumaDom, transformarInversaExtra($datos[$j], $factoresDomin[$j]));
        }

        $PTC = array_sum($sumaDom);
        $trans = transformarForma($PTC, 388);
        $baremo = baremosTotalFormaB($trans);

        $sql = "INSERT INTO cuestionario (Numero, PTC, BaremoPTC, Aspirante_idAspirante)
                VALUES (:numero, :trans, :baremo, :id)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':trans', $trans);
        $stmt->bindParam(':baremo', $baremo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $idCuestionario = $link->lastInsertId();
        for ($i = 0; $i <= 14; $i++) {
            insertar_dimension($datos[$i], $datos2[$i], $idCuestionario);
        }
        for ($i = 0; $i <= 3; $i++) {
            insertar_dominio($puntajesDom[$i], $valoresDom[$i], $idCuestionario);
        }
    }
}

function sheetData($sheet, $forma) {
    if ($forma === "forma A") {
        $dominiosForma = [4, 5, 14, 15, 26, 27, 44, 45];
        $dimensionesForma = [6, 7, 8, 9, 10, 11, 12, 13, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 46, 47, 48, 49];
        $dimensionesExtra = [50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63];
        $puntajesEstres = [64, 65];
    } else {
        $dominiosForma = [4, 5, 12, 13, 24, 25, 38, 39];
        $dimensionesForma = [6, 7, 8, 9, 10, 11, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 40, 41, 42, 43];
        $dimensionesExtra = [44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55];
        $puntajesEstres = [56, 57];
    }

    $datosAspirantes = array();
    $datosCuestionarios = array();
    $datosDimensiones = array();
    $datosDominio = array();
    $esIdentidad = false;
    $tipoIdentidad = "";
    $resultado = "";

    $link = conectar();

    for ($x = 2; $x <= count($sheet); $x++) {
        $id = $sheet[$x]['cells'][1][1];
        $esIdentidad = $id !== "";

        if (!$esIdentidad) {
            continue;
        }
        insertar_aspirante($sheet[$x]['cells'][1][2], $id);
        
        for ($j = 3; $j <= 6; $j++) {
            array_push($datosCuestionarios, $sheet[$x]['cells'][1][$j]);
        }

        $nombres_dimensiones = ["CL", "IN", "RD", "EM", "PR", "RE", "AU", "VI"];
        $nombres_dominios = ["EL", "CA", "RA", "EV"];

        $cuestionarios = count($sheet[$x]['cells'][1]);
        for ($i = 2; $i <= $cuestionarios; $i++) {
            $celda = explode("-", $sheet[$x]['cells'][1][$i]);
            if (count($celda) === 2) {
                $valor = $celda[0];
                $puntaje = $celda[1];
                $col = $i - 1;

                $idCuestionario = $link->lastInsertId();

                if (in_array($col, $dimensionesForma)) {
                    insertar_dimension($puntaje, $valor, $idCuestionario);
                } elseif (in_array($col, $dominiosForma)) {
                    insertar_dominio($puntaje, $valor, $idCuestionario);
                }
            }
        }
    }

    return $resultado;
}

?>
