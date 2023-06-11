
<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<link href="https://fonts.googleapis.com/css?family=O pen+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="16x16" href="db.png">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/aos/aos.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/boxicons/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/glightbox/css/glightbox.min.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module1/vendor/swiper/swiper-bundle.min.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/mytemplate/vendor/owl-carousel/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/mytemplate/vendor/owl-carousel/css/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/mytemplate/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/mytemplate/vendor/jqvmap/css/jqvmap.min.css">
   
</head>

<body>
<div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
	<div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <!-- <img src="https://chikkelasahithi.s3.ap-south-1.amazonaws.com/logo(2).png"  alt=""  width="70px" height="50px"> -->
            <div style="display: flex; align-items: center;">
                    <img class="logo-abbr" style="font-size: 66px; margin-top: 15px; margin-left: 14px;" width="100px" alt="Procure" src="https://chikkelasahithi.s3.ap-south-1.amazonaws.com/db.png">
                    <h2 class="brand-title" style="color: white; margin-left:7px;margin-top:24px;">Procure</h2>
            </div>


            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left" >
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                  
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                  
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="../vendor/profile  " class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                   
                                    <a href="../addvendor/login" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
		<div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                   
                             
                <li><a class="has-arrow"  href="/index.php/vendor/dashboard" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                     
                    </li><br>

                    <li><a class="has-arrow" href="/index.php/vendor/viewmyposts" aria-expanded="false">
                    <i class="fa fa-search"></i><span class="nav-text">View Your ADs</span></a>
                     
                    </li><br>

                  

                    <li><a class="has-arrow" href="/index.php/vendor/newpost" aria-expanded="false"><i
                   class="fa fa-plus"></i><span class="nav-text">Post an Ad</span></a>
                     
                    </li><br>

                    <li><a class="has-arrow" href="/index.php/vendor/yourorders" aria-expanded="false"><i
                   class="fa fa-cube"></i><span class="nav-text">Orders Recieved </span></a>
                     
                    </li><br>
                    

                    <li><a class="has-arrow" href="/index.php/vendor/editprofile" aria-expanded="false"><i
                                class="fa fa-pencil-square-o"></i><span class="nav-text">Edit Profile</span></a>
                     
                    </li><br>

                    <li><a class="has-arrow" href="/index.php/vendor/chat" aria-expanded="false"><i
                                class="fa fa-comment"></i><span class="nav-text">Chat</span></a>
                     
                    </li><br>


                    <li><a class="has-arrow" href="/index.php/vendor/logout" aria-expanded="false"><i
                                class="fa fa-sign-out"></i><span class="nav-text">Sign out</span></a>
                     
                    </li><br>

                    
         

                    
                </ul>
            </div>
			


        </div>
        <?php echo $content; ?>
			<div class="clear"></div>
	
    </div>

	<script src="/mytemplate/vendor/global/global.min.js"></script>
    <script src="/mytemplate/js/quixnav-init.js"></script>
    <script src="/mytemplate/js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="/mytemplate/vendor/raphael/raphael.min.js"></script>
    <script src="/mytemplate/vendor/morris/morris.min.js"></script>


    <script src="/mytemplate/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="/mytemplate/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="/mytemplate/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="/mytemplate/vendor/flot/jquery.flot.js"></script>
    <script src="/mytemplate/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="/mytemplate/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="/mytemplate/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="/mytemplate/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="/mytemplate/vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="/mytemplate/js/dashboard/dashboard-1.js"></script>

</body>
</html>
