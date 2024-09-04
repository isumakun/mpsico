<?php $title = ''; ?>
<?php require './header.php'; ?>
<?php require_once './crudArea/get_areas.php';?>
<link href="css/cuestionario.css" rel="stylesheet" media="all">

<div class="col-md-6">
<div class="box box-primary">
    <form id="form" method="POST" enctype="multipart/form-data" action="informeGeneral.php">
    <div class="box-header with-border">
       <h2 class="box-title">Generar Informe General</h2>
    <button class="btn btn-primary pull-right" type="submit">Generar</button>
    </div>
    <div class="box-body">
        
            <div class="col-md-12">                            
                <div class="form-group">
                    <label class="control-label" for="inputDefault">Seleccione la empresa para generar el informe</label>
                    <select class="form-control select2" name="empresa[]" required="" id="empresas" multiple>
                        <?php require_once './crudEmpresa/generarListaEmpresasSelect.php'; ?>
                    </select>
                    <br><br>
                    <label class="control-label" for="inputDefault">Seleccione el área</label>
                    <select class="form-control select2" name="area" required=""  id="areas">
                        <option value="all">Todas</option>
                    </select>
                </div>
            </div>
        
    </div>
    </form>
</div>
</div>

<?php require './footer.php'; ?>

<script type="text/javascript">
    var areas;

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#tabla').DataTable();
        areas = <?=json_encode($areas)?>;
        console.log(areas);
    });

    $('#empresas').on('change', function(){
       var empresas_seleccionadas =  $("#empresas option:selected").map(function(){ return this.value }).get().join(", ");

       empresas_seleccionadas = empresas_seleccionadas.split(',');

               //console.log(options);
               //console.log(areas);
               $('#areas').empty();
               $('#areas').append($("<option />").val('all').text('Todas'));

               for (var i = 0; i < empresas_seleccionadas.length; i++) {
                //console.log('Empresa: '+empresas_seleccionadas[i]);
                //console.log('-------------------------');
                for (var j = 0; j < areas.length; j++) {
                    //console.log(areas[j]['idEmpresa']+'=='+empresas_seleccionadas[i]);
                    if (empresas_seleccionadas[i].includes(areas[j]['idEmpresa'])) {
                        //console.log('Areas: '+areas[j]['area']);
                        $('#areas').append($('<option>', { 
                            value: areas[j]['idArea'],
                            text : areas[j]['empresa']+' - '+areas[j]['area']
                        }));
                    }
                }
            }
        })
    </script>

</body>

</html>
