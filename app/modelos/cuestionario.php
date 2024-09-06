<?php

require "../funciones.php";

function nuevoCuestionario($nombre, $idAspirante) {
    $link = conectar();
    
    try {
        // Insertar en cuestionario
        $sql = "INSERT INTO cuestionario (Nombre, Aspirante_idAspirante) VALUES (:nombre, :idAspirante)";
        $stmt = $link->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':idAspirante' => $idAspirante
        ]);
        
        $id = $link->lastInsertId();
        
        // Insertar en pregunta
        for ($i = 1; $i < 32; $i++) {
            $respuesta = $_POST['preg' . $i];
            
            $sql = "INSERT INTO pregunta (numero, respuesta, Cuestionario_idCuestionario) VALUES (:numero, :respuesta, :idCuestionario)";
            $stmt = $link->prepare($sql);
            $stmt->execute([
                ':numero' => $i,
                ':respuesta' => $respuesta,
                ':idCuestionario' => $id
            ]);
        }
        
        header("Location: ../pruebas.php?estado=guardado");
    } catch (PDOException $e) {
        echo "<center><h1>" . $e->getMessage() . "</h1></center>";
    }
}

function eliminarEmpresa($idEmpresa) {
    $link = conectar();
    
    try {
        $sql = "DELETE FROM empresa WHERE idEmpresa = :idEmpresa";
        $stmt = $link->prepare($sql);
        $stmt->execute([
            ':idEmpresa' => $idEmpresa
        ]);

        header("Location: ../empresas.php");
    } catch (PDOException $e) {
        header("Location: ../empresas.php?estado=errordatos");
        echo "<center><h1>" . $e->getMessage() . "</h1></center>";
    }
}

function editarEmpresa($idEmpresa, $nit, $nombre, $direccion, $telefono, $email, $sector, $ciudad) {
    $link = conectar();
    
    try {
        $sql = "UPDATE empresa SET Nit = :nit, Nombre = :nombre, Direccion = :direccion, Telefono = :telefono, Email = :email, Sector = :sector, Ciudad = :ciudad WHERE idEmpresa = :idEmpresa";
        $stmt = $link->prepare($sql);
        $stmt->execute([
            ':nit' => $nit,
            ':nombre' => $nombre,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':email' => $email,
            ':sector' => $sector,
            ':ciudad' => $ciudad,
            ':idEmpresa' => $idEmpresa
        ]);
        
        header("Location: ../empresas.php?estado=guardado");
    } catch (PDOException $e) {
        header("Location: ../empresas.php?estado=errordatos");
        echo "<center><h1>" . $e->getMessage() . "</h1></center>";
    }
}

?>
