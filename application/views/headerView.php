<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>.:.PPOS.:.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/datatable.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/sb-admin-2.css">
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/tableExport.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.base64.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script>
</head>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sistema POS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Usuarios</a>
                        </li>
                        <li><a href="<?php echo base_url()?>config"><i class="fa fa-gear fa-fw"></i> Configuraciones</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url()?>auth/logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                   
                        <li><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard fa-fw"></i> Inicio</a></li>
                        <li><a href="<?php echo base_url()?>output"><i class="fa fa-money fa-fw"></i> Ventas</a></li>
                        <li><a href="<?php echo base_url()?>input"><i class="fa fa-cart-plus fa-fw"></i> Compras</a></li>
                        <li><a href="<?php echo base_url()?>stock"><i class="fa fa-cube fa-fw"></i> Stock</a></li>
                        <li><a href="<?php echo base_url()?>category"><i class="fa fa-list fa-fw"></i> Categoria</a></li>
                        <li><a href="<?php echo base_url()?>product"><i class="fa fa-glass fa-fw"></i> Productos</a></li>
                        <li><a href="<?php echo base_url()?>provider"><i class="fa fa-truck fa-fw"></i> Proveedores</a></li>
                        <li><a href="<?php echo base_url()?>customer"><i class="fa fa-users fa-fw"></i> Clientes</a></li>
                        <li><a href="<?php echo base_url()?>user" id="usuario"><i class="fa fa-user fa-fw"></i> Usuarios</a></li>
                        <!--<li><a href="<?php echo base_url()?>report"><i class="fa fa-bar-chart fa-fw"></i> Reportes</a></li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
            <div class="row">
                <div class="col-lg-12">
                    
                    
                