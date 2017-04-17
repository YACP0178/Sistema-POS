    <h2 class="page-header"><i class="fa fa-cube fa-lg"></i> <b>Stock</b></h2>
    <div id="message"></div>

       <div class="btn-group" style="position: absolute;left: 3%;">
			<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Opciones</button>
			<ul class="dropdown-menu " role="menu">
			    <li><a href="<?php echo base_url()?>stock/closing"> <img src="<?php echo base_url()?>images/inventory.png" width="24px"> Realizar Inventario</a></li>
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

    <br/>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered tbexport filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Cant</th>
                    <th>U. Medida</th>
                    <th>Ref</th>
                    <th>Descripcion</th>
                    <th>Valor</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $totalStock = 0;
                if($stock){
                    
                    foreach($stock as $stock){
                        $totalStock += $stock->coste*$stock->cant;
                        echo '</td>';
                        echo '<td><a href="stock/inventory/'.$stock->id.'"><button type="button" title="Ver Stock" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;</td>';
                        echo '<td>'.$stock->cant.'</td>';
                        echo '<td>'.$stock->unit.'</td>';
                        echo '<td>'.$stock->ref.'</td>';
                        echo '<td>'.$stock->description.'</td>';
                        echo '<td>$'.number_format($stock->coste,0,'','.').'</td>';
                        echo '<td>$'.number_format($stock->coste*$stock->cant,0,'','.').'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=7><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan=6 align="right" style="border-top:none;"><b>Total:</b></td>
                <td colspan=1><label id="lbltotal" name="lbltotal">$<?php echo number_format($totalStock,0,'','.'); ?></label></td>
              </tr>
        </tfoot>
        </table>
    </div> 

