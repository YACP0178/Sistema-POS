<html>
<head>
    <title>Software sistema POS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="GENERATOR" content="Quanta Plus KDE"> 
</head>
<!--<body onload="print();">--> 
<body>  
        <br>
        <!--<p align="right">

        <button type="button" class="btn btn-primary guardarClosing"><i class="fa fa-plus fa-fw"></i> Guardar</button>

        </p>-->
        
        <div class="btn-group" style="position: absolute;left: 3%;">
			<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Opciones</button>
			<ul class="dropdown-menu " role="menu">
			    <li><a class="guardarClosing" href="#"> <img src="<?php echo base_url()?>images/inventory.png" width="24px"> Guardar Inventario</a></li>
			    <li class="divider">Exportar</li>	
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'json',escape:'false'});"> <img src="<?php echo base_url()?>images/json.png" width="24px"> JSON</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"> <img src="<?php echo base_url()?>images/json.png" width="24px"> JSON (ignoreColumn)</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'json',escape:'true'});"> <img src="<?php echo base_url()?>images/json.png" width="24px"> JSON (with Escape)</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'xml',escape:'false'});"> <img src="<?php echo base_url()?>images/xml.png" width="24px"> XML</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'sql'});"> <img src="<?php echo base_url()?>images/sql.png" width="24px"> SQL</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'csv',escape:'false'});"> <img src="<?php echo base_url()?>images/csv.png" width="24px"> CSV</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'txt',escape:'false'});"> <img src="<?php echo base_url()?>images/txt.png" width="24px"> TXT</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'excel',escape:'false'});"> <img src="<?php echo base_url()?>images/xls.png" width="24px"> XLS</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'doc',escape:'false'});"> <img src="<?php echo base_url()?>images/word.png" width="24px"> Word</a></li>
				<li><a href="#" onclick="$('.tbexport').tableExport({type:'powerpoint',escape:'false'});"> <img src="<?php echo base_url()?>images/ppt.png" width="24px"> PowerPoint</a></li>
				
			</ul>
		</div>
          
        <h3><center><b>Reporte de Inventario</b></center></h3>
        <br>
        <br>
        <?php date_default_timezone_set('America/Bogota'); ?>
        <?php if(isset($closing)){ ?>
            <input id="inputid" type='hidden' value='<?php echo $closing[0]->id ?>'>
            <h4><b>Fecha: </b><input id="inputDate" type='hidden' value='<?php echo $closing[0]->date ?>'> <?php echo $closing[0]->date ?></h4>
            <h4><b>Descripción: </b><input id="inputDes" style="width: 100%;" type='text' value='<?php echo $closing[0]->description ?>'></h4>
        <?php }else{ ?>
            <input id="inputid" type='hidden' value=''>
            <h4><b>Fecha: </b><input id="inputDate" type='hidden' value='<?php echo date('Y-m-j H:i:s'); ?>'> <?php echo date('Y-m-j H:i:s'); ?></h4>
            <h4><b>Descripción: </b><input id="inputDes" style="width: 100%;" type='text' value=''></h4>
        <?php } ?>
        <br>
        

        <table class="table tbexport" id="tableClosing">
            <thead>
                <th>ref</th>
                <th>Descripción</th>
                <th>Proveedor</th>
                <th>cant</th>
                <th>Costo</th>
                <th>Total</th>
            </thead>
            <tbody>
                <?php  
                    $total = 0;
                    if($closingDt){
                        foreach($closingDt as $closingDt){
                           $total += intval($closingDt->cant) * intval($closingDt->coste);
                           echo "<tr>";
                           echo "<td style='padding:0%' path_data='".$closingDt->id."'>".$closingDt->ref."</td>";
                           echo "<td style='padding:0%' path_data='".$closingDt->product."'>".$closingDt->description."</td>";
                           echo "<td style='padding:0%' path_data='".$closingDt->provider."'>".$closingDt->nameprovider."</td>";
                           echo "<td style='padding:0%;width: 12%;'><input type='number' style='height: 23px; width: 100px;' value='".$closingDt->cant."' size='5'></td>";
                           echo "<td style='padding:0%' path_data='".$closingDt->coste."'>$".number_format($closingDt->coste,0,'','.')."</td>";
                           echo "<td style='padding:0%'>$".number_format(intval($closingDt->cant) * intval($closingDt->coste),0,'','.')."</td>";
                           echo "</tr>";
                         
                        }
    
                    }
                    
                ?>
            </tbody>
            <tfoot> 
                <tr>
                <td colspan=5 align="right">Total:</td>
                <td colspan=2><label id="lbltotal" name="lbltotal">$ <?php echo number_format($total,0,'','.')  ?></label></td>
                </tr>
            </tfoot> 
        </table> 
        
        <script type="text/javascript" src="<?php echo base_url();?>ajax/stock.js"></script> 
        
</body>
</html>


	
	
	
	
	