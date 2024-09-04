<?php require './head.php';  ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header no-print">
            <!-- Logo -->
            <a href="" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>MP</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>MPsicocupacional</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li>
                            <a class="drop-option" href="login.php?estado=logout">
                                <i class="fa fa-power-off" style="margin-right: 5px"></i>
                                Cerrar Sesión
                            </a>
                        </li>
                    </nav>
                </header>
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar no-print">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">
                        <!-- Sidebar user panel -->
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="images/avatar.png" class="img-circle" alt="User Image">
                            </div>
                            <div class="pull-left info">
                                <p id="user"><?=$_SESSION['usuario']?></p>
                                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                            </div>
                        </div>
                        <!-- sidebar menu: : style can be found in sidebar.less -->
                        <?php require_once 'menu_admin.php';?>
                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->

                    <!-- Main content -->
                    <section class="content">
                        <section class="content-header">
                            <h1 class="no-print">
                                <?php if ($title!='') {
                                   echo $title;
                               }else{
                                echo "";
                            } ?>
                        </h1>
                    </section>
                    <section class="content">