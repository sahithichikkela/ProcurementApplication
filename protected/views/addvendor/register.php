<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css"
  rel="stylesheet"
/>
    <title>Vendor-Register</title>
    <style>
       .form-outline{
          border-radius: 5px;
          background-color:  #F1F1F1;
        }
    </style>
</head>
<body><br><br>
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
          Elevate your <br />
            <span class="text-primary"> procurement game!</span>
          </h1>
          <!-- <p style="color: hsl(217, 10%, 50.8%)">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p> -->
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <h4 style="text-align:center">Register now!</h4><br>
            <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'register-form',
              'enableClientValidation'=>true,
                  'htmlOptions' => array('enctype' => 'multipart/form-data'),
              'clientOptions'=>array(
                'validateOnSubmit'=>true,
              ),
            )); ?>
            <?php if(Yii::app()->user->hasFlash('success')): ?>
                <div class="alert alert-success" >
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('warning')): ?>
                <div class="alert alert-warning" style="color:red">
                    <?php echo Yii::app()->user->getFlash('warning'); ?>
                </div>
            <?php endif; ?>
                <!-- 2 column grid layout with text inputs for the first and last names -->
          
<div class="row">
                <div class="col-md-6 mb-4">
                <?php echo $form->labelEx($model,'username'); ?>
                  <div class="form-outline">
                    <?php echo $form->textField($model,'username',array("class"=>'form-control')); ?>
                    <?php echo $form->error($model,'username',array('style'=>'color:red')); ?>
            
                  </div>

                </div>
                <div class="col-md-6 mb-4">
                <?php echo $form->labelEx($model,'email'); ?>
                  <div class="form-outline">
                    <?php echo $form->textField($model,'email',array("class"=>'form-control')); ?>
                    <?php echo $form->error($model,'email',array('style'=>'color:red')); ?>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-md-6 mb-4">
                <?php echo $form->labelEx($model,'password'); ?>
                  <div class="form-outline">
                    <?php echo $form->passwordField($model,'password',array("class"=>'form-control')); ?>
                    <?php echo $form->error($model,'password',array('style'=>'color:red')); ?>
            
                  </div>

                </div>
                <div class="col-md-6 mb-4">
                <?php echo $form->labelEx($model,'confirm password'); ?>
                  <div class="form-outline">
                    <?php echo $form->passwordField($model,'cpassword',array("class"=>'form-control')); ?>
                    <?php echo $form->error($model,'cpassword',array('style'=>'color:red')); ?>
                  </div>

                </div>
              </div>

              <div class="row">
                
            
                <div class="col-md-6 mb-4" >

                  <?php echo $form->labelEx($model,'phone'); ?>
                  <div class="form-outline">
                      <?php echo $form->textField($model,'phone',array("class"=>'form-control')); ?>
                      <?php echo $form->error($model,'phone',array('style'=>'color:red')); ?>
                  </div>

                </div>

                <div class="col-md-6 mb-4" >

                  <?php echo $form->labelEx($model,'location'); ?>
                  <div class="form-outline">
                      <?php echo $form->textField($model,'location',array("class"=>'form-control')); ?>
                      <?php echo $form->error($model,'location',array('style'=>'color:red')); ?>
                  </div>

                </div>
              </div>

              <div class="form-check d-flex justify-content-center mb-4">
                  <!-- <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                  <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                  </label> -->
                  Already have an account? <a href="../addvendor/login"> <b style="padding-left:5px">Login Here</b></a>
                </div>

              <div class="mt-4 pt-2" style="text-align:center"> 
              <!--  <input class="btn btn-primary btn-lg" type="submit" value="Submit" /> -->
                <?php echo CHtml::submitButton('Submit',array("class"=>"btn btn-primary btn-lg")); ?>
              </div>

                <!-- Register buttons -->
                <!-- <div class="text-center">
                  <p>or sign up with:</p>
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                  </button>

                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                  </button>

                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                  </button>

                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                  </button>
                </div> -->
                <?php $this->endWidget(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


</body>
</html>
