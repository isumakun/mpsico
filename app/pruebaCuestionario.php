<?php

require './funciones.php';

$link = conectar();

try {
    // Seleccionar aspirantes
    $sql = "SELECT *
            FROM aspirante
            INNER JOIN cuestionario 
                ON aspirante.idAspirante = cuestionario.Aspirante_idAspirante
            WHERE cuestionario.Numero = :numero
            AND Empresa_idEmpresa = :empresaId";
            
    $stmt = $link->prepare($sql);
    $stmt->execute([
        ':numero' => 3,
        ':empresaId' => 1
    ]);
    
    $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cantidad = count($aspirantes);
    echo "cantidad: " . $cantidad . "<br>";
    
    $promedioDom = array_fill(0, 4, 0);
    $promedioDim = array_fill(0, 18, 0);

    foreach ($aspirantes as $line) {
        // Obtener puntajes de dominio
        $sql2 = "SELECT dominio.Puntaje
                 FROM dominio
                 INNER JOIN cuestionario
                     ON dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario
                 WHERE cuestionario.Aspirante_idAspirante = :idAspirante";
        
        $stmt2 = $link->prepare($sql2);
        $stmt2->execute([
            ':idAspirante' => $line['idAspirante']
        ]);
        
        $puntajeDom = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        foreach ($puntajeDom as $index => $puntaje) {
            if ($index < count($promedioDom)) {
                $promedioDom[$index] += $puntaje;
            }
        }

        // Obtener puntajes de dimensión
        $sql3 = "SELECT dimension.Puntaje
                 FROM dimension
                 INNER JOIN cuestionario
                     ON dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario
                 WHERE cuestionario.Aspirante_idAspirante = :idAspirante
                 AND Numero = :numero";
        
        $stmt3 = $link->prepare($sql3);
        $stmt3->execute([
            ':idAspirante' => $line['idAspirante'],
            ':numero' => 3
        ]);
        
        $puntajeDim = $stmt3->fetchAll(PDO::FETCH_COLUMN);
        foreach ($puntajeDim as $index => $puntaje) {
            if ($index < count($promedioDim)) {
                $promedioDim[$index] += $puntaje;
            }
        }
    }

    // Calcular promedios
    $promedioDom = array_map(function($sum) use ($cantidad) { return round($sum / $cantidad, 1); }, $promedioDom);
    $promedioDim = array_map(function($sum) use ($cantidad) { return round($sum / $cantidad, 1); }, $promedioDim);

    // Imprimir promedios (opcional, para verificar los resultados)
    echo "Promedio Dominio: " . implode(", ", $promedioDom) . "<br>";
    echo "Promedio Dimensión: " . implode(", ", $promedioDim) . "<br>";

} catch (PDOException $e) {
    echo "<center><h1>" . $e->getMessage() . "</h1></center>";
}

?>
