<?php

include '../excel_reader/excel_reader.php'; // include the class
include '../funciones.php';

ini_set('max_execution_time', 300); //300 seconds = 5 minutes

$mensaje;
$target_dir = "../informes/";
$target_file = $target_dir . basename($_FILES["excel"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
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
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
        
    } else {
        $mensaje = "Sorry, there was an error uploading your file.";
    }
}

$excel = new PhpExcelReader;      // creates object instance of the class
$excel->read($target_dir . basename($_FILES["excel"]["name"]));   // reads and stores the excel file data
// this function creates and returns a HTML table with excel rows and columns data
// Parameter - array with excel worksheet data

function insertarDominio($puntaje, $valor, $id) {

    $link = conectar();

    $pun = round($puntaje, 1);

    $sql = "INSERT INTO dominio
            (
             Valor,
             Puntaje,
             Cuestionario_idCuestionario)
    VALUES (
            '$valor',
            '$pun',
            '$id');";

    mysql_query($sql);
    //echo $sql . "<br>";
}

function insertarDimension($puntaje, $valor, $id) {

    $link = conectar();

    $sql = "INSERT INTO dimension
            (
             Valor,
             Puntaje,
             Cuestionario_idCuestionario)
    VALUES (
            '$valor',
            '$puntaje',
            '$id');";

    mysql_query($sql);
    //echo $sql . "<br>";
}

function insertarAspirante($nombre, $id) {

    $link = conectar();

    $nombre = utf8_encode($nombre);

    //echo $nombre . "<br>";

    $sql = "INSERT INTO aspirante
            (idAspirante,
            Nombre,
             Empresa_idEmpresa)
             VALUES ('$id',
                        '$nombre',
                        '{$_POST['empresa']}');";

    mysql_query($sql);
    //echo $sql . "<br>";
}

