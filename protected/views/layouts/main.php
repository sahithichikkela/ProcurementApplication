<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header" style="background-color:#1a75ff">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<br><br>
	</div>

	<div id="mainmenu" style="height:45px; padding-left:40px; background-color: #1a75ff;font-size:15px">
			<div class="row">
				<ul>
					<a href="../../index.php/site/index"><li style="padding : 30px; color: white;">Index</li></a>
					<a href="../../index.php/site/login"><li style="padding : 30px; color: white;">Login</li></a>
					<a href="../../index.php/site/register"><li style="padding : 30px; color: white;">Register</li></a>
					<a href="../../index.php/site/view"><li style="padding : 30px; color: white;">Users</li></a>
					<a href="../../index.php/site/post"><li style="padding : 30px; color: white;">Post</li></a>
					<a href="../../index.php/site/userposts"><li style="padding : 30px; color: white;">User Posts</li></a>
					<a href="../../index.php/site/logout"><li style="padding : 30px; color: white;">Logout</li></a>

				</ul> 

			</div>

	</div>
	<!-- mainmenu -->


	<?php echo $content; ?>

	<div class="clear"></div>


</div><!-- page -->

</body>
</html>

