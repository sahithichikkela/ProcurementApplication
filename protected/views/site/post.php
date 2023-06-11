<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>

<div class="container" style="width:400px;padding-left:400px;padding-top:80px" >

<div class="form" style="padding-left:80px;border-radius:5px;border:1px solid black;">
<h2 style="padding-left:40px">Post something</h2>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'post-form',
		'enableClientValidation'=>true,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'postedby'); ?>
		<?php echo $form->textField($model,'postedby'); ?>
		<br>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'posttext'); ?>
		<?php echo $form->textField($model,'posttext'); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->fileField($model,'photo'); ?>
		
	</div>
	

	<div class="row buttons" >
		<?php echo CHtml::submitButton('Post'); ?>
	</div>
    <br>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
