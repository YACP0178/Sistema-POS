<input type="hidden" value="<?php echo @$provider[0]->id; ?>" id="id" name="id"> 
<?php
  $nit       = array(
  'name'        => 'nit',
  'id'          => 'nit',
  'size'        => 50,
  'value'       => set_value('nit',@$provider[0]->nit),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $name       = array(
  'name'        => 'name',
  'id'          => 'name',
  'size'        => 50,
  'value'       => set_value('name',@$provider[0]->name),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $lastname    = array(
  'name'        => 'lastname',
  'id'          => 'lastname',
  'size'        => 50,
  'value'       => set_value('lastname',@$provider[0]->lastname),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $email    = array(
  'name'        => 'email',
  'id'          => 'email',
  'size'        => 50,
  'value'       => set_value('email',@$provider[0]->email),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $phone    = array(
  'name'        => 'phone',
  'id'          => 'phone',
  'size'        => 50,
  'value'       => set_value('phone',@$provider[0]->phone),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $address    = array(
  'name'        => 'address',
  'id'          => 'address',
  'size'        => 50,
  'value'       => set_value('address',@$provider[0]->address),
  'type'        => 'text',
  'class'       => 'form-control'
  );
 
?>

   
    <h2 class="page-header"><i class="fa fa-truck fa-lg"></i></span> <b><?php echo $title ?></b></h2>
    
    <div id="massage"></div>
    <form class="form-horizontal" name="formulario" id="providerform" role="form">
        <div class="form-group">
            <label for="nit" class="col-lg-3 control-label">Nit:</label>
            <div class="col-lg-3">
                <?php echo form_input($nit); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Nombre:</label>
            <div class="col-lg-3">
                <?php echo form_input($name); ?>
            </div>
        </div>
  

        <div class="form-group">
            <label for="lastname" class="col-lg-3 control-label">Apellidos:</label>
            <div class="col-lg-3">
                <?php echo form_input($lastname); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-lg-3 control-label">e-mail:</label>
            <div class="col-lg-3">
                <?php echo form_input($email); ?>
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
 
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i> Guardar Proveedor</button>
            </div>
        </div>
    <hr/>
    </form>	
    <script type="text/javascript" src="<?php echo base_url();?>ajax/provider.js"></script>	

