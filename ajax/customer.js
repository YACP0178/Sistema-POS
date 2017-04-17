$(document).ready(function(){
	$("form#customerform").submit(saveCustomer);
    $(".deleteCustomer").click(deleteCustomer);
});

function saveCustomer(){
	var id = $('input#id').val();
    var cc = $('input#cc').val();
	var name = $('input#name').val();
	var lastname = $('input#lastname').val();
	var email = $('input#email').val();
    var phone = $('input#phone').val();
    var address = $('input#address').val();

    var arrData = {
        id:id,
        cc:cc,
    	name:name,
    	lastname:lastname,
    	email:email,
    	phone:phone,
    	address:address
    }


    $.post(baseUrl+'customer/save', 
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


 function deleteCustomer(){
    var thisObj = $(this);
    var customer = thisObj.attr('dataname');
    var id = thisObj.attr('dataid');
    
    var confirmar = confirm("Eliminar a " + customer + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
        var arrData = {
            id:id
        }

        $.post(baseUrl + 'customer/delete',
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

