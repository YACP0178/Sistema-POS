<!DOCTYPE html>
<html>
<head>
	<title>.:.PPOS.:.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/login.css">

</head>
<body>
	<div class="wrapper">
		<form class="form-signin" id="loginform">       
			<h2 class="form-signin-heading">Admin PPOS</h2>
			<input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required="" autofocus="" /><br>
			<input type="password" class="form-control" id="password" name="password" placeholder="Clave" required=""/><br>     
			<button type="submit" class="btn btn-primary login">Iniciar Sesion</button>
		</form>
	</div>
	
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>ajax/auth.js"></script>	
</body>
</html>