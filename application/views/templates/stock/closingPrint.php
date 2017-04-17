<html>
<head>
    <title>Software sistema POS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="GENERATOR" content="Quanta Plus KDE"> 
</head>
<!--<body onload="print();">--> 
<body onload="print();">  
        
        <h3><center><b>Reporte de Inventario</b></center></h3>
        <br>
        <br>
        <?php date_default_timezone_set('America/Bogota'); ?>
        <?php if(isset($closing)){ ?>
            <input id="inputid" type='hidden' value='<?php echo $closing[0]->id ?>'>
            <h4><b>Fecha: </b><input id="inputDate" type='hidden' value='<?php echo $closing[0]->date ?>'> <?php echo $closing[0]->date ?></h4>
        <?php }else{ ?>
            <input id="inputid" type='hidden' value=''>
            <h4><b>Fecha: </b><input id="inputDate" type='hidden' value='<?php echo date('Y-m-j H:i:s'); ?>'> <?php echo date('Y-m-j H:i:s'); ?></h4>
        <?php } ?>
        <h4><b>Descripción: </b><?php echo $closing[0]->description ?></h4>
        <br>
        

        <table class="table" id="tableClosing">
            <thead>
                <th>ref</th>
                <th>Descripción</th>
                <th>Proveedor</th>
                <th>cant</th>
            </thead>
            <tbody>
                <?php  
    
                    if($closingDt){
                        foreach($closingDt as $closingDt){
                           echo "<tr>";
                           echo "<td style='padding:0%' path_data='".$closingDt->id."'>".$closingDt->ref."</td>";
                           echo "<td style='padding:0%' path_data='".$closingDt->product."'>".$closingDt->description."</td>";
                           echo "<td style='padding:0%' path_data='".$closingDt->provider."'>".$closingDt->nameprovider."</td>";
                           echo "<td style='padding:0%;width: 12%;'><input type='text' style='height: 23px; width: 100px;' value='".$closingDt->cant."' size='5'></td>";
                           //echo "<td style='padding:0%' path_data='".$closingDt->coste."'>$".number_format($closingDt->coste,0,'','.')."</td>";
                           echo "</tr>";
                         
                        }
    
                    }
                    
                ?>
            </tbody>
        </table> 
        
        <script type="text/javascript" src="<?php echo base_url();?>ajax/stock.js"></script> 
        
</body>
</html>


	
	
	
	
	