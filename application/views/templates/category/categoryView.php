    <h2 class="page-header"><i class="fa fa-list fa-lg"></i> <b>Categoria</b></h2>
    <div id="message"></div>
    <p align="right">
        <a href="category/insert">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Nueva Categoria</button>
        </a>  
    </p>
    <br/>
    <div class="panel-body">
        <table class="table table-bordered filter" id="tableUser">
            <thead>
                <tr>
                    <th style="width: 9%;"></th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($category){
                    foreach($category as $category){
                        $idCategory = $category->id;
                        echo '<tr>';
                        echo '<td>';
                        echo '<a href="category/edit/'.$idCategory.'"><button type="button" title="Editar Categoria" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></button></a> &nbsp;';
                        echo '<button type="button" dataname="'.$category->name.'" dataid="'.$idCategory.'" title="Eliminar Categoria" class="btn btn-danger btn-xs deleteCategory"><i class="fa fa-trash"></i></button>';
                        echo '</td>';
                        echo '<td>'.$category->code.'</td>';
                        echo '<td>'.$category->name.'</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan=5><center>No Existe Informacion</center></td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>ajax/category.js"></script> 

