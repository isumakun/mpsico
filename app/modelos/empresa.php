<?php

require "../funciones.php";

function agregarEmpresa($nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad, $imagen) {
    $pdo = conectar();
    $prefijo = substr(md5(uniqid(rand())), 0, 6);
    $ruta = null;

    try {
        if (!empty($imagen['name'])) {
            $formatos = array('image/jpeg', 'image/jpg', 'image/png');
            $maxSize = 2000000; // 2 MB

            if ($imagen['size'] < $maxSize) {
                if (in_array($imagen['type'], $formatos)) {
                    $uploadDir = "../logos/";
                    $fileName = $prefijo . basename($imagen['name']);
                    $filePath = $uploadDir . $fileName;

                    if (move_uploaded_file($imagen['tmp_name'], $filePath)) {
                        $ruta = "logos/" . $fileName;
                    } else {
                        throw new Exception("No se pudo mover el archivo.");
                    }
                } else {
                    throw new Exception("Formato de imagen no válido.");
                }
            } else {
                throw new Exception("El archivo excede el tamaño máximo permitido.");
            }
        }

        $sql = "INSERT INTO empresa (Nit, Nombre, Direccion, Telefono, Email, Sector, Ciudad, Logo)
                VALUES (:nit, :nombre, :direccion, :telefono, :email, :sector, :ciudad, :ruta)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nit' => $nit,
            ':nombre' => $nombre,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':email' => $email,
            ':sector' => $sector,
            ':ciudad' => $ciudad,
            ':ruta' => $ruta
        ]);

        header("Location: ../empresas?estado=guardado");

    } catch (Exception $e) {
        echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
    }
}

function eliminarEmpresa($idEmpresa) {
    $pdo = conectar();

    try {
        $sql = "DELETE FROM empresa WHERE idEmpresa = :idEmpresa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idEmpresa' => $idEmpresa]);

        header("Location: ../empresas");
    } catch (PDOException $e) {
        echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
        header("Location: ../empresas?estado=errordatos");
    }
}

function editarEmpresa($idEmpresa, $nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad, $imagen) {
    $pdo = conectar();
    $prefijo = substr(md5(uniqid(rand())), 0, 6);

    try {
        if (!empty($imagen['name'])) {
            $formatos = array('image/jpeg', 'image/jpg', 'image/png');
            $maxSize = 2000000; // 2 MB

            if ($imagen['size'] < $maxSize) {
                if (in_array($imagen['type'], $formatos)) {
                    $uploadDir = "../logos/";
                    $fileName = $prefijo . basename($imagen['name']);
                    $filePath = $uploadDir . $fileName;

                    if (move_uploaded_file($imagen['tmp_name'], $filePath)) {
                        $ruta = "logos/" . $fileName;
                        $sql = "UPDATE empresa
                                SET Nit = :nit, Nombre = :nombre, Direccion = :direccion,
                                    Telefono = :telefono, Email = :email, Sector = :sector,
                                    Ciudad = :ciudad, Logo = :ruta
                                WHERE idEmpresa = :idEmpresa";
                        $params = [
                            ':nit' => $nit,
                            ':nombre' => $nombre,
                            ':direccion' => $direccion,
                            ':telefono' => $telefono,
                            ':email' => $email,
                            ':sector' => $sector,
                            ':ciudad' => $ciudad,
                            ':ruta' => $ruta,
                            ':idEmpresa' => $idEmpresa
                        ];
                    } else {
                        throw new Exception("No se pudo mover el archivo.");
                    }
                } else {
                    throw new Exception("Formato de imagen no válido.");
                }
            } else {
                throw new Exception("El archivo excede el tamaño máximo permitido.");
            }
        } else {
            $sql = "UPDATE empresa
                    SET Nit = :nit, Nombre = :nombre, Direccion = :direccion,
                        Telefono = :telefono, Email = :email, Sector = :sector,
                        Ciudad = :ciudad
                    WHERE idEmpresa = :idEmpresa";
            $params = [
                ':nit' => $nit,
                ':nombre' => $nombre,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':email' => $email,
                ':sector' => $sector,
                ':ciudad' => $ciudad,
                ':idEmpresa' => $idEmpresa
            ];
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        header("Location: ../empresas?estado=guardado");

    } catch (Exception $e) {
        echo "<center><h1>Error: " . $e->getMessage() . "</h1></center>";
    }
}
?>