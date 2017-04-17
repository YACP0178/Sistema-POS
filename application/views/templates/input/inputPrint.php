<html>
<head>
    <title>Software sistema POS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="GENERATOR" content="Quanta Plus KDE"> 
</head>
<!--<body onload="print();">--> 
<body onload="print()">
    <!--<br>
    <center><h5><b>Tienda Prueba</b></h5></center>
    <center><h5>Direccion. B// villa ximena mz 5 casa #7</h5></center>-->

    <?php 
        if($input){
            echo "<br><center><h3><b>Factura ".@$input[0]->namemovement."</b></h3></center><br>";
            echo "<h4><b>Numero:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".@$input[0]->code."</h4>";
            echo "<h4><b>Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".@$input[0]->date."</h4>";
            echo "<h4><b>Proveedor:&nbsp;&nbsp;&nbsp;</b>".@$input[0]->nameProvider."</h4>";
        }    
    ?>
    <br>
    <br>
    <table class="table">
        <thead>
            <th>Producto</th>
            <th>Cant</th>
            <th>Precio</th>
            <th>Desc</th>
            <th>Sub Total</th> 
            <th>Total</th>
        </thead>
        <tbody>
            <?php  
                $subtotal = 0;
                $total = 0;
                $descuento = 0;
                
                if($inputDt){
                    foreach($inputDt as $inputDt){
                       $subtotal += $inputDt->cant * $inputDt->value;
                       
                       if($inputDt->discount > 0)
                            $descuento += ($inputDt->value * $inputDt->cant)*($inputDt->discount/100);
                       
                       $sub = $inputDt->cant * $inputDt->value;
                       $tot = $sub - ($sub * ($inputDt->discount/100));
                       echo "<tr>";
                       echo "<td>".$inputDt->description."</td>";
                       echo "<td>".$inputDt->cant."</td>";
                       echo "<td>$".number_format($inputDt->value,0,'','.')."</td>";
                       echo "<td>".$inputDt->discount."%</td>";
                       echo "<td>$".number_format($sub,0,'','.')."</td>";
                       echo "<td>$".number_format($tot,0,'','.')."</td>";
                       echo "</tr>";
                    }

                    $total = $subtotal - $descuento;
                }
            ?>
        </tbody>
        <tfoot> 
              <tr>
                <td colspan=5 align="right">Sub Total:</td>
                <td colspan=2><label id="lblsubTotal" name="lblsubTotal">$<?php echo number_format($subtotal,0,'','.'); ?></label></td>
              </tr>
              <tr>
                <td colspan=5 align="right" style="border-top:none;">Descuento:</td>
                <td colspan=2><label id="lbldesc" name="lbldesc">$<?php echo number_format($descuento,0,'','.'); ?></label></td>
              </tr>
              <tr>
                <td colspan=5 align="right" style="border-top:none;">Total:</td>
                <td colspan=2><label id="lbltotal" name="lbltotal">$<?php echo number_format($total,0,'','.'); ?></label></td>
              </tr>
        </tfoot>
    </table>
</body>
</html>


	
	
	
	
	