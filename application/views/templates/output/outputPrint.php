<html>
<head>
    <title>Software sistema POS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="GENERATOR" content="Quanta Plus KDE"> 
</head>
<!--<body onload="print();">--> 
<body onload="print();">
    <!--<br>
    <center><h5><b>Tienda Prueba</b></h5></center>
    <center><h5>Direccion. B// villa ximena mz 5 casa #7</h5></center>-->

    <?php 
        if($config){
            echo "<h3><center><b>".@$config[0]->company."</b><center></h3>";
            echo "<h5><center>".@$config[0]->manager."<center></h5>";
            echo "<h6><center>".@$config[0]->nit."<center></h6>";
            echo "<h6><center>".@$config[0]->address."<center></h6>";
            echo "<h6><center>".@$config[0]->phone."<center></h6>";
        }

        if($output){
            echo "<br><center><h5><b>".@$output[0]->namemovement."</b></h5></center><br>";
            echo "<h6><b>Numero:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".@$output[0]->code."</h5>";
            echo "<h6><b>Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".@$output[0]->date."</h6>";
            echo "<h6><b>Cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".@$output[0]->nameCustomer."</h6>";
        }    
    ?>
    <br>
    <br>
    <table class="table">
        <thead>
            <th>Cant</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Total</th>
        </thead>
        <tbody>
            <?php  
                $subtotal = 0;
                $valueTotal = 0;
                $taxTotal = 0;
                $descTotal = 0;
                $tax = 0;
                $total = 0;
                $desc = 0;

                
                if($outputDt){
                    foreach($outputDt as $outputDt){
                       $total =  intval($outputDt->value) * intval($outputDt->cant);
                       $tax = $total/((intval($outputDt->tax)/100)+1);

                       //echo $taxtot;
                       //echo $tax;
                       echo "<tr>";
                       echo "<td style='padding:0%'>".$outputDt->cant." ".$outputDt->unit."</td>";
                       echo "<td style='padding:0%'>".$outputDt->ref." - ".$outputDt->description."</td>";
                       echo "<td style='padding:0%'>$".number_format($outputDt->value,0,'','.')."</td>";
                       echo "<td style='padding:0%'>$".number_format($total,0,'','.')."</td>";
                       echo "</tr>";


                       if($outputDt->discount != ''){
                            $desc = (intval($outputDt->value) * intval($outputDt->cant))*(floatval($outputDt->discount)/100);
                            $descTotal += $desc;
                            $total = $total - $desc; 
                            $tax = $total/((intval($outputDt->tax)/100)+1);
                        }

                        $subtotal += $tax;

                        if (intval($outputDt->tax) > 0)
                            $taxTotal += $total - $tax;
                    }

                    $valueTotal = $subtotal + $taxTotal;
                }
            ?>
        </tbody>
        <tfoot> 
              <tr>
                <td colspan=3 align="right" style='padding:0%'>Sub Total:</td>
                <td colspan=1 style='padding:0%'><label id="lblsubTotal" name="lblsubTotal"> $ <?php echo number_format($subtotal,0,'','.'); ?></label></td>
              </tr>
              <tr>
                <td colspan=3 align="right" style="border-top:none;padding:0%">Impuesto:</td>
                <td colspan=1 style='border-top:none;padding:0%'><label id="lbltax" name="lbltax"> $ <?php echo number_format($taxTotal,0,'','.'); ?></label></td>
              </tr>
              <tr>
                <td colspan=3 align="right" style="border-top:none;padding:0%">Total:</td>
                <td colspan=1 style='border-top:none;padding:0%'><label id="lbltotal" name="lbltotal"> $ <?php echo number_format($valueTotal,0,'','.'); ?></label></td>
              </tr>
        </tfoot>
    </table>
    <br>
    <h4><center><b>GRACIAS POR SU COMPRA</b></center></h4>
</body>
</html>


	
	
	
	
	