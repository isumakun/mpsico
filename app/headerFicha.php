<?php require './head.php';  ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header no-print">
            <!-- Logo -->
            <a href="" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>MPsicocupacional</b></span>
            </a>
            <nav class="navbar navbar-static-top">
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