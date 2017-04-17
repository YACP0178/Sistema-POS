    <h2 class="page-header"><i class="fa fa-truck fa-lg"></i> <b>Proveedores</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="provider/insert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nuevo Proveedor</button>
        </a>  
    </p>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>e-mail</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($provider){
                    foreach($provider as $provider){
                        $idprovider = $provider->id;
                        echo '<tr>';
                        echo '<td>';
                        echo '<a href="provider/edit/'.$idprovider.'"><button type="button" title="Editar Cliente" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;';
                        echo '<button type="button" dataname="'.$provider->name.' '.$provider->lastname.'" dataid="'.$idprovider.'" title="Eliminar Cliente" class="btn btn-danger btn-xs deleteProvider"><i class="fa fa-trash"></i></button>';
                        echo '</td>';
                        echo '<td>'.$provider->nit.'</td>';
                        echo '<td>'.$provider->name.'</td>';
                        echo '<td>'.$provider->lastname.'</td>';
                        echo '<td>'.$provider->email.'</td>';
                        echo '<td>'.$provider->phone.'</td>';
                        echo '<td>'.$provider->address.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=7><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>ajax/provider.js"></script> 

