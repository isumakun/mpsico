<?php $title = 'Exportar Excel'; ?>
<?php require './header.php'; ?>  

<?php
require_once 'funciones.php';
$link = conectar();

$sql = "SELECT 
		a.idAspirante as ID, 
		CONCAT(a.Nombre, ' ', a.Apellido1, ' ', a.Apellido2) AS Aspirante, 
		e.Nombre as 'Empresa', 
		fp.Ciudad, 
		area.Nombre as 'Area', 
		a.Cedula,
		c.*,
		fp.*, 
		ft.*
		FROM aspirante as a
		INNER JOIN fichapersonal as fp
		ON fp.Aspirante_idAspirante = a.idAspirante
		INNER JOIN fichatrabajo as ft
		ON ft.Aspirante_idAspirante = a.idAspirante
		INNER JOIN area
		ON area.idArea = ft.Area_idArea
		INNER JOIN empresa as e
		ON e.idEmpresa = area.Empresa_idEmpresa
		INNER JOIN cuestionario as c
		ON c.Aspirante_idAspirante = a.idAspirante
		WHERE e.idEmpresa = '{$_GET['empresa']}' AND c.Numero = '{$_GET['numero']}'";


$query = mysql_query($sql, $link);
?>

<style type="text/css">
	td,td,th{
		font-size: 12px !important;
	}

	table{
		display: none;
	}
</style>

