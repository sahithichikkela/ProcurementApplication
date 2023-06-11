<?php
// var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
<section style="background-color: #eee;">
  <div class="container py-5">
    
  <div class="form">
<h2 style="text-align:center">Profile Edit</h2>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'profedit-form',
		'enableClientValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>






    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?= $model->profilepic?>" 
              class="rounded-circle img-fluid" style="width: 150px;">


              <div class="row"  style="padding-left:50px">

              <div class="col-sm-10 form-floating" >
                <div class="row" style="padding-left:20px">
                    <?php echo $form->labelEx($model,'profile picture'); ?>
                    <?php echo $form->fileField($model,'photo',array("class"=>'form-control')); ?>
            
                    
                </div>
              </div>
              
              <div class="col-sm-10 form-floating" >
                <div class="row" style="padding-left:20px">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <?php echo $form->textField($model,'username',array("class"=>'form-control')); ?>
            
                    
                </div>
              </div>
            </div>
            <hr>
            <!-- <h5 class="my-3">John Smith</h5>
            <p class="text-muted mb-1">Full Stack Developer</p>
            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> -->
            <div class="d-flex justify-content-center mb-2">
             

            <div class="row"><br>

        <?php echo $form->labelEx($model,'gender'); ?>

            <div class="radio-list" style="display:flex;">

            <?php echo $form->radioButtonList($model, 'gender', array('male'=>'Male', 'female'=>'Female', 'other'=>'Other'), array('separator'=>'', 'labelOptions'=>array('class'=>'radio-inline'))); ?>

            </div>

        </div>
        <br>
        <div class="row buttons" style="align-items:center;color:white">
            <?php echo CHtml::submitButton('Submit',array("style"=>"background-color:#1a75ff")); ?>
        </div>

            </div>
          </div>
        </div>
       
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            
            <hr>
            <div class="row">
              
              <div class="col-sm-8 form-floating">
                <div class="row">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array("class"=>'form-control')); ?>
            
                    
                </div>
              </div>
            </div>
            <hr>



            <div class="row">
              
              <div class="col-sm-8 form-floating">
                <div class="row">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password',array("class"=>'form-control')); ?>
             
                    
                </div>
              </div>
            </div>
            <hr>

            <div class="row">
              
              <div class="col-sm-8 form-floating">
                <div class="row">
                    <?php echo $form->labelEx($model,'phone'); ?>
                    <?php echo $form->textField($model,'phone',array("class"=>'form-control')); ?>
          
                    
                </div>
              </div>
            </div>
            <hr>


            <div class="row">
              
              <div class="col-sm-8 form-floating">
              <div class="row">
                <?php echo $form->labelEx($model,'pincode'); ?>
                <?php echo $form->numberField($model,'address[pincode]',array('id'=>'pincode',"class"=>'form-control')); ?>
	
	            </div>

              </div>
            </div>
            <hr>

            <div class="row">
              
              <div class="col-sm-8 form-floating">
              <div class="row">
                <?php echo $form->labelEx($model,'district'); ?>
                <?php echo $form->textField($model,'address[district]',array('id'=>'district',"class"=>'form-control')); ?>
	
	            </div>

              </div>
            </div>
            <hr>


            <div class="row">
              
              <div class="col-sm-8 form-floating">
              <div class="row">
                <?php echo $form->labelEx($model,'state'); ?>
                <?php echo $form->textField($model,'address[state]',array('id'=>'state',"class"=>'form-control')); ?>
	
	            </div>

              </div>
            </div>
            <hr>

            <div class="row">
              
              <div class="col-sm-8 form-floating">
              <div class="row">
                <?php echo $form->labelEx($model,'country'); ?>
                <?php echo $form->textField($model,'address[country]',array('id'=>'country',"class"=>'form-control')); ?>
	
	            </div>

              </div>
            </div>
            <hr>

       
           
            
          </div>
        </div>
  
      </div>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div><!-- form -->
  
</section>


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