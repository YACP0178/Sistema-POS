$(document).ready(function(){
	$("form#categoryform").submit(saveCategory);
    $(".deleteCategory").click(deleteCategory);
});

function saveCategory(){
	var id = $('input#id').val();
	var code = $('input#code').val();
	var name = $('input#name').val();

    var arrData = {
        id:id,
    	code:code,
    	name:name
    }


    $.post(baseUrl+'category/save', 
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


 function deleteCategory(){
    var thisObj = $(this);
    var name = thisObj.attr('dataname');
    var id = thisObj.attr('dataid');
    
    var confirmar = confirm("Eliminar a " + name + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
        var arrData = {
            id:id
        }

        $.post(baseUrl + 'category/delete',
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

