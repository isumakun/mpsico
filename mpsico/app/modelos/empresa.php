<?php

require "../funciones.php";

function agregarEmpresa($nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad, $imagen) {

    $link = conectar();

    $_FILES["imagen"] = $imagen;

    $formatos = array('image/jpeg', 'image/jpg', 'image/png');
    $prefijo = substr(md5(uniqid(rand())), 0, 6);
    $ruta = null;

    if (!$_FILES["imagen"]["size"] == 0) {
        if ($_FILES["imagen"]["size"] < 2000000) {
            if (isset($_FILES['imagen'])) {
                if (in_array($_FILES['imagen']['type'], $formatos)) {
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], "../logos/" . $prefijo . $_FILES['imagen']['name'])) {
                        $ruta = "fotos/" . $prefijo . $_FILES['imagen']['name'];

                        $sql = "INSERT INTO empresa
                            (Nit,
                             Nombre,
                             Direccion,
                             Telefono,
                             Email,
                             Sector,
                             Ciudad,
                             Logo)
                             VALUES ('$nit',
                                        '$nombre',
                                        '$direccion',
                                        '$telefono',
                                        '$email',
                                        '$sector',
                                        '$ciudad', '$ruta');";

                        mysql_query($sql, $link);

                        $error = mysql_error($link);

                        if ($error == null) {
                            header("Location: ../empresas.php?estado=guardado");
                        } else {
                            //header("Location: ../nuevoEmpresa.php?estado=errordatos");
                            echo "<center>";
                            echo "<h1> " . $error . "</h1>";
                            echo "</center>";
                        }

                        mysql_close($link);
                    } else {
                        header("Location: ../empresas.php?estado=archivoNoMovido");
                    }
                } else {
                    echo 'Error en la imagen';
                }
            } else {
                header("Location: ../empresas.php?estado=nohayArchivo");
            }
        } else {
            header("Location: ../empresas.php?estado=errorTamaño");
        }
    }else{
        $sql = "INSERT INTO empresa
                            (Nit,
                             Nombre,
                             Direccion,
                             Telefono,
                             Email,
                             Sector,
                             Ciudad
                             )
                             VALUES ('$nit',
                                        '$nombre',
                                        '$direccion',
                                        '$telefono',
                                        '$email',
                                        '$sector',
                                        '$ciudad');";

                        mysql_query($sql, $link);

                        $error = mysql_error($link);

                        if ($error == null) {
                            header("Location: ../empresas.php?estado=guardado");
                        } else {
                            //header("Location: ../nuevoEmpresa.php?estado=errordatos");
                            echo "<center>";
                            echo "<h1> " . $error . "</h1>";
                            echo "</center>";
                        }

                        mysql_close($link);
    }
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

function editarEmpresa($idEmpresa, $nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad, $imagen) {
    $link = conectar();

    $_FILES["imagen"] = $imagen;

    if ($_FILES["imagen"]["size"] == 0) {

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
    } else {
        $formatos = array('image/jpeg', 'image/jpg', 'image/png');
        $prefijo = substr(md5(uniqid(rand())), 0, 6);
        $ruta = null;

        if ($_FILES["imagen"]["size"] < 2000000) {
            if (isset($_FILES['imagen'])) {
                if (in_array($_FILES['imagen']['type'], $formatos)) {
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], "../logos/" . $prefijo . $_FILES['imagen']['name'])) {
                        $ruta = "logos/" . $prefijo . $_FILES['imagen']['name'];

                        $sql = "UPDATE empresa
                                SET 
                                  Nit = '$nit',
                                  Nombre = '$nombre',
                                  Direccion = '$direccion',
                                  Telefono = '$telefono',
                                  Email = '$email',
                                  Sector = '$sector',
                                  Ciudad = '$ciudad',
                                  Logo = '$ruta'
                                WHERE idEmpresa = '$idEmpresa';";

                        mysql_query($sql, $link);
                    } else {
                        header("Location: ../empresas.php?estado=archivoNoMovido");
                    }
                } else {
                    //echo $imagen;
                }
            } else {
                header("Location: ../empresas.php?estado=nohayArchivo");
            }
        } else {
            header("Location: ../empresas.php?estado=errorTamaño");
        }
    }

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
