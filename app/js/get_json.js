
$(document).ready(function() {

	var array = $(".grid_ajax").children().children().children().map(function() {
    	return $(this).attr('data-field');
	}).get();
	
	//DEBUG
	//console.log(JSON.stringify(array));

	var grid_url = $('.grid_ajax').data('url');

	//DEBUG
	//console.log(JSON.stringify(array));

    var oTable = $('.grid_ajax').dataTable({
    	"deferRender": true
    });

    $.ajax({ 
	    type: 'GET', 
	    url: grid_url,
	    data: { get_param: 'value' }, 
	    dataType: 'json',
		    success: function (data) {
		    	
		    	oTable.fnClearTable();

		        $.each(data, function(index, element) {
		        	var addData = [];
		            for (var i = 0; i < array.length; i++) {
		            	if(array[i]===""){
		            		addData.push("");
		            	}else{
		            		addData.push(""+eval('element.'+array[i]));
		            	}
		            };
		            oTable.fnAddData(addData);
		        });
		    }
		});
});
