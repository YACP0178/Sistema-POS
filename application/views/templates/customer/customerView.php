    <h2 class="page-header"><i class="fa fa-users fa-lg"></i> <b>Clientes</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="customer/insert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nuevo Cliente</button>
        </a>  
    </p>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>CC</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>e-mail</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($customer){
                    foreach($customer as $customer){
                        $idcustomer = $customer->id;
                        echo '<tr>';
                        echo '<td>';
                        echo '<a href="customer/edit/'.$idcustomer.'"><button type="button" title="Editar Cliente" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;';
                        echo '<button type="button" dataname="'.$customer->name.' '.$customer->lastname.'" dataid="'.$idcustomer.'" title="Eliminar Cliente" class="btn btn-danger btn-xs deleteCustomer"><i class="fa fa-trash"></i></button>';
                        echo '</td>';
                        echo '<td>'.$customer->cc.'</td>';
                        echo '<td>'.$customer->name.'</td>';
                        echo '<td>'.$customer->lastname.'</td>';
                        echo '<td>'.$customer->email.'</td>';
                        echo '<td>'.$customer->phone.'</td>';
                        echo '<td>'.$customer->address.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=7><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>ajax/customer.js"></script> 

