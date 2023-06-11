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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    <title>Create Ticket</title>
    
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

            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 " style="text-align:center">Create new ticket</h3>
            <button class="btn btn-primary pull-right ml-5" ><a style="color:white" href="<?php echo $this->createUrl('index.php/ticket/create'); ?>"> Create for self</a></button>

            <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'createticket-form',
              'enableClientValidation'=>true,
                  'htmlOptions' => array('enctype' => 'multipart/form-data'),
              'clientOptions'=>array(
                'validateOnSubmit'=>true,
              ),
            )); ?>
          
    
<br><br>
<?php 
 
 $cookie = Yii::app()->request->cookies['email'];
 if ($cookie !== null) {
     $po = urldecode($cookie->value);
 }
    $userNames = CHtml::listData(Register::model()->findAll(), 'email', 'email');
    unset($userNames[$po]);
 
 
?>

<div class="">
    <?php
    echo $form->labelEx($model, 'onBehalf', array("class" => 'labels'));
    echo $form->dropDownList($model, 'onBehalf', $userNames, array(
        'id' => 'onBehalf',
        'class' => 'form-control',
        'empty' => 'Select email',
    ));
    
    echo $form->error($model, 'onBehalf', array("class" => 'error-message'));
    echo "<br>";
    ?>
</div>


<div class="">
    <?php echo $form->labelEx($model,'title',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->textField($model,'title',array("class"=>'form-control')); ?>
    </div>
    <?php echo $form->error($model, 'title', array("class" => 'error-message')); ?>
</div>
<br>

<div class="">
    <?php echo $form->labelEx($model,'description',array("class"=>'labels')); ?>
    <div class="form-outline">
        <?php echo $form->textField($model,'description',array("class"=>'form-control')); ?>
    </div>
    <?php echo $form->error($model, 'description', array("class" => 'error-message')); ?>
</div>

<br>

<?php
    echo $form->labelEx($model,'priority',array("class"=>'labels'));
    $priorities = array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    );

    echo $form->dropDownList($model, 'priority', $priorities, array(
        'id' => 'priority',
        'class' => 'form-control',
        'empty' => 'Select priority',
    
    ));
    echo $form->error($model, 'priority', array("class" => 'error-message'));
    echo "<br>";

    $categories = CHtml::listData(Category::model()->findAll(), 'category', 'category'); 
    
    echo $form->labelEx($model,'category',array("class"=>'labels'));
echo $form->dropDownList($model, 'category', $categories, array(
    'id' => 'category',
    'class' => 'form-control',
    'empty' => 'Select Category',
));

echo "<br>";

echo $form->labelEx($model,'subcategory',array("class"=>'labels'));
echo $form->dropDownList($model, 'subcategory', array(), array(
    'id' => 'subcategory',
    'class' => 'form-control',
    'empty' => 'Select Subcategory',
));
?>

<br>

<br>



<div class="mt-4 pt-2" style="text-align:center"> 
    <?php echo CHtml::submitButton('Submit', array("class" => "btn btn-primary btn-lg")); ?>
</div>


              <?php $this->endWidget(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <br><br>
</section>
<script>
$(document).ready(function() {
    $('#category').on('change', function() {
        var selectedCategory = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->createUrl('index.php/ticket/subcategories'); ?>',
            data: { category: selectedCategory },
            success: function(subcategories) {
                var subcategoryDropdown = $('#subcategory');
                subcategoryDropdown.empty().append($('<option>').val('').text('Select Subcategory'));
                subcategories = subcategories.substr(69);
                subcategories = JSON.parse(subcategories);
                $.each(subcategories, function(index, description) {
                    subcategoryDropdown.append($('<option>').val(description).text(description));
                });
            }
        });
    });

    // $('#onBehalf').on('change', function() { 
    //     $.ajax({
    //         url: '<?php echo Yii::app()->createUrl('index.php/ticket/GetUsers'); ?>',
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(data) {

    //             console.log("Receive");
                
    //             $('#onBehalf').empty().append($('<option>').val('').text('Select email'));

    //             $.each(data, function(index, email) {
    //                 $('#onBehalf').append($('<option>').val(email).text(email));
    //             });
    //         }
    //     });
    // });

});
</script>

</body>
</html>