$(document).ready(function(){
	$("form#productform").submit(saveProduct);
    $(".deleteProduct").click(deleteProduct);
});

function saveProduct(){
	var id = $('input#id').val();
	var code = $('input#code').val();
	var ref = $('input#ref').val();
	var description = $('input#description').val();
    var category = $('select#category').val();
    var tax = $('select#tax').val();
    var coste = $('input#coste').val();
    var price = $('input#price').val();
    var stockmin = $('input#stockmin').val();
    var location = $('input#location').val();
    var unit = $('input#unit').val();
    var size = $('input#size').val();

    var arrData = {
        id:id,
    	code:code,
    	ref:ref,
    	description:description,
    	category:category,
        tax:tax,
    	coste:coste,
        price:price,
        stockmin:stockmin,
        location:location,
        unit:unit,
        size:size
    }


    $.post(baseUrl+'product/save', 
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


 function deleteProduct(){
    var thisObj = $(this);
    var product = thisObj.attr('dataname');
    var id = thisObj.attr('dataid');
    
    var confirmar = confirm("Eliminar a " + product + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
        var arrData = {
            id:id
        }

        $.post(baseUrl + 'product/delete',
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

