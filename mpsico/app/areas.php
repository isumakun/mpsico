<?php $title = 'Áreas'; ?>
<?php require './header.php'; ?>  
<link href="css/cuestionario.css" rel="stylesheet" media="all">

<div class="box box-primary">
    <div class="box-header">
        <a href="#" onclick="nuevaArea()" class="btn btn-primary btn-raised pull-right">Nueva Área</a>
    </div>

    <div class="box-body">
        <table id="tabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <?php include './crudArea/verAreas.php'; ?>
        </table>
    </div>
    <!-- end section -->

    <div id="mymodal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" action="crudArea/insertarArea.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 id="modalTitle" class="modal-title"><strong>Nueva Área</strong></h4>
                    </div>
                    <div class="modal-body" id="modalBody">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label class="control-label" for="inputDefault">Nombre</label>
                                        <input type="text" class="form-control" required=""  name="nombre" id="nombre" placeholder="Nombre del Área">
                                    </div>

                                    <div class="form-group">
                                        <label for="select" class="control-label">Empresa</label>
                                        <br>
                                        <select class="select2" style="width: 100%" name="empresa" required=""  id="empresa">
                                            <?php require_once './crudEmpresa/generarListaEmpresas.php'; ?>
                                        </select>
                                    </div>

                                    <input type="hidden" name="idArea" id="idArea" />
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

    <div class="clearfix"></div>
    <?php require './footer.php'; ?>
</div>
<!-- end site wraper --> 

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#tabla').DataTable();
    });

    function nuevaArea() {
        $('#modalTitle').text('Nueva Área');
        $('#nombre').val('');

        desbloquearElementos();

        $('#mymodal').modal();
        $('#mymodal').show();
    }

    function editarArea(id) {
        var obj = <?php echo $json; ?>;
        var select;
        for (var k in obj) {
                                                //console.log(obj[k].nombre);
                                                if (obj[k].idArea == id) {
                                                    select = obj[k];
                                                }
                                            }
                                            //alert(JSON.stringify(select.codigo));
                                            crearModal('Editar Área', select, false, true);
                                        }

                                        function verArea(id) {
                                            var obj = <?php echo $json; ?>;
                                            var select;
                                            for (var k in obj) {
                                                if (obj[k].idArea == id) {
                                                    select = obj[k];
                                                }
                                            }

                                            crearModal('Vista Área', select, true, false);
                                        }

                                        function crearModal(titulo, data, ver, conid) {
                                            desbloquearElementos();
                                            $('#modalTitle').text(titulo);
                                            $('#nombre').val(data.nombre);
                                            $("#empresa option").each(function ()
                                            {
                                                if ($(this).val() === data.idEmpresa) {
                                                    $(this).attr('selected', 'selected');
                                                }
                                            });

                                            if (ver === true) {
                                                bloquearElementos();
                                            }

                                            if (conid === true) {
                                                $('#idArea').attr('value', data.idArea);
                                            }
                                            $('#mymodal').modal();
                                            $('#mymodal').show();
                                        }

                                        function desbloquearElementos() {
                                            $('#nombre').attr('disabled', false);
                                            $('#empresa').attr('disabled', false);
                                            $('#btn-guardar').attr('disabled', false);
                                        }

                                        function bloquearElementos() {
                                            $('#nombre').attr('disabled', true);
                                            $('#empresa').attr('disabled', true);
                                            $('#btn-guardar').attr('disabled', true);
                                        }
                                    </script>
