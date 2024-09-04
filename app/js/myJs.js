jQuery(document).ready(function($)
{

	/*	Delete confirm # ---------------------------------------------*/
	$('a.confirm_action').click(function(e){var confirm_action = confirm('Seguro que desea hacer esto?');if (!confirm_action) e.preventDefault();});

	/*	Go back # ---------------------------------------------*/
	$('a.go_back').click(function(e) { window.history.back(); });

	var i = 0;
	$('a.view_modal').click(function(e)
	{
		e.preventDefault();
		var url = $(this).attr('href');

		if (url !== '#' && url !== '')
		{
			json_view_url = window.location.protocol + '//' + window.location.hostname + url;

			$('body').append('<div class="modal" id="viewing_modal_' + i + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div id="content_viewing_modal_'+i+'" class="modal-body">Loading...</div> <div class="modal-footer"> <button type="button" data-dismiss="modal">Close</button></div></div></div></div>');e.preventDefault();
			$('div#viewing_modal_' + i).modal('show');

			$('div#content_viewing_modal_' + i).load(json_view_url + ' #view_panel');

			i++;
		}
	});

	/*	Datatables # -------------------------------------------------*/
	var table = $('.table').DataTable({
		"sPaginationType": "simple_numbers",
		"aaSorting": [],
		"language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(busqueda de _MAX_ registros totales)",
            "search":         "Buscar: ",
		    "paginate": {
		        "first":      "Primera",
		        "last":       "Ultima",
		        "next":       "Siguiente",
		        "previous":   "Anterior"
		    }
        }
	});

	/*	DatePicker # -------------------------------------------------*/
	$('.date').Zebra_DatePicker();

	/*	Select filter # ----------------------------------------------*/
	/*$('SELECT.filter').chosen();*/

	//$('select').select2();

});