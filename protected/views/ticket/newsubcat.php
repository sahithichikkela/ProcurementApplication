<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url; // You may need to include this for URL generation
use yii\helpers\Json; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
    <title>Create Sub Category</title>
    <style>
        .gradient-custom {
        /* fallback for old browsers */
        background: #26355E;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to bottom right, #26355E, #26355E);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom right, #2E0B36, #26355E)
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
        }
        .card-registration .select-arrow {
        top: 13px;
        }
        .error-message{
            color:red;
        }
        .form-outline{
          border-radius: 5px;
          background-color:  #F1F1F1;
        }
        .radio-list {

        justify-content: space-between;
        align-items: center;
        }


        .radio-list label.radio-inline {
        display: inline-block;
        margin-right: 10px;
        
        }
        #category{
            color:black;
        }
        #subcategory{
            color:black;
        }
        .labels{
          color:black;
        
        }
    </style>
</head>
<body>
    <br>
<section class="vh-1000 " style="padding-left:200px">
  <div class="container py-5 h-150">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 " style="text-align:center">Create new Subcategory</h3>
            <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'createnewsubcategory-form',
              'enableClientValidation'=>true,
                  'htmlOptions' => array('enctype' => 'multipart/form-data'),
              'clientOptions'=>array(
                'validateOnSubmit'=>true,
              ),
            )); 
           ?>
          

              <!-- <div class="row"> -->
    <div class="">
    <?php echo $form->labelEx($catmodel,'category',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->dropDownList($catmodel, 'category', CHtml::listData($categories, 'cat', 'cat'), array(
            'empty' => 'Select Category',
            'id' => 'categoryDropdown',
            'class' => 'form-control' 
        )); ?>
    </div>
    <?php echo $form->error($catmodel, 'category', array("class" => 'error-message')); ?>
</div>
<br>    
    <div class="">
    <?php echo $form->labelEx($model,'subcategory',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->textField($model,'subcategory',array("class"=>'form-control')); ?>
    </div>
    <?php
    if (isset($errors['subcategory'])) {
        echo '<div class="error-message">';
        echo '<p>' . $errors['subcategory'][0] . '</p>';
        echo '</div>';
    }
    ?></div>
<br>

<div class="">
    <?php echo $form->labelEx($model,'subcategory code',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->textField($model,'scode',array("class"=>'form-control')); ?>
    </div>
    <?php
    if (isset($errors['scode'])) {
        echo '<div class="error-message">';
        echo '<p>' . $errors['scode'][0] . '</p>';
        echo '</div>';
    }
    ?>
</div>

<br>

<div class="">
    <?php echo $form->labelEx($model,'description',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->textField($model,'description',array("class"=>'form-control')); ?>
    </div>
    <?php
    if (isset($errors['description'])) {
        echo '<div class="error-message">';
        echo '<p>' . $errors['description'][0] . '</p>';
        echo '</div>';
    }
    ?></div>

<br>



<br>




<div class="mt-4 pt-2" style="text-align:center"> 
    <?php echo CHtml::submitButton('Submit', array("class" => "btn btn-primary btn-lg", "disabled" => true, "id" => "submitButton")); ?>
</div>


              <?php $this->endWidget(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <br><br>
</section>

</body>
</html>

<?php
$js = <<< JS
$(document).ready(function() {
    // Initially disable the submit button
    $('#submitButton').prop('disabled', true);

    // Listen for changes in the category dropdown
    $('#categoryDropdown').change(function() {
        var selectedCategory = $(this).val();

        // Enable the submit button if a category is selected
        if (selectedCategory !== '') {
            $('#submitButton').prop('disabled', false);
        } else {
            $('#submitButton').prop('disabled', true);
        }
    });
});
JS;

Yii::app()->getClientScript()->registerScript('disableSubmit', $js, CClientScript::POS_END);
?>