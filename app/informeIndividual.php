<?php
$title = '';
require './header.php';
require './funciones.php';
error_reporting(0);
?>

<div class="box box-primary">
    <div class="box-header">
        <center><h3><b>Informe Individual</b></h3></center>
        <br><br>
        <div class="col-md-6">
            <label for="select" class="col-lg-6 control-label">Seleccione una empresa</label>
                <div class="col-lg-6">
                    <select class="form-control select2" name="empresa" required=""id="empresa">
                        <option></option>
                        <?php require_once './crudEmpresa/generarListaEmpresasSelect.php'; ?>
                    </select>
                </div>
        </div>
    </div>
    <div class="box-body">
        <?php require 'crudAspirante/ajaxAspirantesInforme.php'; ?>
    </div>
</div>


<!-- end section -->
<div class="clearfix"></div>
<?php require './footer.php'; ?>
</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#tabla').DataTable({
            "aaSorting": []
        });

        $('#empresa').on('change', function () {
            location.href = 'informeIndividual.php?empresa='+this.value;
        });

        $('#company').on('change', function () {
            company = $('#company :selected').text();
        });

        $('.confirm').on('click', function () {
            confirm("Seguro que desea hacer esto?");
        });
    });
</script>
</html>
