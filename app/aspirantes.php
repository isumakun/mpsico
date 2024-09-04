<?php $title = 'Aspirantes'; ?>
<?php require './header.php'; ?>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="box box-primary">
    <div class="box-header">
        <div class="col-lg-4">
            <div class="form-horizontal" role="form">
                <label for="select" class="col-lg-4 control-label">Empresa</label>
                <div class="col-lg-8">
                    <select class="form-control" name="empresa" required="" id="empresa">
                        <?php require_once './crudEmpresa/generarListaEmpresasSelect.php'; ?>
                    </select>
                </div>
            </div>
        </div>
        <a href="#" onclick="nuevoAspirante()" class="btn btn-primary pull-right">Nuevo Aspirante</a>
    </div>

    <div class="box-body">
        <?php require 'crudAspirante/ajaxAspirantes.php'; ?>
    </div>
</div>

<div id="mymodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" id="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="modalTitle" class="modal-title"><strong>Nuevo Aspirante</strong></h4>
                </div>
                <div class="modal-body" id="modalBody">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Cedula</label>
                                    <input type="text" class="form-control" required=""  name="cedula" id="cedula" placeholder="Cedula del aspirante">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Nombres</label>
                                    <input type="text" class="form-control" required=""  name="nombre" id="nombre" placeholder="Nombres del aspirante">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Primer Apellido</label>
                                    <input type="text" class="form-control" required=""  name="apellido1" id="apellido1" placeholder="Primer apellido del aspirante">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Segundo Apellido</label>
                                    <input type="text" class="form-control" required=""  name="apellido2" id="apellido2" placeholder="Segundo apellido del aspirante">
                                </div>

                                <div class="form-group">
                                    <label for="select" class="control-label">Forma</label>
                                    <select class="form-control" name="forma" required=""  id="forma">
                                        <option value="1">Forma A</option>
                                        <option value="2">Forma B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Telefono</label>
                                    <input type="text" class="form-control"  name="telefono" id="telefono" placeholder="Telefono del aspirante">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Direccion</label>
                                    <input type="text" class="form-control"  name="direccion" id="direccion" placeholder="Direccion del aspirante">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Email</label>
                                    <input type="text" class="form-control"  name="email" id="email" placeholder="Email del aspirante">
                                </div>

                                <div class="form-group">
                                    <label for="select" class="control-label">Empresa</label>
                                    <select class="form-control" name="empresa" required=""  id="company">
                                        <?php require_once './crudEmpresa/generarListaEmpresas.php'; ?>
                                    </select>
                                </div>

                                <input type="hidden" name="idAspirante" id="idAspirante" />
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
<!-- end site wraper --> 

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    var company='';
    var current_company = '<?=$_GET['empresa']?>'

    function change_area(idAspirante, idFichaTrabajo){
        console.log('change');
        var idArea = $("#asp_"+idAspirante).val();
        console.log(idArea);
        
        $.ajax({
            url: 'modelos/cambiar_area.php',
            type: 'POST',
            data: {idAspirante: idAspirante, idArea: idArea, idFichaTrabajo: idFichaTrabajo}
        })
        .done(function(data) {
            console.log(data);
            if (data=='ok') {
                toastr.success('Área cambiada')
            }else{
                toastr.error('No se pudo cambiar el área')
            }
        });
    }

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#tabla').DataTable({
            "aaSorting": []
        });

        $('#empresa').on('change', function () {
            location.href = 'aspirantes.php?empresa='+this.value;
        });

        if (current_company=='') {
            location.href = 'aspirantes.php?empresa='+$('#empresa :selected').val();
        }

        $('#empresa').select2();
        $('#empresa').trigger('change.select2');

        $('#company').on('change', function () {
            company = $('#company :selected').text();
        });

        $('.confirm').on('click', function () {
            confirm("Seguro que desea hacer esto?");
        });

        $('#form').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "crudAspirante/insertarAspirante.php",
                data: $("#form").serialize(),
                success: function(data) {
                  if (data=='ok') {
                    swal(
                      'Perfecto!',
                      'El nuevo usuario ha sido registrado!',
                      'success'
                      )
                    $('#form').trigger("reset");
                    if (company!='') {
                        $('#company').val(company);
                    }
                }else{
                    swal(
                      'Ups!',
                      'Ocurrió un error, contacta al admin!',
                      'error'
                      )
                }
            }
        })
            return false;
        })
    });

    function nuevoAspirante() {
        $('#modalTitle').text('Nuevo Aspirante');
        $('#form').trigger("reset");
        if (company!='') {
            $('#company').val(company);
        }

        desbloquearElementos();

        $('#mymodal').modal();
        $('#mymodal').show();
    }

    function editarAspirante(id) {
       $.ajax({
        type: "POST",
        url: "crudAspirante/getAspirante.php?id="+id,
        data: '',
        success: function(data) {
          crearModal('Editar Aspirante', data, false, true);
      }
  });
   }

   function verAspirante(id) {
     $.ajax({
        type: "POST",
        url: "crudAspirante/getAspirante.php?id="+id,
        data: '',
        success: function(data) {
          crearModal('Vista Aspirante', data, true, false);
      }
  });
 }

 function crearModal(titulo, data, ver, conid) {
    desbloquearElementos();
    $('#modalTitle').text(titulo);
    $('#cedula').val(data[0].cedula);
    $('#nombre').val(data[0].nombre);
    $('#apellido1').val(data[0].apellido1);
    $('#apellido2').val(data[0].apellido2);
    $('#telefono').val(data[0].telefono);
    $('#direccion').val(data[0].direccion);
    $('#email').val(data[0].email);
    $('#forma').each(function ()
    {
        if ($(this).val() === data[0].Forma) {
            $(this).attr('selected', 'selected');
        }
    });
    $("#empresa option").each(function ()
    {
        if ($(this).val() === data[0].idEmpresa) {
            $(this).attr('selected', 'selected');
        }
    });

    if (ver === true) {
        bloquearElementos();
    }

    if (conid === true) {
        $('#idAspirante').attr('value', data.idAspirante);
    }
    $('#mymodal').modal();
    $('#mymodal').show();
}

function desbloquearElementos() {
    $('#cedula').attr('disabled', false);
    $('#nombre').attr('disabled', false);
    $('#apellido1').attr('disabled', false);
    $('#apellido2').attr('disabled', false);
    $('#telefono').attr('disabled', false);
    $('#direccion').attr('disabled', false);
    $('#email').attr('disabled', false);
    $('#empresa').attr('disabled', false);
    $('#forma').attr('disabled', false);
    $('#btn-guardar').attr('disabled', false);
}

function bloquearElementos() {
    $('#cedula').attr('disabled', true);
    $('#nombre').attr('disabled', true);
    $('#apellido1').attr('disabled', true);
    $('#apellido2').attr('disabled', true);
    $('#telefono').attr('disabled', true);
    $('#direccion').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#empresa').attr('disabled', true);
    $('#forma').attr('disabled', true);
    $('#btn-guardar').attr('disabled', true);
}
</script>

</body>

<!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->
</html>
