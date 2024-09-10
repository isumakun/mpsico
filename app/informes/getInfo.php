<?php
require_once 'funciones.php';
$link = conectar(); // Ensure this returns a PDO instance

$ok = false;

// Use prepared statements to prevent SQL injection
$sql = "SELECT
            CONCAT(aspirante.Nombre, ' ', aspirante.Apellido1, ' ', aspirante.Apellido2) AS Nombre,
            aspirante.idAspirante,
            aspirante.Cedula,
            fichatrabajo.Cargo,
            fichapersonal.Nacimiento,
            fichapersonal.Sexo,
            cuestionario.fecha,
            empresa.Nombre AS Empresa,
            area.Nombre AS AreaTrabajo
        FROM
            fichatrabajo
            INNER JOIN aspirante 
                ON fichatrabajo.Aspirante_idAspirante = aspirante.idAspirante
            INNER JOIN fichapersonal 
                ON fichapersonal.Aspirante_idAspirante = aspirante.idAspirante
            INNER JOIN cuestionario 
                ON cuestionario.Aspirante_idAspirante = aspirante.idAspirante
            INNER JOIN empresa 
                ON aspirante.Empresa_idEmpresa = empresa.idEmpresa
            INNER JOIN area
                ON area.idArea = fichatrabajo.Area_idArea
        WHERE cuestionario.Numero = '{$_GET['numero']}' 
            AND aspirante.idAspirante = '{$_GET['usuario']}'";

$stmt = $link->prepare($sql);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($results)) {
    $sql = "SELECT
        aspirante.*,
        cuestionario.*,
        empresa.Nombre AS Empresa
    FROM
        cuestionario
        INNER JOIN aspirante 
            ON cuestionario.Aspirante_idAspirante = aspirante.idAspirante
        INNER JOIN empresa 
            ON aspirante.Empresa_idEmpresa = empresa.idEmpresa
    WHERE cuestionario.Numero = :numero 
        AND aspirante.idAspirante = :usuario";

    $stmt = $link->prepare($sql);
    $stmt->bindParam(':numero', $_GET['numero'], PDO::PARAM_INT);
    $stmt->bindParam(':usuario', $_GET['usuario'], PDO::PARAM_INT);
    $stmt->execute();
    $ok = true;
}

$results = $stmt->fetch(PDO::FETCH_ASSOC);
foreach ($results as $line) {
    ?>

    <div class="col-sm-12 col-xs-12">

        <div class="col-xs-12 text-center">
            <center><h5 class="uppercase"><b>Datos generales del trabajador</h5></center>
            <div class="title-line-4 blue less-margin align-center"></div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label" for="inputDefault">Nombre del Trabajador</label>
                <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['Nombre']); ?>" name="nombre" id="nombre">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">No. Identificación (ID)</label>
                <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['idAspirante']); ?>" name="id" id="id">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Cargo</label>
                <input type="text" class="form-control" required="" value="<?php echo $ok == false ? htmlspecialchars($line['Cargo']) : ''; ?>" name="cargo" id="cargo">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Departamento o Sección</label>
                <input type="text" class="form-control" required="" value="<?php echo $ok == false ? htmlspecialchars($line['AreaTrabajo']) : ''; ?>" name="area" id="area">
            </div>
        </div>

        <div class="col-sm-6">

            <div class="form-group">
                <label class="control-label" for="inputDefault">Nacimiento</label>
                <input type="text" class="form-control" required="" value="<?php echo $ok == false ? htmlspecialchars($line['Nacimiento']) : ''; ?>" name="nacimiento" id="nacimiento">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Sexo</label>
                <input type="text" class="form-control" required="" value="<?php echo $ok == false ? htmlspecialchars($line['Sexo']) : ''; ?>" name="sexo" id="sexo">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Fecha de aplicación del formulario</label>
                <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['fecha']); ?>" name="fecha" id="fecha">
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Nombre de la Empresa</label>
                <input type="text" class="form-control" required="" value="<?php echo htmlspecialchars($line['Empresa']); ?>" name="empresa" id="empresa">
            </div>

        </div>

    </div>

    <?php
}

$link = null; // Close the connection
?>
