<?php

require './funciones.php';

$link = conectar();

$sql = "SELECT *
FROM
    aspirante
    INNER JOIN cuestionario 
        ON (aspirante.idAspirante = cuestionario.Aspirante_idAspirante)
        WHERE cuestionario.Numero = 3
        AND Empresa_idEmpresa = 1";

$aspirantes = mysql_query($sql, $link);

$cantidad = mysql_num_rows($aspirantes);
echo "cantidad:".$cantidad."<br>";
$promedioDom = [0, 0, 0, 0];

$promedioDim = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

while ($line = mysql_fetch_array($aspirantes)) {
    $sql2 = "SELECT dominio.`Puntaje`
                FROM
                dominio
                INNER JOIN cuestionario
                    ON (`dominio`.`Cuestionario_idCuestionario` = `cuestionario`.`idCuestionario`)
                    WHERE `cuestionario`.`Aspirante_idAspirante` = " . $line['idAspirante'];

    $puntajeDom = mysql_query($sql2, $link);

    $promedioDom[0] += mysql_result($puntajeDom, 0);
    $promedioDom[1] += mysql_result($puntajeDom, 1);
    $promedioDom[2] += mysql_result($puntajeDom, 2);
    $promedioDom[3] += mysql_result($puntajeDom, 3);

    $sql3 = "SELECT dimension.`Puntaje`
                FROM
                `dimension`
                INNER JOIN cuestionario
                    ON (`dimension`.`Cuestionario_idCuestionario` = `cuestionario`.`idCuestionario`)
                    WHERE `cuestionario`.`Aspirante_idAspirante` = " . $line['idAspirante'] . " AND `Numero` = 3";

    $puntajeDim = mysql_query($sql3, $link);

    $promedioDim[0] += mysql_result($puntajeDim, 0);
    $promedioDim[1] += mysql_result($puntajeDim, 1);
    $promedioDim[2] += mysql_result($puntajeDim, 2);
    $promedioDim[3] += mysql_result($puntajeDim, 3);
    $promedioDim[4] += mysql_result($puntajeDim, 4);
    $promedioDim[5] += mysql_result($puntajeDim, 5);
    $promedioDim[6] += mysql_result($puntajeDim, 6);
    $promedioDim[7] += mysql_result($puntajeDim, 7);
    $promedioDim[8] += mysql_result($puntajeDim, 8);
    $promedioDim[9] += mysql_result($puntajeDim, 9);
    $promedioDim[10] += mysql_result($puntajeDim, 10);
    $promedioDim[11] += mysql_result($puntajeDim, 11);
    $promedioDim[12] += mysql_result($puntajeDim, 12);
    $promedioDim[13] += mysql_result($puntajeDim, 13);
    $promedioDim[14] += mysql_result($puntajeDim, 14);
    $promedioDim[15] += mysql_result($puntajeDim, 15);
    $promedioDim[16] += mysql_result($puntajeDim, 16);
    $promedioDim[17] += mysql_result($puntajeDim, 17);
}

$promedioDom[0] = round($promedioDom[0] / $cantidad, 1);
$promedioDom[1] = round($promedioDom[1] / $cantidad, 1);
$promedioDom[2] = round($promedioDom[2] / $cantidad, 1);
$promedioDom[3] = round($promedioDom[3] / $cantidad, 1);

$promedioDim[0] = round($promedioDim[0] / $cantidad, 1);
$promedioDim[1] = round($promedioDim[1] / $cantidad, 1);
$promedioDim[2] = round($promedioDim[2] / $cantidad, 1);
$promedioDim[3] = round($promedioDim[3] / $cantidad, 1);
$promedioDim[4] = round($promedioDim[4] / $cantidad, 1);
$promedioDim[5] = round($promedioDim[5] / $cantidad, 1);
$promedioDim[6] = round($promedioDim[6] / $cantidad, 1);
$promedioDim[7] = round($promedioDim[7] / $cantidad, 1);
$promedioDim[8] = round($promedioDim[8] / $cantidad, 1);
$promedioDim[9] = round($promedioDim[9] / $cantidad, 1);
$promedioDim[10] =round($promedioDim[10] / $cantidad, 1);
$promedioDim[11] =round($promedioDim[11] / $cantidad, 1);
$promedioDim[12] =round($promedioDim[12] / $cantidad, 1);
$promedioDim[13] =round($promedioDim[13] / $cantidad, 1);
$promedioDim[14] =round($promedioDim[14] / $cantidad, 1);
$promedioDim[15] =round($promedioDim[15] / $cantidad, 1);
$promedioDim[16] =round($promedioDim[16] / $cantidad, 1);
$promedioDim[17] =round($promedioDim[17] / $cantidad, 1);








