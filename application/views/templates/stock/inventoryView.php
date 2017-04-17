    <h2 class="page-header"><i class="fa fa-cube fa-lg"></i> <b>Movimientos</b></h2>
    <div id="message"></div>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered" id="tableUser">
            <thead>
                <tr>
                    <th colspan=2></th>
                    <th colspan=3><center>Entradas</center></th>
                    <th colspan=3><center>Salidas</center></th>
                    <th colspan=3><center>Costos</center></th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Movimiento</th>
                    <th>Cant</th>
                    <th>valor</th>
                    <th>Total</th>
                    <th>Cant</th>
                    <th>valor</th>
                    <th>Total</th>
                    <th>Cant</th>
                    <th>valor</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($inventory){
                    foreach($inventory as $inventory){
                        echo '</td>';
                        echo '<td>'.$inventory->date.'</td>';
                        echo '<td>'.$inventory->movementname.'</td>';
                        echo '<td>'.$inventory->ecant.'</td>';
                        echo '<td>'.number_format($inventory->evalue,0,'','.').'</td>';
                        echo '<td>'.number_format(intval($inventory->ecant) * intval($inventory->evalue),0,'','.').'</td>';
                        echo '<td>'.$inventory->scant.'</td>';
                        echo '<td>'.number_format($inventory->svalue,0,'','.').'</td>';
                        echo '<td>'.number_format(intval($inventory->scant) * intval($inventory->svalue),0,'','.').'</td>';
                        echo '<td>'.$inventory->pcant.'</td>';
                        echo '<td>'.number_format($inventory->pvalue,0,'','.').'</td>';
                        echo '<td>'.number_format(intval($inventory->pcant) * intval($inventory->pvalue),0,'','.').'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=7><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div> 

