<?php

function conectar() {
    $link = mysql_connect("localhost", "mpsico_admin", "310.310.") or die("Error al conectar" . mysql_error());
    mysql_select_db("mpsico_entrevistas") or die("No se pudo conectar a Entrevistas");
    return $link;
}

function getLink() {
    $link = conectar();
    $sql = "select link from prueba where idPrueba='1'";
    $result = mysql_query($sql, $link);
    $r = mysql_result($result, 0);
    $r = str_replace("watch?v=", "v/", $r);
    return $r;
}

function getIDByUser($usuario) {
    $link = conectar();
    $sql = "select idAspirante from aspirante where Cedula='$usuario'";
    $result = mysql_query($sql, $link);
    $idUser = mysql_result($result, 0, 0);
    return $idUser;
}

function getConsentimiento($usuario) {
    $link = conectar();
    $sql = "select consentimiento from usuario where usuario='$usuario'";
    $result = mysql_query($sql, $link);
    $r = mysql_result($result, 0, 0);
    if ($r == 1) {
        return 'true';
    } else {
        return 'false';
    }
}

function getNumeroAspirantes($empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)";
    
        $sql .= " WHERE idEmpresa = $empresa";

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }

    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getResultGenero($genero, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            where Sexo = '$genero'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }

    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByEstadoCivil($estado, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            where EstadoCivil =  '$estado'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }

    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByEscolaridad($escolaridad, $empresa, $area) {
    $link = conectar();
    $escolaridad = utf8_encode($escolaridad);
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE NivelEstudios =  '$escolaridad'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByEstrato($estrato, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Estrato =  '$estrato'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByVivienda($vivienda, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Vivienda =  '$vivienda'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByAntiguedad($rango, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Tiempo =  '$rango'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByTipoCargo($tipo, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
                fichapersonal
                INNER JOIN aspirante 
                    ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN fichatrabajo 
                    ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
                INNER JOIN empresa 
                    ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE TipoCargo =  '$tipo'";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByIntralaboral($baremo, $empresa, $area, $forma) {
    $link = conectar();
    if($forma == "A"){
        $sql = "SELECT *
            FROM
            fichatrabajo
            INNER JOIN aspirante 
            ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN cuestionario 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN empresa 
            ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Numero = 3
            AND BaremoPTC = '$baremo' ";
    }else if($forma == "B"){
        $sql = "SELECT *
            FROM
            fichatrabajo
            INNER JOIN aspirante 
            ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN cuestionario 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN empresa 
            ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Numero = 4
            AND BaremoPTC = '$baremo' ";
    }

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";
    
    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByExtralaboral($baremo, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
            fichatrabajo
            INNER JOIN aspirante 
            ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN cuestionario 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN empresa 
            ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Numero = 2
            AND BaremoPTC = '$baremo' ";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function getByEstres($baremo, $empresa, $area) {
    $link = conectar();
    $sql = "SELECT *
            FROM
            fichatrabajo
            INNER JOIN aspirante 
            ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN cuestionario 
            ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
            INNER JOIN empresa 
            ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
            WHERE Numero = 1
            AND BaremoPTC = '$baremo' ";

    if ($empresa != 'all') {
        $sql .= " AND idEmpresa = $empresa";
    }

    if ($area != 'all') {
        $sql .= " AND Area_idArea = $area";
    }
    
    $sql .= " GROUP BY idFichaTrabajo";

    $result = mysql_query($sql, $link);
    $count = mysql_num_rows($result);
    return $count;
}

function setColorDim($valor, $i, $forma) {
    //return '<td>'.$valor.'</td>';

    if ($forma == "A") {
        $result = baremosDimensionesFormaA($valor, $i);
    } else {
        $result = baremosDimensionesFormaB($valor, $i);
    }

    if ($result == "Sin riesgo o riesgo despreciable") {
        return '<td class="level1">MB</td>';
    } else if ($result == "Riesgo bajo") {
        return '<td class="level2">B</td>';
    } else if ($result == "Riesgo medio") {
        return '<td class="level3">M</td>';
    } else if ($result == "Riesgo alto") {
        return '<td class="level4">A</td>';
    } else if ($result == "Riesgo muy alto") {
        return '<td class="level5">MA</td>';
    }
}

function setColorDimension($array, $cantidad) {

    $result = calculateDim($array, $cantidad);

    if ($result == "Sin riesgo o riesgo despreciable") {
        return '<td class="level1">MB</td>';
    } else if ($result == "Riesgo bajo") {
        return '<td class="level2">B</td>';
    } else if ($result == "Riesgo medio") {
        return '<td class="level3">M</td>';
    } else if ($result == "Riesgo alto") {
        return '<td class="level4">A</td>';
    } else if ($result == "Riesgo muy alto") {
        return '<td class="level5">MA</td>';
    }
}

function calculateDim($array, $cantidad){
    $cNo = 0;
    $cBajo = 0;
    $cMedio = 0;
    $cAlto = 0;
    $cMAlto = 0;

    foreach ($array as $d) {
        if ($d=='Sin riesgo o riesgo despreciable') {
            $cNo++;
        }elseif ($d == 'Riesgo bajo') {
            $cBajo++;
        }elseif ($d == 'Riesgo medio') {
            $cMedio++;
        }elseif ($d == 'Riesgo alto') {
            $cAlto++;
        }elseif ($d == 'Riesgo muy alto') {
           $cMAlto++;
        }
    }

    if ($cNo == $cantidad)
       return 'Sin riesgo o riesgo despreciable';

    if ($cBajo == $cantidad)
       return 'Riesgo bajo';

    if ($cMedio == $cantidad)
       return 'Riesgo medio';

    if ($cAlto == $cantidad)
       return 'Riesgo alto';

    if ($cMAlto == $cantidad)
       return 'Riesgo muy alto';


    $rango1 = (($cNo+$cBajo)*100)/$cantidad;
    $rango2 = (($cMedio+$cAlto+$cMAlto)*100)/$cantidad;


    if ($rango1<100 && $rango1>49) {
        return 'Riesgo bajo';
    }elseif ($rango2<70 && $rango2>=49) {
       return 'Riesgo medio';
    }elseif ($rango2<99 && $rango2>=70) {
       return 'Riesgo alto';
    }else{
       return 'Riesgo bajo';
    }
}

function setColorExtraTotal($valor) {

    $result = baremosTotalExtra($valor);

    if ($result == "Sin riesgo o riesgo despreciable") {
        return '<td class="level1">MB</td>';
    } else if ($result == "Riesgo bajo") {
        return '<td class="level2">B</td>';
    } else if ($result == "Riesgo medio") {
        return '<td class="level3">M</td>';
    } else if ($result == "Riesgo alto") {
        return '<td class="level4">A</td>';
    } else if ($result == "Riesgo muy alto") {
        return '<td class="level5">MA</td>';
    }
}

function setColorDom($valor, $i, $forma) {
    if ($forma == "A") {
        $result = baremosDominiosFormaA($valor, $i);
    } else {
        $result = baremosDominiosFormaB($valor, $i);
    }

    if ($result == "Sin riesgo o riesgo despreciable") {
        return '<td class="level1">MB</td>';
    } else if ($result == "Riesgo bajo") {
        return '<td class="level2">B</td>';
    } else if ($result == "Riesgo medio") {
        return '<td class="level3">M</td>';
    } else if ($result == "Riesgo alto") {
        return '<td class="level4">A</td>';
    } else if ($result == "Riesgo muy alto") {
        return '<td class="level5">MA</td>';
    }
}

function getCuestiorioRealizado($user, $c) {
    $link = conectar();

    $idasp = getIDByUser($user);

    $sql = "SELECT
            numero
            FROM cuestionario
            WHERE Aspirante_idAspirante = $idasp"
            . " AND numero = $c";

    $result = mysql_query($sql, $link);

    if (mysql_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getForma($user, $c) {
    $link = conectar();

    $idasp = getIDByUser($user);

    $sql = "SELECT
            Forma
            FROM aspirante
            WHERE idAspirante = $idasp"
            . " AND Forma = $c";

    $result = mysql_query($sql, $link);

    if (mysql_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getCuestiorioRealizadoString() {
    $link = conectar();

    $sql = "SELECT
            numero
            FROM cuestionario
            WHERE Aspirante_idAspirante = {$_SESSION['id']}";

    $result = mysql_query($sql, $link);

    $return = array();

    while ($fila = mysql_fetch_array($result, mysql_NUM)) {
                array_push($return, $fila[0]);
    }

    return $return;
}

function validarFicha($user) {
    $link = conectar();

    $idasp = getIDByUser($user);

    $sql = "SELECT
            *
            FROM fichapersonal
            WHERE Aspirante_idAspirante = $idasp";

    $result = mysql_query($sql, $link);

    if (mysql_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function transformarForma($puntaje, $factor) {
    $nuevoPuntaje = ($puntaje / $factor) * 100;
    $resultado = round($nuevoPuntaje, 1);
    return $resultado;
}

function transformarInversaExtra($puntaje, $factor) {
    $nuevoPuntaje = ($puntaje * $factor) / 100;
    $resultado = round($nuevoPuntaje, 1);
    return $resultado;
}

function baremosTotalFormaA($valor) {
    $baremos = [0, 19.8, 25.9, 31.6, 38.1, 100];

    if (($valor == $baremos[0]) || ($valor < $baremos[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremos[1]) || ($valor < $baremos[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremos[2]) || ($valor < $baremos[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremos[3]) || ($valor < $baremos[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremos[4]) || ($valor <= $baremos[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosTotalFormaB($valor) {
    $baremos = [0, 20.7, 26.1, 31.3, 38.8, 100];

    if (($valor == $baremos[0]) || ($valor < $baremos[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremos[1]) || ($valor < $baremos[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremos[2]) || ($valor < $baremos[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremos[3]) || ($valor < $baremos[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremos[4]) || ($valor <= $baremos[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDimensionesFormaA($valor, $i) {
    $baremosD[0] = [0, 3.9, 15.5, 30.9, 46.3, 100];
    $baremosD[1] = [0, 5.5, 16.2, 25.1, 37.6, 100];
    $baremosD[2] = [0, 10.1, 25.1, 40.1, 55.1, 100];
    $baremosD[3] = [0, 14, 25.1, 33.4, 47.3, 100];
    $baremosD[4] = [0, 1, 10.9, 21.5, 39.5, 100];
    $baremosD[5] = [0, 1, 16.8, 33.4, 50.1, 100];
    $baremosD[6] = [0, 12.6, 25.1, 37.6, 50.1, 100];
    $baremosD[7] = [0, 1, 6.4, 18.9, 31.4, 100];
    $baremosD[8] = [0, 8.4, 25.1, 41.8, 58.4, 100];
    $baremosD[9] = [0, 14.7, 23, 31.4, 39.7, 100];
    $baremosD[10] = [0, 16.8, 25.1, 33.4, 47.3, 100];
    $baremosD[11] = [0, 25.1, 33.4, 45.9, 54.3, 100];
    $baremosD[12] = [0, 18.9, 31.4, 43.9, 50.1, 100];
    $baremosD[13] = [0, 37.6, 54.3, 66.8, 79.3, 100];
    $baremosD[14] = [0, 60.1, 70.1, 80.1, 90.1, 100];
    $baremosD[15] = [0, 15.1, 25.1, 35.1, 45.1, 100];
    $baremosD[16] = [0, 8.4, 25.1, 33.4, 50.1, 100];
    $baremosD[17] = [0, 1, 5.1, 10.1, 20.1, 100];
    $baremosD[18] = [0, 4.3, 16.8, 25.1, 37.6, 100];

    if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDimensionesFormaB($valor, $i) {
    $baremosD[0] = [0, 3.9, 13.6, 25.1, 38.6, 100];
    $baremosD[1] = [0, 6.4, 14.7, 27.2, 37.6, 100];
    $baremosD[2] = [0, 5.1, 20.1, 30.1, 50.1, 100];
    $baremosD[3] = [0, 1, 5.1, 15.1, 30.1, 100];
    $baremosD[4] = [0, 1, 16.8, 25.1, 50.1, 100];
    $baremosD[5] = [0, 16.8, 33.4, 41.8, 58.4, 100];
    $baremosD[6] = [0, 12.6, 25.1, 37.6, 56.4, 100];
    $baremosD[7] = [0, 33.4, 50.1, 66.8, 75.1, 100];
    $baremosD[8] = [0, 23, 31.4, 39.7, 48, 100];
    $baremosD[9] = [0, 19.5, 27.9, 39.7, 48, 100];
    $baremosD[10] = [0, 16.8, 33.4, 41.8, 50.1, 100];
    $baremosD[11] = [0, 12.6, 25.1, 31.4, 50.1, 100];
    $baremosD[12] = [0, 50.1, 65.1, 75.1, 85.1, 100];
    $baremosD[13] = [0, 25.1, 37.6, 45.9, 58.4, 100];
    $baremosD[14] = [0, 1, 6.4, 12.6, 18.9, 100];
    $baremosD[15] = [0, 1, 12.6, 25.1, 37.6, 100];

    if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDimensionesExtraJefe($valor) {
    $baremosD[0] = [0, 6.4, 25, 37.6, 50, 100];
    $baremosD[1] = [0, 8.4, 25, 33.4, 50, 100];
    $baremosD[2] = [0, 1, 10, 20.1, 30, 100];
    $baremosD[3] = [0, 8.4, 25, 33.4, 50, 100];
    $baremosD[4] = [0, 5.7, 11.1, 14, 22.2, 100];
    $baremosD[5] = [0, 8.4, 16.7, 25.1, 41.7, 100];
    $baremosD[6] = [0, 1, 12.5, 25.1, 43.8, 100];

    for ($i = 0; $i <= 6; $i++) {
        if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
            return 'Sin riesgo o riesgo despreciable';
        } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
            return 'Riesgo bajo';
        } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
            return 'Riesgo medio';
        } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
            return 'Riesgo alto';
        } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
            return 'Riesgo muy alto';
        }
    }
}

function baremosPTCExtraJefe($valor) {
    $baremosD = [0, 11.4, 16.9, 22.7, 29, 100];

    if (($valor == $baremosD[0]) || ($valor < $baremosD[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[1]) || ($valor < $baremosD[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[2]) || ($valor < $baremosD[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[3]) || ($valor < $baremosD[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[4]) || ($valor <= $baremosD[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDimensionesExtraAux($valor) {
    $baremosD[0] = [0, 6.4, 25, 37.6, 50, 100];
    $baremosD[1] = [0, 8.4, 25, 33.4, 50, 100];
    $baremosD[2] = [0, 5.1, 15, 25.1, 35, 100];
    $baremosD[3] = [0, 16.8, 25, 41.8, 50, 100];
    $baremosD[4] = [0, 5.7, 11.1, 16.8, 27.8, 100];
    $baremosD[5] = [0, 1, 16.7, 25.1, 41.7, 100];
    $baremosD[6] = [0, 1, 12.5, 25.1, 43.8, 100];

    for ($i = 0; $i <= 6; $i++) {
        if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
            return 'Sin riesgo o riesgo despreciable';
        } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
            return 'Riesgo bajo';
        } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
            return 'Riesgo medio';
        } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
            return 'Riesgo alto';
        } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
            return 'Riesgo muy alto';
        }
    }
}

function baremosPTCExtraAux($valor) {
    $baremosD = [0, 13, 17.7, 24.3, 32.3, 100];
    if (($valor == $baremosD[0]) || ($valor < $baremosD[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[1]) || ($valor < $baremosD[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[2]) || ($valor < $baremosD[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[3]) || ($valor < $baremosD[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[4]) || ($valor <= $baremosD[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosTotalExtra($valor) {
    $baremosD = [0, 18.9, 24.4, 29.6, 35.4, 100];
    if (($valor == $baremosD[0]) || ($valor < $baremosD[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[1]) || ($valor < $baremosD[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[2]) || ($valor < $baremosD[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[3]) || ($valor < $baremosD[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[4]) || ($valor <= $baremosD[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDominiosFormaA($valor, $i) {
    $baremosD[0] = [0, 9.2, 17.8, 25.7, 34.9, 100];
    $baremosD[1] = [0, 10.8, 19.1, 29.9, 40.6, 100];
    $baremosD[2] = [0, 28.6, 35.1, 41.6, 47.6, 100];
    $baremosD[3] = [0, 4.6, 11.5, 20.6, 29.6, 100];

    if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
        return 'Riesgo muy alto';
    }
}

function baremosDominiosFormaB($valor, $i) {
    $baremosD[0] = [0, 8.4, 17.6, 26.8, 38.4, 100];
    $baremosD[1] = [0, 19.5, 26.5, 34.8, 43.2, 100];
    $baremosD[2] = [0, 27, 33.4, 37.9, 44.3, 100];
    $baremosD[3] = [0, 2.6, 10.1, 17.6, 27.6, 100];

    if (($valor == $baremosD[$i][0]) || ($valor < $baremosD[$i][1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[$i][1]) || ($valor < $baremosD[$i][2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[$i][2]) || ($valor < $baremosD[$i][3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[$i][3]) || ($valor < $baremosD[$i][4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[$i][4]) || ($valor <= $baremosD[$i][5])) {
        return 'Riesgo muy alto';
    }
}

function baremosPTCEstresJefe($valor) {
    $baremosD = [0, 7.9, 12.6, 17.8, 25, 100];

    if (($valor == $baremosD[0]) || ($valor < $baremosD[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[1]) || ($valor < $baremosD[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[2]) || ($valor < $baremosD[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[3]) || ($valor < $baremosD[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[4]) || ($valor <= $baremosD[5])) {
        return 'Riesgo muy alto';
    }
}

function baremosPTCEstresAux($valor) {
    $baremosD = [0, 6.6, 11.8, 17.1, 23.4, 100];

    if (($valor == $baremosD[0]) || ($valor < $baremosD[1])) {
        return 'Sin riesgo o riesgo despreciable';
    } else if (($valor == $baremosD[1]) || ($valor < $baremosD[2])) {
        return 'Riesgo bajo';
    } else if (($valor == $baremosD[2]) || ($valor < $baremosD[3])) {
        return 'Riesgo medio';
    } else if (($valor == $baremosD[3]) || ($valor < $baremosD[4])) {
        return 'Riesgo alto';
    } else if (($valor == $baremosD[4]) || ($valor <= $baremosD[5])) {
        return 'Riesgo muy alto';
    }
}
