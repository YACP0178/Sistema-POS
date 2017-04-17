    <h2 class="page-header"><i class="fa fa-user fa-lg"></i> <b>Usuarios</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="user/insert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nuevo Usuario</button>
        </a>  
    </p>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($user){
                    foreach($user as $user){
                        $iduser = $user->id;
                        echo '<tr>';
                        echo '<td>';
                        echo '<a href="user/edit/'.$iduser.'"><button type="button" title="Editar Usuario" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;';
                        echo '<button type="button" dataname="'.$user->name.' '.$user->lastname.'" dataid="'.$iduser.'" title="Eliminar Usuario" class="btn btn-danger btn-xs deleteUser"><i class="fa fa-trash"></i></button>';
                        echo '</td>';
                        echo '<td>'.$user->name.'</td>';
                        echo '<td>'.$user->lastname.'</td>';
                        echo '<td>'.$user->username.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=5><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>ajax/user.js"></script> 

