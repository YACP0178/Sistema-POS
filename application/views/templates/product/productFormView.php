<input type="hidden" value="<?php echo @$product[0]->id; ?>" id="id" name="id"> 
<?php
  $code       = array(
  'name'        => 'code',
  'id'          => 'code',
  'size'        => 50,
  'value'       => set_value('code',@$product[0]->code),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $ref    = array(
  'name'        => 'ref',
  'id'          => 'ref',
  'size'        => 50,
  'value'       => set_value('ref',@$product[0]->ref),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $description    = array(
  'name'        => 'description',
  'id'          => 'description',
  'size'        => 50,
  'value'       => set_value('description',@$product[0]->description),
  'type'        => 'text',
  'class'       => 'form-control'
  );
  
  $size   = array(
  'name'        => 'size',
  'id'          => 'size',
  'size'        => 50,
  'value'       => set_value('size',@$product[0]->size),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $coste    = array(
  'name'        => 'coste',
  'id'          => 'coste',
  'size'        => 50,
  'value'       => set_value('coste',@$product[0]->coste),
  'type'        => 'number',
  'class'       => 'form-control'
  );

  $price    = array(
  'name'        => 'price',
  'id'          => 'price',
  'size'        => 50,
  'value'       => set_value('price',@$product[0]->price),
  'type'        => 'number',
  'class'       => 'form-control'
  );

  $stockmin    = array(
  'name'        => 'stockmin',
  'id'          => 'stockmin',
  'size'        => 50,
  'value'       => set_value('stockmin',@$product[0]->stockmin),
  'type'        => 'number',
  'class'       => 'form-control'
  );

  $location    = array(
  'name'        => 'location',
  'id'          => 'location',
  'size'        => 255,
  'value'       => set_value('location',@$product[0]->location),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $unit    = array(
  'name'        => 'unit',
  'id'          => 'unit',
  'size'        => 255,
  'value'       => set_value('location',@$product[0]->unit),
  'type'        => 'text',
  'class'       => 'form-control'
  );
 
?>
    
   
    <h2 class="page-header"><i class="fa fa-glass fa-lg"></i></span> <b><?php echo $title ?></b></h2>
    
    <div id="massage"></div>
    <form class="form-horizontal" name="formulario" id="productform" role="form">
        <div class="form-group">
            <label for="code" class="col-lg-3 control-label">Codigo:</label>
            <div class="col-lg-3">
                <?php echo form_input($code); ?>
            </div>
        </div>
  

        <div class="form-group">
            <label for="ref" class="col-lg-3 control-label">Referencia:</label>
            <div class="col-lg-3">
                <?php echo form_input($ref); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-lg-3 control-label">Descripción:</label>
            <div class="col-lg-3">
                <?php echo form_input($description); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="description" class="col-lg-3 control-label">Talla:</label>
            <div class="col-lg-3">
                <?php echo form_input($size); ?>
            </div>
        </div>

        

        <div class="form-group">
            <label for="category" class="col-lg-3 control-label">Categoria:</label>
            <div class="col-lg-3">
                <select name="category" id="category" class="form-control">
                    <?php 
                        echo '<option value="1" >--Seleccionar Categoria--</option>';
                        if($category){
                            foreach($category as $category){
                                if(@$product[0]->category == $category->id){
                                    echo '<option value="'.$category->id.'" selected>'.$category->name.'</option>';
                                }else{
                                    echo '<option value="'.$category->id.'">'.$category->name.'</option>';
                                }
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tax" class="col-lg-3 control-label">Impuesto:</label>
            <div class="col-lg-3">
                <select name="tax" id="tax" class="form-control">
                    <?php 
                        echo '<option value="1" >--Seleccionar Impuesto--</option>';
                        if($tax){
                            foreach($tax as $tax){
                                if(@$product[0]->tax == $tax->id){
                                    echo '<option value="'.$tax->id.'" selected>'.$tax->name.' '.$tax->value.'%</option>';
                                }else{
                                    echo '<option value="'.$tax->id.'">'.$tax->name.' '.$tax->value.'%</option>';
                                }
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="coste" class="col-lg-3 control-label">Costo:</label>
            <div class="col-lg-3">
                <?php echo form_input($coste); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="price" class="col-lg-3 control-label">Precio:</label>
            <div class="col-lg-3">
                <?php echo form_input($price); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="stockmin" class="col-lg-3 control-label">Cantidad Minima:</label>
            <div class="col-lg-3">
                <?php echo form_input($stockmin); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="location" class="col-lg-3 control-label">Unidad de Medida:</label>
            <div class="col-lg-3">
                <?php echo form_input($unit); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="location" class="col-lg-3 control-label">Ubicación:</label>
            <div class="col-lg-3">
                <?php echo form_input($location); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i> Guardar Producto</button>
            </div>
        </div>
    <hr/>
    </form>	
    <script type="text/javascript" src="<?php echo base_url();?>ajax/product.js"></script>	

