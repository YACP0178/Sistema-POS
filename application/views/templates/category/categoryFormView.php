<input type="hidden" value="<?php echo @$category[0]->id; ?>" id="id" name="id"> 
<?php

  $code       = array(
  'name'        => 'code',
  'id'          => 'code',
  'size'        => 50,
  'value'       => set_value('code',@$category[0]->code),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $name       = array(
  'name'        => 'name',
  'id'          => 'name',
  'size'        => 50,
  'value'       => set_value('name',@$category[0]->name),
  'type'        => 'text',
  'class'       => 'form-control'
  ); 
?>

   
    <h2 class="page-header"><i class="fa fa-list fa-lg"></i></span> <b><?php echo $title ?></b></h2>
    
    <div id="massage"></div>
    <form class="form-horizontal" name="formulario" id="categoryform" role="form">
        <div class="form-group">
            <label for="code" class="col-lg-3 control-label">Codigo:</label>
            <div class="col-lg-3">
                <?php echo form_input($code); ?>
            </div>
        </div>
  
        <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Nombre:</label>
            <div class="col-lg-3">
                <?php echo form_input($name); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i> Guardar Categoria</button>
            </div>
        </div>
    <hr/>
    </form>	
    <script type="text/javascript" src="<?php echo base_url();?>ajax/category.js"></script>	

