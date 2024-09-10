<?php
function conectar()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mpsico', 'master', '310.310.');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error al conectar: " . $e->getMessage());
    }
}

function getLink()
{
    $pdo = conectar();
    $sql = "SELECT link FROM prueba WHERE idPrueba = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => 1]);
    $r = $stmt->fetchColumn();
    $r = str_replace("watch?v=", "v/", $r);
    return $r;
}

function getCuestionarioRealizado($user, $c)
{
    $link = conectar();

    try {
        $date = date('Y');
        $idasp = getIDByUser($user);

        $sql = "SELECT numero FROM cuestionario 
                WHERE Aspirante_idAspirante = $idasp
                AND numero = $c
                AND fecha LIKE '%$date%'";

        $stmt = $link->prepare($sql);
        $res = $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "<center><h1>" . $e->getMessage() . "</h1></center>";
        return false;
    }
}


function getIDByUser($usuario)
{
    $pdo = conectar();
    $sql = "SELECT idAspirante FROM aspirante WHERE Cedula = :cedula ORDER BY idAspirante DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cedula' => $usuario]);
    $idUser = $stmt->fetchColumn();
    return $idUser;
}

function getConsentimiento($usuario)
{
    $pdo = conectar();
    $sql = "SELECT consentimiento FROM usuario WHERE usuario = :usuario ORDER BY idUsuario DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $r = $stmt->fetchColumn();
    return $r == 1 ? 'true' : 'false';
}

