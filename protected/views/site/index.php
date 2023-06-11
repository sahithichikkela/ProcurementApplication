<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;


?>
<?php if(isset($_SESSION["name"])){?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?><i> ,<?php echo $_SESSION["name"] ?></i></h1>
<?php }
else { ?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?><i> ,<?php echo "please login" ?></i></h1>


<?php }?>
<p>This is my new website!</p>		

<!-- <p>You may change the content of this page by modifying the following two files:</p> -->
<!-- <ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul> -->


