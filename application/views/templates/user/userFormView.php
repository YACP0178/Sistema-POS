<input type="hidden" value="<?php echo @$user[0]->id; ?>" id="id" name="id"> 
<?php
  $name       = array(
  'name'        => 'name',
  'id'          => 'name',
  'size'        => 50,
  'value'       => set_value('name',@$user[0]->name),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $lastname    = array(
  'name'        => 'lastname',
  'id'          => 'lastname',
  'size'        => 50,
  'value'       => set_value('lastname',@$user[0]->lastname),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $username    = array(
  'name'        => 'username',
  'id'          => 'username',
  'size'        => 50,
  'value'       => set_value('username',@$user[0]->username),
  'type'        => 'text',
  'class'       => 'form-control'
  );

  $password    = array(
  'name'        => 'password',
  'id'          => 'password',
  'size'        => 50,
  'value'       => set_value('password',@$user[0]->password),
  'type'        => 'password',
  'class'       => 'form-control'
  );

  $password2    = array(
  'name'        => 'password2',
  'id'          => 'password2',
  'size'        => 50,
  'value'       => set_value('password2',@$user[0]->password),
  'type'        => 'password',
  'class'       => 'form-control'
  );
 
?>

   
    <h2 class="page-header"><i class="fa fa-user fa-lg"></i></span> <b><?php echo $title ?></b></h2>
    
    <div id="massage"></div>
    <form class="form-horizontal" name="formulario" id="userform" role="form">
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
            <label for="username" class="col-lg-3 control-label">Usuario:</label>
            <div class="col-lg-3">
                <?php echo form_input($username); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-lg-3 control-label">Clave:</label>
            <div class="col-lg-3">
                <?php echo form_input($password); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password2" class="col-lg-3 control-label">Confirmar Clave:</label>
            <div class="col-lg-3">
                <?php echo form_input($password2); ?>
            </div>
        </div>
 
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i> Guardar Usuario</button>
            </div>
        </div>
    <hr/>
    </form>	
    <script type="text/javascript" src="<?php echo base_url();?>ajax/user.js"></script>	

