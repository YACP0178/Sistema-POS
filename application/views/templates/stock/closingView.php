    <h2 class="page-header"><i class="fa fa-cube fa-lg"></i> <b>Inventario</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="<?php echo base_url()?>stock/closingInsert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nueva Inventario</button>
        </a>  
    </p>

    <br/>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered tbexport filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($closing){
                    
                    foreach($closing as $closing){
                        echo '</td>';
                        echo '<td><a href="'.base_url().'stock/closingEdit/'.$closing->id.'"><button type="button" title="Ver Stock" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;</td>';
                        echo '<td>'.$closing->date.'</td>';
                        echo '<td>'.$closing->description.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=7><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div> 

