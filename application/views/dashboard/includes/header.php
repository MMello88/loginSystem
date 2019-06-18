<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Focus Admin: Admin UI</title>

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

        <!-- Styles -->
        <link href="<?= base_url() ?>assets/template/assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/template/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/template/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/template/assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/template/assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/template/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/template/assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <?php 
        if (isset($css)){
            foreach ($css as $arq) {
                echo "<link href='$arq' rel='stylesheet'>";
            } 
        }?>
        <link href="<?= base_url() ?>assets/template/assets/css/lib/helper.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/template/assets/css/style.css" rel="stylesheet">
    </head>

    <body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <div class="logo"><a href="index.html"><!-- <img src="<?= base_url() ?>assets/template/assets/images/logo.png" alt="" /> --><span>Re-Sossegue</span></a></div>
                <ul>
                    <?php foreach ($main_menu as $titulo) {
                        echo "<li class='label'>$titulo->titulo</li>";
                        foreach ($titulo->menus as $key => $menu) {
                            if(!empty($menu->submenus)){
                                echo "<li><a class='sidebar-sub-toggle'><i class='{$menu->icone}'></i> {$menu->menu} <span class='sidebar-collapse-icon ti-angle-down'></span></a>";
                                echo "<ul>";
                                foreach ($menu->submenus as $submenu)
                                    echo "<li><a href=".base_url($submenu->url).">{$submenu->submenu}</a></li>";
                                echo "</ul>";
                            } else {
                                echo "<li><a href='".base_url($menu->url)."'><i class='{$menu->icone}'></i> {$menu->menu} </a></li>";
                            }
                        } 
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->


    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <ul>

                            <li class="header-icon dib"><i class="ti-bell"></i>
                                <div class="drop-down">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Recent Notifications</span>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="<?= base_url() ?>assets/template/assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34 PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="header-icon dib"><i class="ti-email"></i>
                                <div class="drop-down">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">1 New Messages</span>
                                        <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="<?= base_url() ?>assets/template/assets/images/avatar/2.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34 PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="<?= base_url() ?>assets/template/assets/images/avatar/2.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34 PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="header-icon dib"><span class="user-avatar"><?= $account->nome ?> <i class="ti-angle-down f-s-10"></i></span>
                                <div class="drop-down dropdown-profile">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>
                                            <li><a href="#"><i class="ti-email"></i> <span>Inbox</span></a></li>
                                            <li><a href="#"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                            <li><a href="#"><i class="ti-lock"></i> <span>Lock Screen</span></a></li>
                                            <li><a href="#"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome to Sossegue</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>