<?php

require "../funciones.php";

function agregarAspirante($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $email, $empresa, $forma) {

    $link = conectar();

    $sql1 = "INSERT INTO usuario
            (
             usuario,
             password,
             tipo)
            VALUES (
                    '$cedula',
                    '$cedula',
                    '2');";

    mysql_query($sql1, $link);

    $id = mysql_insert_id();

    $nombre = utf8_encode($nombre);
    $apellido1 = utf8_encode($apellido1);
    $apellido2 = utf8_encode($apellido2);
    
    $sql2 = "INSERT INTO aspirante
            (
             Cedula,
             Nombre,
             Apellido1,
             Apellido2,
             Telefono,
             Direccion,
             Email,
             Forma,
             Usuario_idUsuario,
             Empresa_idEmpresa)
        VALUES (
        '$cedula',
        '$nombre',
        '$apellido1',
        '$apellido2',
        '$telefono',
        '$direccion',
        '$email',
        '$forma',
        '$id',
        '$empresa');";

    mysql_query($sql2, $link);

    $error = mysql_error($link);

    if ($error == null) {
        echo "ok";
    } else {
        //header("Location: ../nuevoAspirante.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }

    mysql_close($link);
}

function eliminarAspirante($idAspirante) {

    $link = conectar();
    $sql = "DELETE
            FROM aspirante
            WHERE idAspirante = $idAspirante";



    mysql_query($sql, $link);
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../aspirantes.php");
    } else {
        header("Location: ../aspirantes.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}

function editarAspirante($idAspirante, $cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $email, $empresa, $forma) {
    $link = conectar();

    $hayUsuario = "Select * from usuario where usuario = " . $cedula;
    $result = mysql_query($hayUsuario, $link);

    if (mysql_num_rows($result) == 0) {
        
        $sqlUser = "INSERT INTO usuario
            (
             usuario,
             password,
             tipo)
            VALUES (
                    '$cedula',
                    '$cedula',
                    '2');";

        mysql_query($sqlUser, $link);

        $id = mysql_insert_id();

        $sqlAsp = "UPDATE aspirante
                SET 
                  Cedula = '$cedula',
                  Nombre = '$nombre',
                  Apellido1 = '$apellido1',
                  Apellido2 = '$apellido2',
                  Telefono = '$telefono',
                  Direccion = '$direccion',
                  Email = '$email',
                  Forma = '$forma',
                  Usuario_idUsuario = '$id',
                  Empresa_idEmpresa = '$empresa'
                WHERE idAspirante = '$idAspirante';";

        mysql_query($sqlAsp, $link);
        
    } else {
        
        $sql = "UPDATE aspirante
                SET 
                  Cedula = '$cedula',
                  Nombre = '$nombre',
                  Apellido1 = '$apellido1',
                  Apellido2 = '$apellido2',
                  Telefono = '$telefono',
                  Direccion = '$direccion',
                  Email = '$email',
                  Empresa_idEmpresa = '$empresa'
                WHERE idAspirante = '$idAspirante';";

        mysql_query($sql, $link);
        
    }
    $error = mysql_error($link);

    if ($error == null) {
        header("Location: ../aspirantes.php?estado=guardado");
    } else {
        // header("Location: ../index3.php?estado=errordatos");
        echo "<center>";
        echo "<h1> " . $error . "</h1>";
        echo "</center>";
    }
    mysql_close($link);
}
