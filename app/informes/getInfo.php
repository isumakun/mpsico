<?php
require_once 'funciones.php';
$link = conectar();

$ok = false;

$sql = "SELECT
    CONCAT(aspirante.Nombre, ' ', aspirante.Apellido1, ' ',aspirante.Apellido2) AS Nombre
    , aspirante.idAspirante
    , aspirante.Cedula
    , fichatrabajo.Cargo
    , fichatrabajo.AreaTrabajo
    , fichapersonal.Nacimiento
    , fichapersonal.Sexo
    , cuestionario.fecha
    , empresa.Nombre AS Empresa
FROM
    fichatrabajo
    INNER JOIN aspirante 
        ON (fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante)
    INNER JOIN fichapersonal 
        ON (fichapersonal.Aspirante_idAspirante = aspirante.idAspirante)
    INNER JOIN cuestionario 
        ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
    INNER JOIN empresa 
        ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
        WHERE cuestionario.Numero = {$_GET['numero']} AND
        aspirante.idAspirante = {$_GET['usuario']}";

$query = mysql_query($sql, $link);

if (mysql_num_rows($query) == 0) {
    $sql = "SELECT
aspirante.*,
cuestionario.*,
    empresa.Nombre AS Empresa
FROM
    cuestionario
    INNER JOIN aspirante 
        ON (cuestionario.Aspirante_idAspirante = aspirante.idAspirante)
    INNER JOIN empresa 
        ON (aspirante.Empresa_idEmpresa = empresa.idEmpresa)
        WHERE cuestionario.Numero = {$_GET['numero']} 
AND aspirante.idAspirante = {$_GET['usuario']}";

    $query = mysql_query($sql, $link);
    $ok = true;
}

while ($line = mysql_fetch_array($query)) {
    ?>

    <div class="col-sm-12 col-xs-12">

        <div class="col-xs-12 text-center">
            <center><h5 class="uppercase"><b>Datos generales del trabajador</h5></center>
            <div class="title-line-4 blue less-margin align-center"></div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label" for="inputDefault">Nombre del Trabajador</label>
                <input type="text"  class="form-control" required="" value="<?php echo $line['Nombre'] ?>"  name="nombre" id="nombre">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">No. Identificación (ID)</label>
                <input type="text"  class="form-control" required="" value="<?php echo $line['idAspirante'] ?>" name="id" id="id">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Cargo</label>
                <input type="text"  class="form-control" required="" value="<?php if($ok==false){ echo $line['Cargo']; } ?>" name="cargo" id="cargo">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Departamento o Sección</label>
                <input type="text"  class="form-control" required="" value="<?php if($ok==false){echo $line['AreaTrabajo']; } ?>" name="area" id="area">
            </div>                                    
        </div>

        <div class="col-sm-6">

            <div class="form-group">
                <label class="control-label" for="inputDefault">Nacimiento</label>
                <input type="text"  class="form-control" required="" value="<?php if($ok==false){echo $line['Nacimiento']; } ?>" name="nacimiento" id="nacimiento">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Sexo</label>
                <input type="text"  class="form-control" required="" value="<?php if($ok==false){echo $line['Sexo']; } ?>" name="sexo" id="sexo">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Fecha de aplicación del formulario</label>
                <input type="text"  class="form-control" required="" value="<?php echo $line['fecha'] ?>" name="fecha" id="fecha">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Nombre de la Empresa</label>
                <input type="text"  class="form-control" required="" value="<?php echo $line['Empresa'] ?>" name="empresa" id="empresa">
            </div>

        </div>

    </div>

    <?php
}

mysql_close($link);

