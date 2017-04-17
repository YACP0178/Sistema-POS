$(document).ready(function(){
	$("form#configform").submit(saveConfig);
});

function saveConfig(){
	var id = $('input#id').val();
    var nit = $('input#nit').val();
	var company = $('input#company').val();
	var manager = $('input#manager').val();
    var phone = $('input#phone').val();
    var address = $('input#address').val();
    var mean = $("input#mean").is(':checked') ? 1 : 0;;

    var arrData = {
        id:id,
        company:company,
        nit:nit,
    	manager:manager,
    	mean:mean,
    	phone:phone,
    	address:address
    }


    $.post(baseUrl+'config/save', 
		{ 
			arrData: arrData
		},
		function(data) { 
			var dato =$.parseJSON(data);
			$("#massage").html(dato.msg);
		}
	);

	return false;

}