<?php

require "../funciones.php";

function agregarAspirante($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $email, $empresa, $forma) {
    $link = conectar();

    // Preparar y ejecutar la inserción en la tabla usuario
    $sql1 = "INSERT INTO usuario (usuario, password, tipo) VALUES ('$cedula', sha1('$cedula'), '2')";
    $link->query($sql1);

    $id = $link->lastInsertId();

    // Preparar y ejecutar la inserción en la tabla aspirante
    $sql2 = "INSERT INTO aspirante (Cedula, Nombre, Apellido1, Apellido2, Telefono, Direccion, Email, Forma, Usuario_idUsuario, Empresa_idEmpresa)
             VALUES ('$cedula', '$nombre', '$apellido1', '$apellido2', '$telefono', '$direccion', '$email', '$forma', $id, $empresa)";

    if ($link->query($sql2)) {
        echo "ok";
    } else {
        echo "<center><h1></h1></center>";
        // header("Location: ../nuevoAspirante.php?estado=errordatos");
    }
}

function eliminarAspirante($idAspirante) {
    $link = conectar();

    $sql = "DELETE FROM aspirante WHERE idAspirante = $idAspirante";

    if ($link->query($sql)) {
        header("Location: ../aspirantes.php");
    } else {
        header("Location: ../aspirantes.php?estado=errordatos");
    }
}

function editarAspirante($idAspirante, $cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $email, $empresa, $forma) {
    $link = conectar();

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuario WHERE usuario = '$cedula'";
    $result = $link->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        // Crear nuevo usuario si no existe
        $sqlUser = "INSERT INTO usuario (usuario, password, tipo) VALUES ('$cedula', '$cedula', '2')";
        $link->query($sqlUser);
        $id = $link->lastInsertId();

        // Actualizar aspirante con nuevo usuario
        $sqlAsp = "UPDATE aspirante
                   SET Cedula = '$cedula', Nombre = '$nombre', Apellido1 = '$apellido1', Apellido2 = '$apellido2', Telefono = '$telefono', Direccion = '$direccion', Email = '$email', Forma = '$forma', Usuario_idUsuario = $id, Empresa_idEmpresa = $empresa
                   WHERE idAspirante = $idAspirante";
        $link->query($sqlAsp);

    } else {
        // Actualizar aspirante sin modificar el usuario
        $sql = "UPDATE aspirante
                SET Cedula = '$cedula', Nombre = '$nombre', Apellido1 = '$apellido1', Apellido2 = '$apellido2', Telefono = '$telefono', Direccion = '$direccion', Email = '$email', Empresa_idEmpresa = $empresa
                WHERE idAspirante = $idAspirante";
        $link->query($sql);
    }

    header("Location: ../aspirantes.php?estado=guardado");
}
