 var arrDataDetail = []

 $(function() {
    $("#provider").autocomplete({
            source: baseUrl + "provider/searchProvider",
             select: function(event, ui) {  
				$('#idprovider').val(ui.item.id);
           }  
    });

    $("#product").autocomplete({
            source: baseUrl + "product/searchProduct",
            select: function(event, ui) {  
            	$('#hidproduct').val(ui.item.id);
            	$('#href').val(ui.item.ref);
            	$('#hdescription').val(ui.item.description);
            	$('#hcoste').val(ui.item.coste);
            }  
    });
});

$(document).ready(function(){
	$("#product").keypress(function(e){
		if(e.which == 13){
			addProduct();
		}
	});

	$("#addProduct").click(addProduct);

	$(".deleteItem").click(deleteItem);

});

function addProduct(){
	 var id = $('#hidproduct').val();
    var ref = $('#href').val();
    var description = $('#hdescription').val();
    var coste = $('#hcoste').val();
    var tax = parseInt($('#htax').val());

    if(id == ''){
        alert('Seleccionar Producto');
    }else if(searchData(id)){
        alert('El Producto Ya ha sido Agregado');
    }else{
        $("#trdelete").parent().remove();
    

        var htmlProduct = '<tr>'+
                        '<td id="ref">'+ref+'</td>'+
                        '<td><input type="hidden"  class="form-control" id="idproduct'+id+'" value="'+id+'"><input type="hidden"  class="form-control" id="tax'+id+'" value="'+tax+'">'+description+'</td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="coste'+id+'" value="'+coste+'" size="5"></td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="flete'+id+'" value="" size="5"></td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="cant'+id+'" value="1" size="5"></td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="desc'+id+'" value="" size="5"></td>'+
                        '<td id="total">'+formatNumber.new(coste,"$")+'</td>'+
                        '<td><button type="button" id="btn'+id+'" dataname="'+description+'" onclick="deleteItem('+id+');" title="Eliminar Producto" class="btn btn-danger btn-xs deleteItem"><i class="fa fa-trash"></i></button></td>'+
                      '</tr>';  

        $(htmlProduct).prependTo("#carrito tbody");
        
        var desc = $('#desc'+id).val();
        data = {idproduct:id, productname:description , coste:parseInt($('#coste'+id).val()), flete:parseInt(0), cant:parseInt($('#cant'+id).val()), desc:(desc == ''  ? 0 : parseInt(desc)), tax:parseInt(tax)};

        arrDataDetail.push(data);
        valueFooter();

        $("#price"+id).focus();
	}

	clear();
}

function focusProduct(){
	$("#product").focus();
}

function clear(){
	$("#product").val('');
    $('#hidproduct').val('');
    $('#hdescription').val('');
    $('#hcoste').val('');
    $('#href').val('');
    $('#htax').val('');
}

function changeValue(id){
	var coste = $('#coste'+id).val();
	var cant = $('#cant'+id).val();
	var desc = $('#desc'+id).val();
	var flete = $('#flete'+id).val();
	var value = 0;

	if(cant == ''){
		alert('El valor de la cantidad es incorrecto');
		$('#cant'+id).val('1');
	}else if(parseInt(cant) < 1){
		alert('El valor de la cantidad es incorrecto');
		$('#cant'+id).val('1');
	}else if(parseInt(coste) < 1){
		alert('El valor del Precio es incorrecto');
		$('#coste'+id).val('1');
	}else if(parseInt(coste) < 0){
		alert('El valor del descuento es incorrecto');
	}else if(parseInt(flete) < 0){
		alert('El valor del Flete es incorrecto');
	}else{
        
        if(flete == '')
           flete = 0;

		costeflete = parseInt(coste)+parseInt(flete);

		value = parseInt(costeflete)*parseInt(cant);

		if(desc != ''){
			$("#subtotal").html(formatNumber.new(value,"$"));
			value = value-(value*(parseFloat(desc)/100));
			$("#total").html(formatNumber.new(value,"$"));
		}else{
			$("#subtotal").html(formatNumber.new(value,"$"));
			$("#total").html(formatNumber.new(value,"$"));
		}

		for(key in arrDataDetail){
			if(arrDataDetail[key].idproduct == id){
				arrDataDetail[key].idproduct = id;
				arrDataDetail[key].coste = parseInt(coste);
				arrDataDetail[key].flete = parseInt(flete);
				arrDataDetail[key].cant = parseInt(cant);
				arrDataDetail[key].desc = (desc == ''  ? 0 : parseInt(desc));
				break;
			}
		}

		valueFooter();	
	}
}


function searchData(id){
	for(key in arrDataDetail){
		if(arrDataDetail[key].idproduct == id){
			return true;
    	}
	}
	return false;
}

function valueFooter(){
	var subTotal = 0;
	var descTotal = 0;
	var valueTotal = 0;

	for(key in arrDataDetail){
		subTotal += (arrDataDetail[key].coste+arrDataDetail[key].flete) * arrDataDetail[key].cant; 
		if(arrDataDetail[key].desc > 0)
			descTotal += ((arrDataDetail[key].coste+arrDataDetail[key].flete) * arrDataDetail[key].cant)*(parseFloat(arrDataDetail[key].desc)/100);
	}

	valueTotal = subTotal - descTotal;

	//$('#lblsubTotal').html(formatNumber.new(subTotal,"$"));
	//$('#lbldesc').html(formatNumber.new(descTotal, "$"));
	$('#lbltotal').html(formatNumber.new(valueTotal, "$"));
}

function deleteItem(id){
	var thisObj = $('#btn'+id);
    var item = thisObj.attr('dataname');
	var confirmar = confirm("Esta seguro que desea remover el Item "+item); 

	if (confirmar){
		for(key in arrDataDetail){
			if(arrDataDetail[key].idproduct == id){
				arrDataDetail.splice(key,1);
				break;
			}
		}
		thisObj.parent().parent().remove();
		valueFooter();
	}
}

function saveInput(){
    waitingDialog.show();
	var arrData  = new Object();

	arrData.code = $('input#number').val();
    arrData.provider = $('input#idprovider').val();
	arrData.movement = $('select#movement').val();
	arrData.arrDataDetail = arrDataDetail;

	var DatosJson = JSON.stringify(arrData);
	//var inputId = 0;

	$.post(baseUrl+'input/save', 
		{ 
			arrData: DatosJson
		},
		function(data) { 
			var dato =$.parseJSON(data);

			$("#massage").html(dato.msg);
			var inputId = dato.inputId;
			if(inputId != "")
				window.location.href = baseUrl+'input';
		}
	);
    waitingDialog.hide();
	return false;
}