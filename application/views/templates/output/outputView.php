<h2 class="page-header"><i class="fa fa-money fa-lg"></i> <b>Ventas</b></h2>
<div id="massage"></div>
<br>
<input type="hidden"  class="form-control" id="idcustomer">
<table>
  <tr> 
    <td><b>Numero:</b>&nbsp;&nbsp;</td>
    <td><input type="text" class="form-control" id="number" placeholder="Numero"></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Cliente:</b>&nbsp;&nbsp;</td>
    <td><input type="text"  class="form-control autocomplete" id="customer" placeholder="Cliente" autocomplete="on" size="30"></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Movimiento:</b>&nbsp;&nbsp;</td>
    <td>
      <select name="movement" id="movement" class="form-control">
          <?php 
              if($movement){
                  foreach($movement as $movement){                      
                    echo '<option value="'.$movement->id.'">'.$movement->name.'</option>';                      
                  }
              }
          ?>
      </select>
    </td>
  </tr>
</table>

<br><hr><br>

<div   name="formulario" id="formulario" role="form">
  <table>
    <tr> 
      <td><input type="text" class="form-control autocomplete" id="product" autocomplete="on" placeholder="Buscar Producto" size="40"></td>
      <td><button type="reset" class="btn btn-success" id="addProduct"><i class="fa fa-plus"></i> Agregar Producto</button></td>
    </tr>
  </table><br>

  <input type="hidden"  class="form-control" id="hidproduct">
  <input type="hidden"  class="form-control" id="htax">
  <input type="hidden"  class="form-control" id="href">
  <input type="hidden"  class="form-control" id="hdescription">
  <input type="hidden"  class="form-control" id="hcoste">
  <input type="hidden"  class="form-control" id="hprice">
  
  <table class="table table-bordered table-striped"    id="carrito">
    <thead>
      <th>Ref</th> 
      <th>Producto</th>
      <th>Valor</th>
      <th>Cantidad</th>
      <th>Descuento</th>
      <th>Total</th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td id="trdelete" colspan=7><center>No Hay Productos Agregados</center></td>
      </tr>
    </tbody>
    <tfoot> 

      <tr>
        <td colspan=5 align="right">Sub Total:</td>
        <td colspan=2><label id="lblsubTotal" name="lblsubTotal">$ 0</label></td>
      </tr>
      <tr>
        <td colspan=5 align="right">Impuesto:</td>
        <td colspan=2><label id="lbltax" name="lbltax">$ 0</label></td>
      </tr>
      <tr>
        <td colspan=5 align="right">Total:</td>
        <td colspan=2><label id="lbltotal" name="lbltotal">$ 0</label></td>
      </tr>
    </tfoot> 
  </table>
     <center>
  <button type="submit" id="SaveOrder" onclick="saveOutput();" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Crear Venta</button></center>
 </div>		
 <script type="text/javascript" src="<?php echo base_url();?>ajax/output.js"></script>