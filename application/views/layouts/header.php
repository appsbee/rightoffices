<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Dashboard</title>
        <!--Core CSS -->
        <link href="<?php echo base_url() ?>/public/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/css/bootstrap-reset.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/assets/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/css/clndr.css" rel="stylesheet">
        <!--clock css-->
        <link href="<?php echo base_url() ?>/public/assets/css3clock/css/style.css" rel="stylesheet">
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/morris-chart/morris.css">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url() ?>/public/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/public/css/style-responsive.css" rel="stylesheet"/>
		 <script src="<?php echo base_url() ?>/public/js/lib/jquery.js"></script>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix">
                <!--logo start-->
                <div class="brand">
                    <a href="<?php echo base_url(); ?>" class="logo">
                        <img src="<?php echo base_url() ?>/public/images/logo.png" alt="">
                    </a>
                    <div class="sidebar-toggle-box">
                        <div class="fa fa-bars"></div>
                    </div>
                </div>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- settings start -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-success">8</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <li>
                                    <p class="">You have 8 pending tasks</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Target Sell</h5>
                                                <p>25% , Deadline  12 June13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="45">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Product Delivery</h5>
                                                <p>45% , Deadline  12 June13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="78">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Payment collection</h5>
                                                <p>87% , Deadline  12 June13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="60">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Target Sell</h5>
                                                <p>33% , Deadline  12 June13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="90">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- settings end -->
                        <!-- inbox dropdown start-->
                        <li id="header_inbox_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-important">4</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <li>
                                    <p class="red">You have 4 Mails</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="<?php echo base_url() ?>/public/images/avatar-mini.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Jonathan Smith</span>
                                            <span class="time">Just now</span>
                                        </span>
                                        <span class="message">
                                            Hello, this is an example msg.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="<?php echo base_url() ?>/public/images/avatar-mini-2.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Jhon Due</span>
                                            <span class="time">2 min ago</span>
                                        </span>
                                        <span class="message">
                                            Nice admin template
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="<?php echo base_url() ?>/public/images/avatar-mini-3.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Tasi sam</span>
                                            <span class="time">2 days ago</span>
                                        </span>
                                        <span class="message">
                                            This is an example msg.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="<?php echo base_url() ?>/public/images/avatar-mini.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Mr. Perfect</span>
                                            <span class="time">2 hour ago</span>
                                        </span>
                                        <span class="message">
                                            Hi there, its a test
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox dropdown end -->
                        <!-- notification dropdown start-->
                        <li id="header_notification_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-warning">3</span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <li>
                                    <p>Notifications</p>
                                </li>
                                <li>
                                    <div class="alert alert-info clearfix">
                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                        <div class="noti-info">
                                            <a href="#"> Server #1 overloaded.</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="alert alert-danger clearfix">
                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                        <div class="noti-info">
                                            <a href="#"> Server #2 overloaded.</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="alert alert-success clearfix">
                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                        <div class="noti-info">
                                            <a href="#"> Server #3 overloaded.</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- notification dropdown end -->
                    </ul>
                    <!--  notification end -->
                </div>
                <div class="top-nav clearfix">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <li>
                            <input type="text" class="form-control search" placeholder=" Search">
                        </li>
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="<?php echo base_url() ?>/public/images/avatar1_small.jpg">
                                <span class="username"><?php $logindata=$this->session->userdata('login_user_data');
								echo  $logindata['name']; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                        <li>
                            <div class="toggle-right-box">
                                <div class="fa fa-bars"></div>
                            </div>
                        </li>
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->