function getNumeroAspirantes($empresa, $area)
{
    $pdo = conectar();
    $sql = "SELECT COUNT(DISTINCT ft.idFichaTrabajo)
            FROM fichapersonal AS fp
            INNER JOIN aspirante AS a ON fp.Aspirante_idAspirante = a.idAspirante
            INNER JOIN fichatrabajo AS ft ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE 1=1";

    $params = [];
    if ($empresa != 'all') {
        $placeholders = implode(',', array_fill(0, count($empresa), '?'));
        $sql .= " AND e.idEmpresa IN ($placeholders)";
        $params = array_merge($params, $empresa);
    }

    if ($area != 'all') {
        $sql .= " AND ar.idArea = ?";
        $params[] = $area;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

function getEmpresas($empresas)
{
    $pdo = conectar();
    $placeholders = implode(',', array_fill(0, count($empresas), '?'));
    $sql = "SELECT COUNT(*) FROM empresa AS e WHERE e.idEmpresa IN ($placeholders)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($empresas);
    return $stmt->fetchColumn();
}

function getFichaTecnica($empresa, $area)
{
    $pdo = conectar();
    $sql = "SELECT *
            FROM fichapersonal AS fp
            INNER JOIN aspirante AS a ON fp.Aspirante_idAspirante = a.idAspirante
            INNER JOIN fichatrabajo AS ft ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante";

    $params = [];

    if ($empresa != 'all') {
        $placeholders = implode(',', array_fill(0, count($empresa), '?'));
        $sql .= " WHERE e.idEmpresa IN ($placeholders)";
        $params = array_merge($params, $empresa);
    }

    if ($area != 'all') {
        $sql .= " AND ar.idArea = ?";
        $params[] = $area;
    }

    $sql .= " GROUP BY a.idAspirante";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getByIntralaboral($baremo, $empresa, $area, $forma)
{
    $pdo = conectar();
    $sql = "SELECT *
            FROM fichatrabajo AS ft
            INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante AND YEAR(c.fecha) >= 2021
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE c.Numero = :numero AND c.BaremoPTC = :baremo";

    $params = ['baremo' => $baremo, 'numero' => $forma == 'A' ? 3 : 4];

    if ($empresa != 'all') {
        $placeholders = implode(',', array_fill(0, count($empresa), '?'));
        $sql .= " AND ar.Empresa_idEmpresa IN ($placeholders)";
        $params = array_merge($params, $empresa);
    }

    if ($area != 'all') {
        $sql .= " AND ar.idArea = ?";
        $params[] = $area;
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount();
}

function getByExtralaboral($baremo, $empresa, $area)
{
    $pdo = conectar();
    $sql = "SELECT *
            FROM fichatrabajo AS ft
            INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante AND YEAR(c.fecha) >= 2021
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE c.Numero = 2 AND c.BaremoPTC = :baremo";

    $params = ['baremo' => $baremo];

    if ($empresa != 'all') {
        $placeholders = implode(',', array_fill(0, count($empresa), '?'));
        $sql .= " AND ar.Empresa_idEmpresa IN ($placeholders)";
        $params = array_merge($params, $empresa);
    }

    if ($area != 'all') {
        $sql .= " AND ar.idArea = ?";
        $params[] = $area;
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount();
}


function getByEstres($baremo, $empresa, $area)
{
    $pdo = conectar();
    $sql = "SELECT *
            FROM fichatrabajo AS ft
            INNER JOIN aspirante AS a ON ft.Aspirante_idAspirante = a.idAspirante
            INNER JOIN cuestionario AS c ON c.Aspirante_idAspirante = a.idAspirante AND YEAR(c.fecha) >= 2021
            INNER JOIN empresa AS e ON a.Empresa_idEmpresa = e.idEmpresa
            INNER JOIN area AS ar ON ar.idArea = ft.Area_idArea
            WHERE c.Numero = 1
            AND c.BaremoPTC = :baremo";

    $params = ['baremo' => $baremo];

    if ($empresa != 'all') {
        $placeholders = implode(',', array_fill(0, count($empresa), '?'));
        $sql .= " AND ar.Empresa_idEmpresa IN ($placeholders)";
        $params = array_merge($params, $empresa);
    }

    if ($area != 'all') {
        $sql .= " AND ar.idArea = ?";
        $params[] = $area;
    }

    $sql .= " GROUP BY ft.idFichaTrabajo";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount();
}

function setColorDim($valor, $i, $forma)
{
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

function setColorDimension($array, $cantidad)
{

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
    } else {
        return $result;
    }
}

function setColorDominio($array, $cantidad)
{

    $result = calculateDom($array, $cantidad);

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

function calculateDim($array, $cantidad, $test = 0)
{
    $array_count = array_count_values($array);
    if ($test == 1) {
        var_dump($array);
        echo "Impreso";
    }
    $cNo = $array_count['Sin riesgo o riesgo despreciable'];
    if ($cNo == '')
        $cNo = 0;
    $cBajo = $array_count['Riesgo bajo'];
    if ($cBajo == '')
        $cBajo = 0;
    $cMedio = $array_count['Riesgo medio'];
    if ($cMedio == '')
        $cMedio = 0;
    $cAlto = $array_count['Riesgo alto'];
    if ($cAlto == '')
        $cAlto = 0;
    $cMAlto = $array_count['Riesgo muy alto'];
    if ($cMAlto == '')
        $cMAlto = 0;


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


    $rango1 = (($cNo + $cBajo) * 100) / $cantidad;
    $rango2 = (($cMedio + $cAlto + $cMAlto) * 100) / $cantidad;

    if ($rango1 <= 100 && $rango1 >= 81) {
        return 'Sin riesgo o riesgo despreciable';
    } elseif ($rango1 <= 80 && $rango1 >= 50) {
        return 'Riesgo bajo';
    } elseif ($rango2 <= 60 && $rango2 >= 51) {
        return 'Riesgo medio';
    } elseif ($rango2 <= 80 && $rango2 >= 61) {
        return 'Riesgo alto';
    } elseif ($rango2 <= 100 && $rango2 >= 81) {
        return 'Riesgo muy alto';
    } else {
        return 'Riesgo medio';
    }
}

function calculateDom($array, $cantidad)
{
    $array_count = array_count_values($array);

    $cNo = $array_count['Sin riesgo o riesgo despreciable'];
    if ($cNo == '')
        $cNo = 0;
    $cBajo = $array_count['Riesgo bajo'];
    if ($cBajo == '')
        $cBajo = 0;
    $cMedio = $array_count['Riesgo medio'];
    if ($cMedio == '')
        $cMedio = 0;
    $cAlto = $array_count['Riesgo alto'];
    if ($cAlto == '')
        $cAlto = 0;
    $cMAlto = $array_count['Riesgo muy alto'];
    if ($cMAlto == '')
        $cMAlto = 0;

    //return $cNo.' - '.$cBajo.' - '.$cMedio.' - '.$cAlto.' - '.$cMAlto;

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


    $rango1 = (($cNo + $cBajo) * 100) / $cantidad;
    $rango2 = (($cMedio + $cAlto + $cMAlto) * 100) / $cantidad;

    if ($rango1 <= 100 && $rango1 >= 81) {
        return 'Sin riesgo o riesgo despreciable';
    }
    if ($rango1 <= 80 && $rango1 > 50) {
        return 'Riesgo bajo';
    }
    if ($rango2 <= 60 && $rango2 >= 51) {
        return 'Riesgo medio';
    }
    if ($rango2 <= 80 && $rango2 >= 61) {
        return 'Riesgo alto';
    }
    if ($rango2 <= 100 && $rango2 >= 81) {
        return 'Riesgo muy alto';
    }

    return 'Riesgo medio';
}

function setColorExtraTotal($valor)
{

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

function setColorDom($valor, $i, $forma)
{
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

function getEmpresaUsuario()
{
    $pdo = conectar();

    $sql = "SELECT e.idEmpresa
            FROM empresa AS e
            INNER JOIN aspirante AS a
            ON a.Empresa_idEmpresa = e.idEmpresa
            WHERE a.Cedula = :usuario
            ORDER BY a.idAspirante DESC
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $_SESSION['usuario']]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getForma($user, $forma)
{
    $pdo = conectar();
    $idasp = getIDByUser($user);

    $sql = "SELECT Forma
            FROM aspirante
            WHERE idAspirante = :idasp
            AND Forma = :forma
            ORDER BY idAspirante DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'idasp' => $idasp,
        'forma' => $forma
    ]);

    return $stmt->rowCount() > 0;
}

function getCuestionarioRealizadoString()
{
    $pdo = conectar();

    $sql = "SELECT numero
            FROM cuestionario
            WHERE Aspirante_idAspirante = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_SESSION['id']]);

    $return = [];
    while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
        $return[] = $fila[0];
    }

    return $return;
}

function validarFicha($user)
{
    $pdo = conectar();

    $sql = "SELECT *
            FROM fichapersonal AS f
            INNER JOIN aspirante AS a
            ON f.Aspirante_idAspirante = a.idAspirante
            WHERE a.Cedula = :user
            AND a.Empresa_idEmpresa = :idEmpresa";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user' => $user,
        'idEmpresa' => $_SESSION['idEmpresa']
    ]);

    return $stmt->rowCount() > 0;
}

function transformarForma($puntaje, $factor)
{
    $nuevoPuntaje = ($puntaje / $factor) * 100;
    $resultado = round($nuevoPuntaje, 1);
    return $resultado;
}

function transformarInversaExtra($puntaje, $factor)
{
    $nuevoPuntaje = ($puntaje * $factor) / 100;
    $resultado = round($nuevoPuntaje, 1);
    return $resultado;
}

function baremosTotalFormaA($valor)
{
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

function baremosTotalFormaB($valor)
{
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

function baremosDimensionesFormaA($valor, $i)
{
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

function baremosDimensionesFormaB($valor, $i)
{
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

function baremosDimensionesExtraJefe($valor)
{
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

function baremosPTCExtraJefe($valor)
{
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

function baremosDimensionesExtraAux($valor)
{
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

function baremosPTCExtraAux($valor)
{
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

function baremosTotalExtra($valor)
{
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

function baremosDominiosFormaA($valor, $i)
{
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

function baremosDominiosFormaB($valor, $i)
{
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

function baremosPTCEstresJefe($valor)
{
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

function baremosPTCEstresAux($valor)
{
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
