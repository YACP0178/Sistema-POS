$(document).ready(function(){
    $(".guardarClosing").click(saveClosing);
});

function saveClosing(){
    waitingDialog.show();
    var arrData  = new Object();
    
    arrData.id = $('input#inputid').val();
    arrData.date = $('input#inputDate').val();
    arrData.description = $('input#inputDes').val();
    
    var arrDataDetail = []
    
    $("#tableClosing tbody tr").each(function (index) 
    {
        var id, product, provider, cant, coste;
        $(this).children("td").each(function (index2) 
        {
            
            
            switch (index2) 
            {
                case 0: id = $(this).attr('path_data');
                        break;
                case 1: product = $(this).attr('path_data');
                        break;
                case 2: provider = $(this).attr('path_data');
                        break;
                case 3: cant = $(this).children("input").val();
                        break;
                case 4: coste = $(this).attr('path_data');
                        break;
            }
            
            

        });
        
        var data = {id:id, product:product, provider:provider, cant:cant, coste:coste};
        arrDataDetail.push(data);

    });
    
    arrData.arrDataDetail = arrDataDetail;
    
    var DatosJson = JSON.stringify(arrData);
    
    $.post(baseUrl+'stock/closingSave', 
        { 
            arrData: DatosJson
        },
        function(data) { 
            var dato =$.parseJSON(data);

            if(dato.status == 200)
                window.location.href = baseUrl+'stock/closingPrint/'+dato.idclosing;
        }
    );
    
    waitingDialog.hide();
    return false;
    

}