<table class="table table-bordered">
    <tr>
        <td colspan="7"><b><center>RESULTADO DE LAS CONDICIONES EXTRALABORAL EVALUADAS</center></b></td>
    </tr>
    <tr>
        <td rowspan="2"><b><center>RESULTADO DE LAS CONDICIONES EXTRALABORAL EVALUADAS</center></b></td>
        <td colspan="5"><b><center>PORCENTAJE DE TRABAJADORES</center></b></td>
    </tr>
    <tr>
        <td><b>SIN<br>RIESGO</b></td>
        <td><b>RIESGO<br>BAJO</b></td>
        <td><b>RIESGO<br>MEDIO</b></td>
        <td><b>RIESGO<br>ALTO</b></td>
        <td><b>RIESGO<br>MUY ALTO</b></td>
    </tr>
    
    <tr>
        <td>Tiempo fuera del Trabajo</td>
        <td><?php echo getNumero(0, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(0, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(0, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(0, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(0, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Relaciones familiares</td>
        <td><?php echo getNumero(1, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(1, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(1, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(1, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(1, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Comunicación y relaciones interpersonales</td>
        <td><?php echo getNumero(2, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(2, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(2, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(2, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(2, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Situación económica del grupo familiar</td>
        <td><?php echo getNumero(3, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(3, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(3, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(3, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(3, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Características de la vivienda y su entorno</td>
        <td><?php echo getNumero(4, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(4, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(4, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(4, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(4, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Influencia del entorno Extra laboral sobre el trabajo</td>
        <td><?php echo getNumero(5, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(5, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(5, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(5, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(5, "Riesgo muy alto"); ?></td>
    </tr>
    <tr>
        <td>Desplazamiento vivienda-trabajo-vivienda</td>
        <td><?php echo getNumero(6, "Sin riesgo o riesgo despreciable"); ?></td>
        <td><?php echo getNumero(6, "Riesgo bajo"); ?></td>
        <td><?php echo getNumero(6, "Riesgo medio"); ?></td>
        <td><?php echo getNumero(6, "Riesgo alto"); ?></td>
        <td><?php echo getNumero(6, "Riesgo muy alto"); ?></td>
    </tr>
</table>

<?php

function getNumero($pos, $baremo) {

    $link = conectar();

    $sql = "SELECT *
            FROM
            fichatrabajo AS ft
            INNER JOIN aspirante AS a
            ON (ft.Aspirante_idAspirante = a.idAspirante)
            INNER JOIN cuestionario AS c
            ON (c.Aspirante_idAspirante = a.idAspirante)
            INNER JOIN empresa AS e
            ON (a.Empresa_idEmpresa = e.idEmpresa)
            INNER JOIN area AS ar
            ON (ar.Empresa_idEmpresa = e.idEmpresa)
        WHERE cuestionario.Numero = 2";

    if ($_POST['empresa'] != 'all') {
        $count = 1;
        foreach ($_POST['empresa'] as $empresa) {
            if ($count==1) {
                $sql .= " AND (e.idEmpresa = $empresa ";
            }else{
                $sql .= " OR e.idEmpresa = $empresa ";
            }
            $count++;
        }
        $sql .= ")";
    }

    if ($_POST['area'] != 'all') {
        $sql .= " AND ar.Nombre like '%{$_POST['area']}%'";
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    echo '<pre>'.print_r($sql, TRUE).'</pre>';
    die();
    //echo $sql;
    $aspirantes = mysql_query($sql, $link);

    $cantidad = mysql_num_rows($aspirantes);
    //echo 'CANTIDAD: '.$cantidad;

    $count = 0;
    while ($line = mysql_fetch_array($aspirantes)) {

        $sql3 = "SELECT dimension.Valor
                FROM
                dimension
                INNER JOIN cuestionario
                    ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
                    WHERE cuestionario.Aspirante_idAspirante = " . $line['idAspirante'] . " AND Numero = 2";



        $valDim = mysql_query($sql3, $link);

        $aux = mysql_result($valDim, $pos);

        if ($aux === $baremo) {
            $count++;
        }
    }
    $porcentaje = ($count * 100) / $cantidad;
    $result = round($porcentaje, 0) . "%";
    return $result;
}
