<input type="hidden" value="<?php echo @$config[0]->id; ?>" id="id" name="id"> 
<?php
  $company      = array(
  'name'        => 'company',
  'id'          => 'company',
  'size'        => 50,
  'value'       => set_value('company ',@$config[0]->company),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $manager       = array(
  'name'        => 'manager',
  'id'          => 'manager',
  'size'        => 50,
  'value'       => set_value('manager',@$config[0]->manager),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $nit    = array(
  'name'        => 'nit',
  'id'          => 'nit',
  'size'        => 50,
  'value'       => set_value('nit',@$config[0]->nit),
  'type'        => 'number',
  'class'       => 'form-control'
  );


  $phone    = array(
  'name'        => 'phone',
  'id'          => 'phone',
  'size'        => 50,
  'value'       => set_value('phone',@$config[0]->phone),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $address    = array(
  'name'        => 'address',
  'id'          => 'address',
  'size'        => 50,
  'value'       => set_value('address',@$config[0]->address),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $mean    = array(
  'name'        => 'mean',
  'id'          => 'mean',
  'value'       => @$config[0]->mean,
  'checked'     => set_checkbox('mean',@$config[0]->mean, @$config[0]->mean == 1 ? true : false),
  'type'        => 'checkbox'

  ); 
?>

   
    <h2 class="page-header"><i class="fa fa-gear fa-lg"></i></span> <b>Configuración</b></h2>
    <br>
    <div id="massage"></div>
    <form class="form-horizontal" name="formulario" id="configform" role="form">
        <div class="form-group">
            <label for="company" class="col-lg-3 control-label">Empresa:</label>
            <div class="col-lg-3">
                <?php echo form_input($company); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="manager" class="col-lg-3 control-label">Representante:</label>
            <div class="col-lg-3">
                <?php echo form_input($manager); ?>
            </div>
        </div>
  

        <div class="form-group">
            <label for="nit" class="col-lg-3 control-label">Nit:</label>
            <div class="col-lg-3">
                <?php echo form_input($nit); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-lg-3 control-label">Telefono:</label>
            <div class="col-lg-3">
                <?php echo form_input($phone); ?>
            </div>
        </div>


        <div class="form-group">
            <label for="address" class="col-lg-3 control-label">Direccion:</label>
            <div class="col-lg-3">
                <?php echo form_input($address); ?>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="mean" class="col-lg-3 control-label">
                <?php echo form_checkbox($mean); ?> Promediar Precio
            </label>
        </div> 
        
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i> Guardar Configuración</button>
            </div>
        </div>
    <hr/>
    </form>	
    <script type="text/javascript" src="<?php echo base_url();?>ajax/config.js"></script>	

