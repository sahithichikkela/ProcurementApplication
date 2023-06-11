<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <title>Document</title> -->
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<style>
			.radio-list {
		display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 10px;
	}


	.radio-list label.radio-inline {
	display: inline-block;
	 margin-right: 10px;
	}
	</style>

</head>
<body>
	


<?php

/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>	
<div class="container" style="width:400px;padding-left:400px;padding-top:80px" >

<div class="form" style="padding-left:20px;border-radius:5px;border:1px solid black;">
<h2 style="text-align:center">Register</h2>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'register-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
	
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pincode'); ?>
		<?php echo $form->numberField($model,'address[pincode]',array('id'=>'pincode')); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'address[state]',array('id'=>'state')); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'address[country]',array('id'=>'country')); ?>
	
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->textField($model,'address[district]',array('id'=>'district')); ?>

	</div>

	<div class="row">

	<?php echo $form->labelEx($model,'gender'); ?>

		<div class="radio-list" style="display:flex">

		<?php echo $form->radioButtonList($model, 'gender', array('male'=>'Male', 'female'=>'Female', 'other'=>'Other'), array('separator'=>'', 'labelOptions'=>array('class'=>'radio-inline'))); ?>

		</div>

	</div>

	<div class="row buttons" style="align-items:center">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<script>

		$("#pincode").keyup(function () {
		var el = $(this);
		if ((el.val().length == 6) && (is_int(el.val()))) {
		$.ajax({
		url: `https://api.postalpincode.in/pincode/${el.val()}`,
		cache: false,
		dataType: "json",
		type: "GET",
		success: function (result, success) {
		var postal = (JSON.stringify(result[0]))
		result = JSON.parse(postal).PostOffice[0];
		$("#country").val(result.Country); /* Fill the data */
		$("#state").val(result.State);
		$("#district").val(result.District);
		},
		error: function (result, success) {
		$(".zip-error").show(); 
		}

	});


	}


	});

	function is_int(value) {

		if ((parseFloat(value) == parseInt(value)) && !isNaN(value)) {

		return true;

		} else {

		return false;

		}

	}

</script>

</body>
</html>
