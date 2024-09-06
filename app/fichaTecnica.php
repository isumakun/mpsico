<?php $title = ''; ?>
<?php require './headerFicha.php'; ?>   

<link href="css/cuestionario.css" rel="stylesheet" media="all">
<div class="box box-primary">
    <div class="box-body">


            <div class="col-xs-12 text-center">
                <center><h3><b>FICHA TÉCNICA</b></h3></center>
                <div class="title-line-4 blue less-margin align-center"></div>
            </div>
            <form method="POST" autocomplete="off" action="crudCuestionario/insertarFicha.php" style="text-align: justify">
                <div class="divcenter">
                    <i>Las siguientes son algunas preguntas que se refieren a información general de usted.</i><br><br>

                    <div class="row">
                        <div class="col-lg-12">

                            <?php include './crudAspirante/aspiranteFichaTecnica.php'; ?>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <div class="radio inline">
                                        <label>
                                            <input type="radio" name="sexo" value="m" checked="">
                                            Masculino
                                        </label>
                                        <label>
                                            <input type="radio" name="sexo" value="f">
                                            Femenino
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Año Nacimiento</label>
                                <select maxlength="4" class="form-control" required=""  name="nacimiento" id="nacimiento" placeholder="Año Nacimiento del aspirante">
                                   <script>
                                       var myDate = new Date();
                                       var year = myDate.getFullYear();
                                       for(var i = 1900; i < year+1; i++){
                                        document.write('<option value="'+i+'">'+i+'</option>');
                                    }
                                </script>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="select" class="control-label">Estado Civil</label>
                            <select class="form-control" name="estadocivil" required=""  id="estadocivil">
                             <option></option>
                             <option>Soltero (a)</option>
                             <option>Casado (a)</option>
                             <option>Unión libre</option>
                             <option>Separado (a)</option>
                             <option>Divorciado (a)</option>
                             <option>Viudo (a)</option>
                             <option>Sacerdote/Monja</option>
                         </select>
                     </div>

                     <div class="form-group">
                        <label for="select" class="control-label">Último nivel de estudios que alcanzó</label>
                        <select class="form-control" name="nivel" required=""  id="nivel">
                            <option>Ninguno</option>
                            <option>Primaria incompleta</option>
                            <option>Primaria completa</option>
                            <option>Bachillerato incompleto</option>
                            <option>Bachillerato completo</option>
                            <option>Técnico/Tecnólogo incompleto</option>
                            <option>Técnico/Tecnólogo completo</option>
                            <option>Profesional incompleto</option>
                            <option>Profesional completo</option>
                            <option>Carrera Militar/policía</option>
                            <option>Post-grado incompleto</option>
                            <option>Post-grado completo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputDefault">¿Cual es su ocupación o profesión?</label>
                        <input type="text" class="form-control" required=""  name="ocupacion" id="ocupacion" placeholder="Ocupación o Profesión del aspirante">
                    </div>

                    <div class="form-group">
                        <label for="select" class="control-label">Seleccione su estrato</label>
                        <select class="form-control" name="estrato" required=""  id="estrato">
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>Finca</option>
                            <option>No sé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select" class="control-label">Seleccione el tipo de vivienda</label>
                        <select class="form-control" name="tipovivienda" required=""  id="tipovivienda">
                            <option></option>
                            <option>Propia</option>
                            <option>En arriendo</option>
                            <option>Familiar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputDefault">Número de personas a cargo</label>
                        <input type="text" class="form-control" onkeypress="return isNumber(event)" maxlength="2" required=""  name="personas" id="personas" placeholder="Personas que tiene a su cargo">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputDefault">Lugar de residencia actual</label>

                        <input type="text" class="form-control" required="" value="" name="ciudadR" id="ciudadR" placeholder="Ciudad">
                        <br>
                        <input type="text" class="form-control" required=""  name="departamentoR" id="departamentoR" placeholder="Departamento">
                    </div>
                </div>
            </div>
            <div class="row">
                <i>Las siguientes son algunas preguntas que se refieren a información general de su ocupación.</i><br><br>

                <div class="form-group">
                    <label class="control-label" for="inputDefault">Lugar donde trabaja actualmente</label>
                    <input type="text" class="form-control" required=""  name="ciudadT" id="ciudadT" placeholder="Ciudad">
                    <br>
                    <input type="text" class="form-control" required=""  name="departamentoT" id="departamentoT" placeholder="Departamento">
                </div>

                <div class="form-group">
                    <label for="select" class="control-label">¿Hace cuantos años que trabaja en esta empresa?</label>
                    <select class="form-control" name="tiempoT" required=""  id="tiempoT">
                     <option></option>
                     <option>Menos de un año</option>
                     <option>De 1 a 5 años</option>
                     <option>De 5 a 10 años</option>
                     <option>Más de 10 años</option>
                 </select>
             </div>

             <div class="form-group">
                <label class="control-label" for="inputDefault">¿Cuál es el nombre del cargo que desempeña?</label>
                <input type="text" class="form-control" required=""  name="cargo" id="cargo" placeholder="">
            </div>

            <div class="form-group">
                <label for="select" class="control-label">Seleccione el tipo de cargo que más se le parece al que desempeña.
                Si tiene dudas pida apoyo a la persona encargada</label>
                <select class="form-control" name="tipocargo" required=""  id="tipocargo">
                    <option></option>
                    <option>Jefatura - tiene personal a cargo</option>
                    <option>Profesional, analista, técnico, tecnólogo</option>
                    <option>Auxiliar, asistente administrativo, asistente técnico</option>
                    <option>Operario, operador, ayudante, servicios generales</option>
                </select>
            </div>

            <div class="form-group">
                <label for="select" class="control-label">¿Hace cuantos años desempeña el cargo u oficio actual en esta empresa?</label>
                <select class="form-control" name="tiempocargo" required=""  id="tiempocargo">
                    <option></option>
                    <option>Menos de un año</option>
                    <option>Más de un año</option>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Escriba el nombre del departamento, área o sección de la empresa
                en el que trabaja</label>
                <select class="form-control" name="area" required=""  id="area">
                    <?php require_once './crudArea/generarListaAreas.php'; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="select" class="control-label">Seleccione el tipo de contrato</label>
                <select class="form-control" name="tipocontrato" required=""  id="tipocontrato">
                    <option></option>
                    <option>Temporal de menos de 1 año</option>
                    <option>Temporal de 1 año o más</option>
                    <option>Término indefinido</option>
                    <option>Cooperado (cooperativa)</option>
                    <option>Prestación de servicios</option>
                    <option>No sé</option>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="inputDefault">Indique cuantas horas diarias de trabajo
                están establecidas habitualmente por la empresa para su cargo</label>
                <input type="number" class="form-control" required="" maxlength="2" min="1"  name="horas" id="horas" placeholder="Horas que dicta la empresa a su cargo">
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Seleccione el tipo de salario que recibe</label>
                <select class="form-control" name="tiposalario" required=""  id="tiposalario">
                    <option></option>
                    <option>Fijo (diario, semanal, quincenal o mensual)</option>
                    <option>Una parte fija y otra variable</option>
                    <option>Todo variable (a destajo, por producción, por comisión)</option>
                </select>
            </div>
        </div>

    </div>
    <center>
        <button type="submit" id="btn-continuar" class="btn btn-primary hvr-bob">Continuar</button>
    </center>
</form>
</div>
</div>


<?php require './footer.php'; ?>
</div>
<!-- end site wraper --> 

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script language="javascript">
/*var states = new Array("Amazonas", "Antioquia", "Arauca", "Atlantico", "Bogota District Capital", "Bolivar", "Boyaca", "Caldas", "Caqueta", "Casanare", "Cauca", "Cesar", "Choco", "Cordoba", "Cundinamarca", "Guainia", "Guaviare", "Huila", "La Guajira", "Magdalena", "Meta", "Narino", "Norte de Santander", "Putumayo", "Quindio", "Risaralda", "San Andres & Providencia", "Santander", "Sucre", "Tolima", "Valle del Cauca", "Vaupes", "Vichada");
for(var hi=0; hi<states.length; hi++){
$('#departamentoR').append("<option value=\""+states[hi]+"\">"+states[hi]+"</option>");
$('#departamentoT').append("<option value=\""+states[hi]+"\">"+states[hi]+"</option>");*/
}
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

</body>

<!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->
</html>
