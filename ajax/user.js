$(document).ready(function(){
	$("form#userform").submit(saveUser);
    $(".deleteUser").click(deleteUser);
});

function saveUser(){
	var id = $('input#id').val();
	var name = $('input#name').val();
	var lastname = $('input#lastname').val();
	var username = $('input#username').val();
    var password = $('input#password').val();
    var password2 = $('input#password2').val();

    var arrData = {
        id:id,
    	name:name,
    	lastname:lastname,
    	username:username,
    	password:password,
    	password2:password2
    }


    $.post(baseUrl+'user/save', 
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


 function deleteUser(){
    var thisObj = $(this);
    var user = thisObj.attr('dataname');
    var id = thisObj.attr('dataid');
    
    var confirmar = confirm("Eliminar a " + user + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
        var arrData = {
            id:id
        }

        $.post(baseUrl + 'user/delete',
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

