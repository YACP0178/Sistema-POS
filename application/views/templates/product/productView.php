    <h2 class="page-header"><i class="fa fa-glass fa-lg"></i> <b>Productos</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="product/insert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nuevo Producto</button>
        </a>  
    </p>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Codigo</th>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Categoria</th>
                    <th>Impuesto</th>
                    <th>Costo</th>
                    <th>Valor</th>
                    <th>Ubicación</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($product){
                    foreach($product as $product){
                        $idproduct = $product->id;
                        $category = $product->namecategory == '0' ? '' : $product->namecategory;
                        echo '<tr>';
                        echo '<td>';
                        echo '<a href="product/edit/'.$idproduct.'"><button type="button" title="Editar Producto" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;';
                        echo '<button type="button" dataname="'.$product->description.'" dataid="'.$idproduct.'" title="Eliminar Producto" class="btn btn-danger btn-xs deleteProduct"><i class="fa fa-trash"></i></button>';
                        echo '</td>';
                        echo '<td>'.$product->code.'</td>';
                        echo '<td>'.$product->ref.'</td>';
                        echo '<td>'.$product->description.'</td>';
                        echo '<td>'.$category.'</td>';
                        echo '<td>'.$product->nametax.' '.$product->valuetax.'%</td>';
                        echo '<td>$ '.number_format($product->coste,0,'','.').'</td>';
                        echo '<td>$ '.number_format($product->price,0,'','.').'</td>';
                        echo '<td>'.$product->location.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=8><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>ajax/product.js"></script> 