<div class="box box-primary">
	<div class="box-header">

	<?php if ($_GET['numero']==3) {
		?>
		<a href="javascript:tableToExcel('export_table', 'Reporte_Intralaboral_FORMA_A')" class="btn btn-success"><i class="fa fa-download"></i> Exportar a Excel</a>
		<?php
	}else{
		?>
		<a href="javascript:tableToExcel('export_table', 'Reporte_Intralaboral_FORMA_B')" class="btn btn-success"><i class="fa fa-download"></i> Exportar a Excel</a>
		<?php
	} ?>

		<div class="table-responsive">
			<table class="table-bordered" id="export_table">
				<thead>
					<?php
					if ($_GET['numero']==3) {
						$dom1 = 4;
						$dom2 = 9;
						$dom3 = 17;
						?>
						<tr>
							<th>Empresa</th>
							<th>Ciudad</th>
							<th>Área</th>
							<th>Cédula</th>
							<th>Nombre</th>
							<th>Genero</th>
							<th>Estado Civil</th>
							<th>Escolaridad</th>
							<th>Estrato</th>
							<th>Tipo Vivienda</th>
							<th>Antiguedad</th>
							<th>Tipo Cargo</th>

							<th class="d1">Caracteristicas Liderazgo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Relaciones Sociales</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Retroal. Desempeño</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Relación colaboradores</th>
							<th class="d1">Interpretación</th>

							<th class="d2">Claridad de rol</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Capacitación</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Participación y manejo del cambio</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Oportunidades para el desarrollo</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Control y autonomia sobre el trabajo</th>
							<th class="d2">Interpretación</th>

							<th class="d3">Demandas ambientales y de esfuerzo fisico</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas emocionales</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas cuantitativas</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Influencia sobre el entorno extra</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Exigencias de responsabilidad</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas de carga menta</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Consistencia de rol</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas de jornada laboral</th>
							<th class="d3">Interpretación</th>

							<th class="d4">recompensas de pertenencia y trabajo</th>
							<th class="d4">Interpretación</th>
							<th class="d4">Reconocimiento y compensación</th>
							<th class="d4">Interpretación</th>


							<th class="d1" colspan="2">Liderazgo y relaciones sociales en el trabajo</th>
							<th class="d2" colspan="2">Control sobre el trabajo</th>
							<th class="d3" colspan="2">Demandas del Trabajo</th>
							<th class="d4" colspan="2">Recompensas</th>

							<th class="d5">Total Intralaboral Forma A</th>
							<th class="d5">Interpretación</th>	

							<th class="d1">Tiempo fuera del trabajo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Relaciones familiares</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Comunicación y relaciones interpersonales</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Situación económica del grupo familiar</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Características de la vivienda y de su entorno</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Influencia del entorno extralaboral sobre el trabajo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Desplazamiento vivienda, trabajo, vivienda</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Puntaje Extralaboral</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Puntaje Estres</th>
							<th class="d1">Interpretación</th>
						</tr>
						<?php
					}else if ($_GET['numero']==4) {
						$dom1 = 3;
						$dom2 = 8;
						$dom3 = 15;
						?>
						<tr>
							<th>Empresa</th>
							<th>Ciudad</th>
							<th>Área</th>
							<th>Cédula</th>
							<th>Nombre</th>
							<th>Genero</th>
							<th>Estado Civil</th>
							<th>Escolaridad</th>
							<th>Estrato</th>
							<th>Tipo Vivienda</th>
							<th>Antiguedad</th>
							<th>Tipo Cargo</th>

							<!-- Dominio 1 -->
							<th class="d1">Caracteristicas Liderazgo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Relaciones Sociales</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Retroal. Desempeño</th>
							<th class="d1">Interpretación</th>

							<!-- Dominio 2 -->
							<th class="d2">Claridad de rol</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Capacitación</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Participación y manejo del cambio</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Oportunidades para el desarrollo</th>
							<th class="d2">Interpretación</th>
							<th class="d2">Control y autonomia sobre el trabajo</th>
							<th class="d2">Interpretación</th>

							<!-- Dominio 3 -->
							<th class="d3">Demandas ambientales y de esfuerzo fisico</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas emocionales</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas cuantitativas</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Influencia sobre el entorno extra</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas de carga menta</th>
							<th class="d3">Interpretación</th>
							<th class="d3">Demandas de jornada laboral</th>
							<th class="d3">Interpretación</th>

							<!-- Dominio 4 -->
							<th class="d4">Recompensas de pertenencia y trabajo</th>
							<th class="d4">Interpretación</th>
							<th class="d4">Reconocimiento y compensación</th>
							<th class="d4">Interpretación</th>

							<th class="d1" colspan="2">Liderazgo y relaciones sociales en el trabajo</th>
							<th class="d2" colspan="2">Control sobre el trabajo</th>
							<th class="d3" colspan="2">Demandas del Trabajo</th>
							<th class="d4" colspan="2">Recompensas</th>

							<th class="d5">Total Intralaboral Forma B</th>
							<th class="d5">Interpretación</th>

							<th class="d1">Tiempo fuera del trabajo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Relaciones familiares</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Comunicación y relaciones interpersonales</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Situación económica del grupo familiar</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Características de la vivienda y de su entorno</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Influencia del entorno extralaboral sobre el trabajo</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Desplazamiento vivienda  trabajo  vivienda</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Puntaje Extralaboral</th>
							<th class="d1">Interpretación</th>
							<th class="d1">Puntaje Estres</th>
							<th class="d1">Interpretación</th>

						</tr>
						<?php
					}
					?>
				</thead>
				<tbody>
					<?php

					while ($line = mysql_fetch_array($query)) {
						?>
						<tr>
							<td><?= $line['Empresa']; ?></td>
							<td><?= utf8_encode($line['Ciudad']); ?></td>
							<td><?= utf8_encode($line['Area']); ?></td>
							<td><?= $line['Cedula']; ?></td>
							<td><?= utf8_encode($line['Aspirante']); ?></td>
							<td><?= $line['Sexo']; ?></td>
							<td><?= utf8_encode($line['EstadoCivil']); ?></td>
							<td><?= utf8_encode($line['NivelEstudios']); ?></td>
							<td><?= $line['Estrato']; ?></td>
							<td><?= utf8_encode($line['Vivienda']); ?></td>
							<td><?= utf8_encode($line['Tiempo']); ?></td>
							<td><?= utf8_encode($line['TipoCargo']); ?></td>
							<?php
							$pun = 0;
							$inter = "";

							$sql3 = "
							SELECT dominio.Puntaje AS 'dom_pun', 
							dominio.Valor AS 'dom_val', 
							cuestionario.PTC, 
							cuestionario.BaremoPTC
							FROM
							dominio
							INNER JOIN cuestionario
							ON (dominio.Cuestionario_idCuestionario = cuestionario.idCuestionario)
							WHERE cuestionario.Aspirante_idAspirante = {$line['ID']} AND Numero = ".$_GET['numero'];

							$domPuntajes = array();
							$domValores = array();

							$result = mysql_query($sql3, $link);

							while ($row = mysql_fetch_array($result)) {
								array_push($domPuntajes, $row['dom_pun']);
								array_push($domValores, $row['dom_val']);
							}

							$sql2 = "SELECT dimension.Puntaje, dimension.Valor
							FROM
							dimension
							INNER JOIN cuestionario
							ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
							WHERE cuestionario.Aspirante_idAspirante = " . $line['ID'] . " AND Numero = ".$_GET['numero'];
							
							$query2 = mysql_query($sql2, $link);

							$aux = 0;

							while ($row = mysql_fetch_array($query2)) {
								if ($aux == 3) {
									if ($_GET['numero']==3) {
										if ($line['TipoCargo']=='Jefatura - tiene personal a cargo') {
											?>
											<td><?= $row['Puntaje'] ?></td>
											<td><?= $row['Valor'] ?></td>
											<?php
										}else{
											?>
											<td>N/A</td>
											<td>N/A</td>
											<?php
										}
									}
								}else{
									?>
									<td><?= $row['Puntaje'] ?></td>
									<td><?= $row['Valor'] ?></td>
									<?php
								}
								$aux++;
							}
							?>
							<td><?=$domPuntajes[0]?></td>
							<td><?=$domValores[0]?></td>
							<td><?=$domPuntajes[1]?></td>
							<td><?=$domValores[1]?></td>
							<td><?=$domPuntajes[2]?></td>
							<td><?=$domValores[2]?></td>
							<td><?=$domPuntajes[3]?></td>
							<td><?=$domValores[3]?></td>
							<td><?=$line['PTC']?><</td>
							<td><?=$line['BaremoPTC']?><</td>
							<?php
							$dimensionesExtra = "SELECT dimension.Puntaje, dimension.Valor
							FROM
							dimension
							INNER JOIN cuestionario
							ON (dimension.Cuestionario_idCuestionario = cuestionario.idCuestionario)
							WHERE cuestionario.Aspirante_idAspirante = " . $line['ID'] . " AND Numero = 2";

							$queryEx = mysql_query($dimensionesExtra, $link);

							$dimens = array();

							while ($row = mysql_fetch_array($queryEx)) {
								$dimens[] = $row;
							}

							foreach ($dimens as $dim) {
								?>
								<td><?= $dim['Puntaje'] ?></td>
								<td><?= $dim['Valor'] ?></td>
								<?php
							}

							$sql5 = "SELECT c.*
							FROM aspirante as a
							INNER JOIN fichapersonal as fp
							ON fp.Aspirante_idAspirante = a.idAspirante
							INNER JOIN fichatrabajo as ft
							ON ft.Aspirante_idAspirante = a.idAspirante
							INNER JOIN area
							ON area.idArea = ft.Area_idArea
							INNER JOIN empresa as e
							ON e.idEmpresa = area.Empresa_idEmpresa
							INNER JOIN cuestionario as c
							ON c.Aspirante_idAspirante = a.idAspirante
							WHERE a.idAspirante = {$line['ID']} AND (c.Numero = 1 OR c.Numero = 2)
							ORDER BY c.Numero DESC";


							$result = mysql_query($sql5, $link);

							$rows =  array();

							while ($row = mysql_fetch_array($result)) {
								$rows[] = $row;
							}
							
							foreach ($rows as $row) {
								?>
								<td><?= $row['PTC'] ?></td>
								<td><?= $row['BaremoPTC'] ?></td>
								<?php
							}
							?>
						</tr>
						<?php
					}
					?>

				</tbody></table>
			</div>
		</div>
	</div>

	<?php require './footer.php'; ?>


	<!-- ============ JS FILES ============ --> 

	<script type="text/javascript" src="js/universal/jquery.js"></script> 
	<script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script> 
	<script src="js/masterslider/jquery.easing.min.js"></script> 
	<script src="js/masterslider/masterslider.min.js"></script> 
	<script type="text/javascript">
		(function ($) {
			"use strict";
			var slider = new MasterSlider();
                // adds Arrows navigation control to the slider.
                slider.control('arrows');
                slider.control('bullets');

                slider.setup('masterslider', {
                    width: 1600, // slider standard width
                    height: 630, // slider standard height
                    space: 0,
                    speed: 45,
                    layout: 'fullwidth',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "parallaxMask"
                });

            })(jQuery);
        </script> 
        <script type="text/javascript">
        	(function ($) {
        		"use strict";
        		var slider = new MasterSlider();

        		slider.setup('masterslider2', {
                    width: 570, // slider standard width
                    height: 300, // slider standard height
                    space: 0,
                    speed: 27,
                    layout: 'boxed',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "basic",
                });
        	})(jQuery);
        </script> 
        <script type="text/javascript">
		function tableToExcel(name1, name2){

		    //getting data from our table
		    var data_type = 'data:application/vnd.ms-excel';
		    var table_div = document.getElementById('export_table');
		    var html = table_div.outerHTML.replace(/ /g, '%20');

		     while (html.indexOf('á') != -1) html = html.replace('á', '&aacute;');
			  while (html.indexOf('é') != -1) html = html.replace('é', '&eacute;');
			  while (html.indexOf('í') != -1) html = html.replace('í', '&iacute;');
			  while (html.indexOf('ó') != -1) html = html.replace('ó', '&oacute;');
			  while (html.indexOf('ú') != -1) html = html.replace('ú', '&uacute;');
			  while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;');

		    var a = document.createElement('a');
		    a.href = data_type + ', ' + html;
		    a.download = name2+'.xls';
		    a.click();
		}
		</script>
        <script src="dist/js/xlsx.core.min.js"></script>
        <script src="dist/js/FileSaver.min.js"></script>
        <script src="dist/js/tableexport.js"></script>
        <script type="text/javascript">
        	$(".table").tableExport();
        </script>
        <script src="js/mainmenu/customeUI.js"></script>  
        <script src="js/owl-carousel/owl.carousel.js"></script> 
        <script src="js/owl-carousel/custom.js"></script> 
        <script type="text/javascript" src="js/tabs/smk-accordion.js"></script>
        <script type="text/javascript" src="js/tabs/custom.js"></script> 
        <script src="js/scrolltotop/totop.js"></script> 
        <script src="js/mainmenu/jquery.sticky.js"></script> 
        <script src="js/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> 
        <script src="js/style-swicher/style-swicher.js"></script> 
        <script src="js/style-swicher/custom.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.form.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/additional-methods.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/smart-form.js"></script> 
        <script src="js/scripts/functions.js" type="text/javascript"></script>

    </body>

    <!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->
    </html>