function insertarCuestionario($datos, $datos2, $puntajesDom, $valoresDom, $numero, $id) {

    $link = conectar();

    if ($numero == 1) {
        $puntaje = $datos[0];
        $valor = $datos[1];

        $sql = "INSERT INTO cuestionario
            (
             Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
              VALUES (
                        '$numero',
                        '$puntaje',
                        '$valor',
                        '$id');";
        mysql_query($sql);
        //echo $sql . "<br>";
    } else if ($numero == 2) {
        $sumaDimension = array();
        $factoresDimen = [16, 12, 20, 12, 36, 12, 16];
        for ($j = 0; $j <= 6; $j++) {
            array_push($sumaDimension, transformarInversaExtra($datos[$j], $factoresDimen[$j]));
        }

        $PTC = array_sum($sumaDimension);
        $trans = transformarForma($PTC, 124);
        $baremo = baremosPTCExtraAux($trans);

        $sql = "INSERT INTO cuestionario
            (
             Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
              VALUES (
                        '$numero',
                        '$trans',
                        '$baremo',
                        '$id');";
        mysql_query($sql);
        //echo $sql . "<br>";

        $idCuestionario = mysql_insert_id();

        for ($i = 0; $i <= 6; $i++) {
            insertarDimension($datos[$i], $datos2[$i], $idCuestionario);
        }
    } else if ($numero == 3) {

        $sumaDom = array();
        $factoresDomin = [164, 84, 200, 44];
        for ($j = 0; $j <= 2; $j++) {
            array_push($sumaDom, transformarInversaExtra($datos[$j], $factoresDomin[$j]));
        }

        $PTC = array_sum($sumaDom);
        $trans = transformarForma($PTC, 492);
        $baremo = baremosTotalFormaA($trans);

        $sql = "INSERT INTO cuestionario
            (Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
              VALUES (
                        '$numero',
                        '$trans',
                        '$baremo',
                        '$id');";
        mysql_query($sql);
        //echo $sql . "<br>";

        $idCuestionario = mysql_insert_id();

        for ($i = 0; $i <= 18; $i++) {
            insertarDimension($datos[$i], $datos2[$i], $idCuestionario);
        }

        for ($i = 0; $i <= 3; $i++) {
            insertarDominio($puntajesDom[$i], $valoresDom[$i], $idCuestionario);
        }
    } else if ($numero == 4) {

        $sumaDom = array();
        $factoresDomin = [120, 72, 156, 40];
        for ($j = 0; $j <= 2; $j++) {
            array_push($sumaDom, transformarInversaExtra($datos[$j], $factoresDomin[$j]));
        }

        $PTC = array_sum($sumaDom);
        $trans = transformarForma($PTC, 388);
        $baremo = baremosTotalFormaB($trans);

        $sql = "INSERT INTO cuestionario
            (Numero,
             PTC,
             BaremoPTC,
             Aspirante_idAspirante)
              VALUES ('$numero',
                        '$trans',
                        '$baremo',
                        '$id');";
        mysql_query($sql);
        //echo $sql . "<br>";

        $idCuestionario = mysql_insert_id();

        for ($i = 0; $i <= 14; $i++) {
            insertarDimension($datos[$i], $datos2[$i], $idCuestionario);
        }

        for ($i = 0; $i <= 3; $i++) {
            insertarDominio($puntajesDom[$i], $valoresDom[$i], $idCuestionario);
        }
    }
}

function sheetData($sheet, $forma) {

    if ($forma === "forma A") {
        $dominiosForma = [4, 5, 14, 15, 26, 27, 44, 45];
        $dimensionesForma = [6, 7, 8, 9, 10, 11, 12, 13, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25,
            28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 46, 47, 48, 49];
        $dimensionesExtra = [50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63];
        $puntajesEstres = [64, 65];
    } else {
        $dominiosForma = [4, 5, 12, 13, 24, 25, 38, 39];
        $dimensionesForma = [6, 7, 8, 9, 10, 11, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 26, 27,
            28, 29, 30, 31, 32, 33, 34, 35, 36, 40, 41, 42, 43];
        $dimensionesExtra = [44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
        $puntajesEstres = [58, 59];
    }

    $nombre = "";
    $id = "";
    $aux = 0;

    $x = 1;
    while ($x <= $sheet['numRows']) {
        $datosAuxDomPuntaje = [];
        $datosAuxDomValor = [];
        $datosAuxDimPuntaje = [];
        $datosAuxDimValor = [];

        $datosAuxDimExtraPuntaje = [];
        $datosAuxDimExtraValor = [];

        $datosAuxEstres = [];

        $y = 1;
        while ($y <= $sheet['numCols']) {
            $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
            if ($x != 1) {
                if ($y == 2) {
                    $id = $cell;
                }
                if ($y == 3) {
                    $nombre = $cell;
                    insertarAspirante($nombre, $id);
                }
                if (in_array($y, $dominiosForma)) {
                    if (is_numeric($cell)) {
                        array_push($datosAuxDomPuntaje, $cell);
                    } else {
                        array_push($datosAuxDomValor, $cell);
                    }
                } else if (in_array($y, $dimensionesForma)) {
                    if (is_numeric($cell)) {
                        array_push($datosAuxDimPuntaje, $cell);
                    } else {
                        array_push($datosAuxDimValor, $cell);
                    }
                } else if (in_array($y, $dimensionesExtra)) {
                    if (is_numeric($cell)) {
                        array_push($datosAuxDimExtraPuntaje, $cell);
                    } else {
                        array_push($datosAuxDimExtraValor, $cell);
                    }
                } else if (in_array($y, $puntajesEstres)) {
                    array_push($datosAuxEstres, $cell);
                    
                    if ($forma === "forma A") {
                    if ($y == 65) {
                        //Insertar cuestionario estres
                        insertarCuestionario($datosAuxEstres, 0, 0, 0, 1, $id);
                        //Insertar cuestionario Extralaboral

                        /* print_r($datosAuxDimExtraPuntaje);
                          echo '<br><br>';
                          print_r($datosAuxDimExtraValor); */
                        insertarCuestionario($datosAuxDimExtraPuntaje, $datosAuxDimExtraValor, 0, 0, 2, $id);
                        //Insertar cuestionario Intralaboral Forma A
                        insertarCuestionario($datosAuxDimPuntaje, $datosAuxDimValor, $datosAuxDomPuntaje, $datosAuxDomValor, 3, $id);

                        unset($datosAuxDomPuntaje);
                        unset($datosAuxDomValor);
                        unset($datosAuxDimPuntaje);
                        unset($datosAuxDimValor);

                        unset($datosAuxDimExtraPuntaje);
                        unset($datosAuxDimExtraValor);

                        unset($datosAuxEstres);
                    }
                } else if ($forma === "forma B") {
                    if ($y == 59) {
                        //Insertar cuestionario estres
                        insertarCuestionario($datosAuxEstres, 0, 0, 0, 1, $id);
                        //Insertar cuestionario Extralaboral

                        /* print_r($datosAuxDimExtraPuntaje);
                          echo '<br><br>';
                          print_r($datosAuxDimExtraValor); */
                        insertarCuestionario($datosAuxDimExtraPuntaje, $datosAuxDimExtraValor, 0, 0, 2, $id);

                        //Insertar cuestionario Intralaboral Forma B
                        insertarCuestionario($datosAuxDimPuntaje, $datosAuxDimValor, $datosAuxDomPuntaje, $datosAuxDomValor, 4, $id);

                        unset($datosAuxDomPuntaje);
                        unset($datosAuxDomValor);
                        unset($datosAuxDimPuntaje);
                        unset($datosAuxDimValor);

                        unset($datosAuxDimExtraPuntaje);
                        unset($datosAuxDimExtraValor);

                        unset($datosAuxEstres);
                    }
                }
                }
            }
            $y++;
        }
        $x++;
    }
}

$nr_sheets = count($excel->sheets);       // gets the number of worksheets
$excel_data = '';              // to store the the html tables with data of each sheet
// traverses the number of sheets and sets html table with each sheet data in $excel_data
for ($i = 0; $i < 2; $i++) {
    if ($uploadOk == 1) {
        $excel_data .= '' . $excel->boundsheets[$i]['name'] . '' . sheetData($excel->sheets[$i], $excel->boundsheets[$i]['name']) . '<br/>';
    }
}

header('Location: ../informes.php');      // outputs HTML tables with excel file data