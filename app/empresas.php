<?php $title = 'Empresas'; ?>
<?php require './header.php'; ?>
<link href="css/cuestionario.css" rel="stylesheet" media="all">

<style>
.feature-box-86 {
    background-color: #3fc35f !important;
}

.bg-color-light {
    background-color: #4ece6d !important;
}

.btn {
    padding: 5px 10px;
}

#logoactual {
    width: 100px;
    height: 100px;
}
</style>
<div class="box box-primary">
    <div class="box-header">
        <a href="#" onclick="nuevaEmpresa()" class="btn btn-primary pull-right">Nueva Empresa</a>
        <a href="areas.php" class="btn btn-success pull-right">Módulo Áreas</a>
    </div>

    <div class="box-body">
        <table id="tabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIT</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Sector</th>
                    <th>Ciudad</th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <?php require_once './crudEmpresa/verEmpresas.php'; ?>
        </table>
    </div>
</div>

<div id="mymodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="crudEmpresa/insertarEmpresa.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="modalTitle" class="modal-title"><strong>Nueva Empresa</strong></h4>
                </div>
                <div class="modal-body" id="modalBody">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Nit</label>
                                    <input type="text" class="form-control" required="" name="nit" id="nit"
                                        placeholder="Nit de la empresa">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Nombre</label>
                                    <input type="text" class="form-control" required="" name="nombre" id="nombre"
                                        placeholder="Nombre de la empresa">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Direccion</label>
                                    <input type="text" class="form-control" required="" name="direccion" id="direccion"
                                        placeholder="Dirección de la empresa">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Telefono</label>
                                    <input type="text" class="form-control" required="" name="telefono" id="telefono"
                                        placeholder="Telefono de la empresa">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Email</label>
                                    <input type="text" class="form-control" required="" name="email" id="email"
                                        placeholder="Email del empresa">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Sector</label>
                                    <input type="text" class="form-control" required="" name="sector" id="sector"
                                        placeholder="Sector de la empresa">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Ciudad</label>
                                    <input type="search" class="form-control" required="" name="ciudad" id="ciudad"
                                        placeholder="Ciudad de la empresa">
                                </div>

                                <div id="div_logo" class="form-group">
                                    <label class="control-label" for="inputDefault">Logo</label>
                                    <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg"
                                        id="imagen">
                                    <p style="color: #3fc35f">- Se recomienda un logo cuadrado</p>
                                </div>

                                <div id="div_nuevologo" class="form-group" style="display: none">
                                    <label class="control-label" for="inputDefault">Logo Actual</label>
                                    <img id="logoactual" src="images/logo.png">
                                    <div id="div_cambiarlogo">
                                        <label class="control-label" for="inputDefault">Cambiar Logo</label>
                                        <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg"
                                            id="imagen">
                                        <p style="color: #3fc35f">- Se recomienda un logo cuadrado</p>
                                    </div>
                                </div>

                                <input type="hidden" name="idEmpresa" id="idEmpresa" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btn-guardar" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end section -->
<div class="clearfix"></div>
<?php require './footer.php'; ?>


<script type="text/javascript">
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('#tabla').DataTable();
});

function nuevaEmpresa() {
    $('#modalTitle').text('Nueva Empresa');
    $('#nit').val('');
    $('#nombre').val('');
    $('#direccion').val('');
    $('#telefono').val('');
    $('#email').val('');
    $('#sector').val('');
    $('#ciudad').val('');
    var imglogo = $("#imagen");
    imglogo.replaceWith(imglogo = imglogo.clone(true));

    desbloquearElementos();
    $('#div_logo').show();
    $('#div_nuevologo').hide();

    $('#mymodal').modal();
    $('#mymodal').show();
}

function editarEmpresa(id) {
    var obj = <?php echo $json; ?>;
    var select;
    for (var k in obj) {
        //console.log(obj[k].nombre);
        if (obj[k].idEmpresa == id) {
            select = obj[k];
        }
    }
    //alert(JSON.stringify(select.codigo));
    crearModal('Editar Empresa', select, false, true);
}

function verEmpresa(id) {
    var obj = <?php echo $json; ?>;
    var select;
    for (var k in obj) {
        if (obj[k].idEmpresa == id) {
            select = obj[k];
        }
    }

    crearModal('Vista Empresa', select, true, false);
}

function crearModal(titulo, data, ver, conid) {
    desbloquearElementos();
    $('#modalTitle').text(titulo);
    $('#nit').val(data.nit);
    $('#nombre').val(data.nombre);
    $('#direccion').val(data.direccion);
    $('#telefono').val(data.telefono);
    $('#email').val(data.email);
    $('#sector').val(data.sector);
    $('#ciudad').val(data.ciudad);


    if (ver === true) {
        bloquearElementos();
        $('#div_logo').hide();
        $('#div_nuevologo').show();
        $('#div_cambiarlogo').hide();
        $("#logoactual").attr("src", data.logo);
    }

    if (conid === true) {
        $('#div_cambiarlogo').show();
        $('#div_logo').hide();
        $('#div_nuevologo').show();
        $('#idEmpresa').attr('value', data.idEmpresa);
        $("#logoactual").attr("src", data.logo);
    }
    $('#mymodal').modal();
    $('#mymodal').show();
}

function desbloquearElementos() {
    $('#nit').attr('disabled', false);
    $('#nombre').attr('disabled', false);
    $('#direccion').attr('disabled', false);
    $('#telefono').attr('disabled', false);
    $('#email').attr('disabled', false);
    $('#sector').attr('disabled', false);
    $('#ciudad').attr('disabled', false);
    $('#imagen').attr('disabled', false);
    $('#btn-guardar').attr('disabled', false);
}

function bloquearElementos() {
    $('#nit').attr('disabled', true);
    $('#nombre').attr('disabled', true);
    $('#direccion').attr('disabled', true);
    $('#telefono').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#sector').attr('disabled', true);
    $('#ciudad').attr('disabled', true);
    $('#imagen').attr('disabled', true);
    $('#btn-guardar').attr('disabled', true);
}
</script>