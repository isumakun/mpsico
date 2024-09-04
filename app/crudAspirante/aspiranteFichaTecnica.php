<?php
require_once 'funciones.php';

$link = conectar();

$sql = "SELECT
    aspirante.Nombre
    , aspirante.Apellido1
    , aspirante.Apellido2
FROM
    aspirante
    INNER JOIN usuario 
        ON (aspirante.Usuario_idUsuario = usuario.idUsuario)
        WHERE usuario.usuario = '{$_SESSION['usuario']}'
        ORDER BY aspirante.idAspirante DESC LIMIT 1";

        
$query = mysql_query($sql, $link);

$lista = array();

while ($line = mysql_fetch_array($query)) {
    ?>

    <div class="form-group">
        <label class="control-label" for="inputDefault">Nombre</label>
        <input type="text" class="form-control" required="" value="<?php echo $line['Nombre']; ?>"  name="nombre" id="nombre" placeholder="Nombre del aspirante">
    </div>

    <div class="form-group">
        <label class="control-label" for="inputDefault">Primer Apellido</label>
        <input type="text" class="form-control" required="" value="<?php echo $line['Apellido1']; ?>" name="apellido1" id="apellido1" placeholder="Primer Apellido del aspirante">
    </div>

    <div class="form-group">
        <label class="control-label" for="inputDefault">Segundo Apellido</label>
        <input type="text" class="form-control" required="" value="<?php echo $line['Apellido2']; ?>"  name="apellido2" id="apellido2" placeholder="Segundo Apellido del aspirante">
    </div>

    <?php
}

mysql_close($link);
