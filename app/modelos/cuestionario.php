<?php

require "../funciones.php";

function nuevoCuestionario($nombre, $idAspirante) {

    $link = conectar();

    $sql = "INSERT INTO cuestionario
            (
             Nombre,
             Aspirante_idAspirante)
            VALUES (
                    '$nombre',
                    '$idAspirante');";

    mysql_query($sql, $link);

    $id = mysql_insert_id();

    for ($i = 1; $i < 32; $i++) {

        $sql = "INSERT INTO pregunta
            (
             numero,
             respuesta,
             Cuestionario_idCuestionario)
            VALUES (
                    '$i',
                    '{$_POST['preg' + $i]}',
                    '$id');";

                    mysql_query($sql, $link);
    }

    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../pruebas.php?estado=guardado");
    } else {
        //header("Location: ../nuevoEmpresa.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }

    mysql_close($link);
}

function eliminarEmpresa($idEmpresa) {
    $link = conectar();
    $sql = "DELETE
            FROM empresa
            WHERE idEmpresa = $idEmpresa";

    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../empresas.php");
    } else {
        header("Location: ../empresas.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}

function editarEmpresa($idEmpresa, $nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad) {
    $link = conectar();

    $sql = "UPDATE empresa
            SET 
              Nit = '$nit',
              Nombre = '$nombre',
              Direccion = '$direccion',
              Telefono = '$telefono',
              Email = '$email',
              Sector = '$sector',
              Ciudad = '$ciudad'
            WHERE idEmpresa = '$idEmpresa';";

    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../empresas.php?estado=guardado");
    } else {
        // header("Location: ../index3.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}
