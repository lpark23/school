<!DOCTYPE html >
<html >

<head>

    <meta http-equiv=”content-type” content=”text/html; charset=windows-1251″ />
    <title><?php if (isset($this->title)) echo htmlspecialchars($this->title) ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=APP_ROOT?>/content/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=APP_ROOT?>/content/css/datepicker.css" rel="stylesheet">
    <script src="<?=APP_ROOT?>/content/js/jquery.js"></script>
    <script src="<?=APP_ROOT?>/content/js/bootstrap-datepicker.js"></script>
    <script>
        $(function(){
            $('.datepicker').datepicker();
        });
    </script>
    <!-- Custom CSS -->
    <link href="<?=APP_ROOT?>/content/css/school-admin.css" rel="stylesheet">
    <link href="<?=APP_ROOT?>/content/css/styles.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=APP_ROOT?>/content/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=APP_ROOT?>/content/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=APP_ROOT?>/">Начало</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"></а>
                    <?php if(!$this->isLoggedIn) : ?>
                    <i class="fa fa-user"></i> Избери <b class="caret"></b></a>
                <?php endif; ?>
                <?php if($this->isLoggedIn) : ?>
                    <i class="fa fa-user"></i> Здравей, <?=htmlspecialchars($_SESSION['username'])?> <b class="caret"></b></a>
                <?php endif; ?>
                <ul class="dropdown-menu">
                    <?php if(!$this->isLoggedIn) : { ?>
                        <li>
                            <a href="<?=APP_ROOT?>/users/login">Вход</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/users/register">Регистрация</a>
                        </li>
                    <?php } else: {?>
                        <li>
                            <a href="<?=APP_ROOT?>/users/logout""><i class="fa fa-fw fa-power-off"></i> Излез</a>
                        </li>

                    <?php } endif; ?>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on
         small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="<?=APP_ROOT?>/"><i class="fa fa-fw fa-home"></i>Начална страница</a>
                </li>
                <?php

                if($this->isLoggedIn || isset($_SESSION['profileID']) )  :
                    $profileid = $_SESSION['profileID'];
                    if  (!($profileid != 0) ){
                        ?>
                        <li>
                            <a href="<?=APP_ROOT?>/profile/create"><i class="fa fa-fw fa-bar-chart-o"></i>~Създай профил~</a>
                        </li>
                        <?php
                    }
                    ?>
                    <li>
                        <a href="<?=APP_ROOT?>/profile"><i class="fa fa-fw fa-barcode"></i>~Профил~</a>
                    </li>
                    <?php
                    if (isset($_SESSION['studentID'])){
                        $studentID = $_SESSION['studentID'];
                    }
                    if (isset($_SESSION['teacherID'])){
                        $teacherID = $_SESSION['teacherID'];
                    }
                    if (isset($_SESSION['parentID'])){
                        $parentID = $_SESSION['parentID'];
                    }
                    $position = $_SESSION['positionID'];
                    if ($position == 1) : ?>
                        <li>
                            <a href="<?=APP_ROOT?>/notifications"><i class="fa fa-fw fa-barcode"></i>~Известия~</a>
                        </li>
                    <?php endif;
                    if ($position == 2 ) :
                        ?>
                        <li>
                            <a href="<?=APP_ROOT?>/class"><i class="fa fa-fw fa-coffee"></i>Клас</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/users"><i class="fa fa-fw fa-group"></i>~Потребители~</a>
                        </li>

                        <li>
                            <a href="<?= APP_ROOT ?>/profile/studentProfile/"><i
                                        class="fa fa-fw fa-barcode"></i>~Ученически профил~</a>
                        </li>
                    <?php endif;
                    if ($position == 3 ) :

                        ?>
                        <li>
                            <a href="<?=APP_ROOT?>/events"><i class="fa fa-fw fa-coffee"></i>Събития</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/events/create"><i class="fa fa-fw fa-newspaper-o"></i>Създаване на събитие</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/class/create"><i class="fa fa-fw fa-coffee"></i>Създай Клас</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/class"><i class="fa fa-fw fa-coffee"></i>Клас</a>
                        </li>
                        <li>
                            <a href="<?=APP_ROOT?>/users"><i class="fa fa-fw fa-group"></i>~Потребители~</a>
                        </li>

                        <li>
                            <a href="<?=APP_ROOT?>/profile/teacherProfile/<?= $teacherID?>"><i
                                        class="fa fa-fw fa-barcode"></i>~Учителски профил~</a>
                        </li>
                    <?php  endif;
                    if ($position == 4 ) :
                        ?>
                        <li>
                            <a href="<?= APP_ROOT ?>/profile/parentProfile/<?= $parentID ?>"><i
                                        class="fa fa-fw fa-barcode"></i>~Родителски профил~</a>
                        </li>
                    <?php  endif;
                else:{

                }
                endif;
                ?>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper">
        <?php require_once('show-notify-messages.php'); ?>

