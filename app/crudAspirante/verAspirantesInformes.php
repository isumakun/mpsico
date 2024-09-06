<?php

require_once 'entidades/aspirante.php';
require_once 'funciones.php';

header('Content-Type: application/json');

try {
    $pdo = conectar();

    // Consulta principal
    $sql = "SELECT
                aspirante.idAspirante,
                aspirante.Cedula,
                empresa.Nombre,
                empresa.idEmpresa
            FROM
                aspirante
            INNER JOIN empresa 
            ON aspirante.Empresa_idEmpresa = empresa.idEmpresa";
    
    $stmt = $pdo->query($sql);
    
    $lista = array();
    
    while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row = array();
        $row['idAspirante'] = $line['idAspirante'];
        $row['Cedula'] = $line['Cedula'];
        $row['Nombre'] = $line['Nombre'];
        
        // Consulta secundaria para cuestionarios
        $sql2 = "SELECT
                    cuestionario.idCuestionario,
                    cuestionario.Numero
                 FROM
                    cuestionario
                 WHERE cuestionario.Aspirante_idAspirante = :idAspirante";
        
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':idAspirante', $line['idAspirante'], PDO::PARAM_INT);
        $stmt2->execute();
        
        $cuestionarios = array();
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $cuestionarios[] = array(
                'Numero' => $row2['Numero'],
                'idCuestionario' => $row2['idCuestionario']
            );
        }
        
        $row['cuestionarios'] = $cuestionarios;
        $lista[] = $row;
    }

    echo json_encode($lista, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

$pdo = null;
