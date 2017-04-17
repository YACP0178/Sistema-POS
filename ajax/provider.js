$(document).ready(function(){
	$("form#providerform").submit(saveProvider);
    $(".deleteProvider").click(deleteProvider);
});

function saveProvider(){
	var id = $('input#id').val();
    var nit = $('input#nit').val();
	var name = $('input#name').val();
	var lastname = $('input#lastname').val();
	var email = $('input#email').val();
    var phone = $('input#phone').val();
    var address = $('input#address').val();

    var arrData = {
        id:id,
        nit:nit,
    	name:name,
    	lastname:lastname,
    	email:email,
    	phone:phone,
    	address:address
    }


    $.post(baseUrl+'provider/save', 
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


 function deleteProvider(){
    var thisObj = $(this);
    var provider = thisObj.attr('dataname');
    var id = thisObj.attr('dataid');
    
    var confirmar = confirm("Eliminar a " + provider + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
        var arrData = {
            id:id
        }

        $.post(baseUrl + 'provider/delete',
            { 
                arrData:arrData
            },
            function(data) {
                var dato =$.parseJSON(data);
                $("#message").html(dato.msg);
                thisObj.parent().parent().remove();
            }
        ); 
    }
 }

