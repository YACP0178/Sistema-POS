 var arrDataDetail = []

 $(function() {
    $("#customer").autocomplete({
            source: baseUrl + "customer/searchCustomer",
             select: function(event, ui) {  
				$('#idcustomer').val(ui.item.id);
           }  
    });

    $("#product").autocomplete({
            source: baseUrl + "product/searchProduct",
            select: function(event, ui) {  
            	$('#hidproduct').val(ui.item.id);
                $('#href').val(ui.item.ref);
            	$('#hdescription').val(ui.item.description);
            	$('#hcoste').val(ui.item.coste);
                $('#hprice').val(ui.item.price);
                $('#htax').val(ui.item.tax);
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
    var price = $('#hprice').val();
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
                        '<td><input type="hidden"  class="form-control" id="idproduct'+id+'" value="'+id+'"><input type="hidden"  class="form-control" id="tax'+id+'" value="'+tax+'"><input type="hidden"  class="form-control" id="coste'+id+'" value="'+coste+'">'+description+'</td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="price'+id+'" value="'+price+'" size="5"></td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="cant'+id+'" value="1" size="5"></td>'+
                        '<td><input type="number"  class="form-control" onkeypress="if(event.keyCode==13){focusProduct(this.value);return false;}" onchange="changeValue('+id+');" id="desc'+id+'" value="" size="5"></td>'+
                        '<td id="total">'+formatNumber.new(price,"$")+'</td>'+
                        '<td><button type="button" id="btn'+id+'" dataname="'+description+'" onclick="deleteItem('+id+');" title="Eliminar Producto" class="btn btn-danger btn-xs deleteItem"><i class="fa fa-trash"></i></button></td>'+
                      '</tr>';  

        $(htmlProduct).prependTo("#carrito tbody");
        
        var desc = $('#desc'+id).val();
        data = {idproduct:id, productname:description ,price:parseInt($('#price'+id).val()), coste:parseInt($('#coste'+id).val()), cant:parseInt($('#cant'+id).val()), desc:(desc == ''  ? 0 : parseInt(desc)), tax:parseInt(tax)};

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
    $('#hprice').val('');
    $('#hcoste').val('');
    $('#href').val('');
    $('#htax').val('');
}

function changeValue(id){
    var coste = $('#coste'+id).val();
    var price = $('#price'+id).val();
    var cant = $('#cant'+id).val();
    var desc = $('#desc'+id).val();
    var tax = parseInt($('#tax'+id).val());
    var value = 0;
    var valtax = 0;
    

    if(cant == ''){
        alert('El valor de la cantidad es incorrecto');
        $('#cant'+id).val('1');
    }else if(parseInt(cant) < 1){
        alert('El valor de la cantidad es incorrecto');
        $('#cant'+id).val('1');
    }else if(parseInt(price) < 1){
        alert('El valor del Precio es incorrecto');
        $('#price'+id).val('1');
    }else if(parseInt(price) < 0){
        alert('El valor del descuento es incorrecto');
    }else{

        value = parseInt(price)*parseInt(cant);
        valsub = Math.round(value/((parseInt(tax)/100)+1));
        
        if(desc != ''){
            value = value-(value*(parseFloat(desc)/100));
            valsub = Math.round(value/((parseInt(tax)/100)+1));
            $("#subtotal").html(formatNumber.new((valsub),"$"));
            $("#total").html(formatNumber.new(value,"$"));
        }else{
            $("#subtotal").html(formatNumber.new((valsub),"$"));
            $("#total").html(formatNumber.new(value,"$"));
        }

        for(key in arrDataDetail){
            if(arrDataDetail[key].idproduct == id){
                arrDataDetail[key].idproduct = id;
                arrDataDetail[key].price = parseInt(price);
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
    var taxTotal = 0;
    var tax = 0;
    var desc = 0;
    var total = 0;

    for(key in arrDataDetail){

        total = (arrDataDetail[key].price * arrDataDetail[key].cant);
        tax = total/((arrDataDetail[key].tax/100)+1);

        if(arrDataDetail[key].desc > 0){
            desc = (arrDataDetail[key].price * arrDataDetail[key].cant)*(parseFloat(arrDataDetail[key].desc)/100);
            descTotal += desc;
            total = total - desc; 
            tax = total/((arrDataDetail[key].tax/100)+1);
        }

        subTotal += tax;

        if (arrDataDetail[key].tax > 0)
            taxTotal += total - tax;

    }

    valueTotal = subTotal + taxTotal;

    $('#lblsubTotal').html(formatNumber.new(Math.round(subTotal),"$"));
    //$('#lbldesc').html(formatNumber.new(Math.round(descTotal), "$"));
    $('#lbltax').html(formatNumber.new(Math.round(taxTotal), "$"));
    $('#lbltotal').html(formatNumber.new(Math.round(valueTotal), "$"));
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

    console.log(arrDataDetail);
}

function saveOutput(){
    waitingDialog.show();
    var arrData  = new Object();

    arrData.code = $('input#number').val();
    arrData.customer = $('input#idcustomer').val();
    arrData.movement = $('select#movement').val();
    arrData.arrDataDetail = arrDataDetail;

    var DatosJson = JSON.stringify(arrData);
    //var inputId = 0;

    $.post(baseUrl+'output/save', 
        { 
            arrData: DatosJson
        },
        function(data) { 
            var dato =$.parseJSON(data);

            $("#massage").html(dato.msg);
            var outputId = dato.outputId;
            if(outputId != "")
                window.location.href = baseUrl+'output/outputPrint/'+outputId;
        }
    );
    waitingDialog.hide();
    return false;
}