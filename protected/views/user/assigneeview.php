<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

    <title>Assignee View</title>
</head>


<style>

.comment {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f7f7f7;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}

.comment-header {
    font-weight: bold;
    margin-bottom: 5px;

}

.comment-text {
    font-size: 14px;
    line-height: 1.5;
}
    h4 {
        display: inline;
    }

</style>
<body>

<div class="content-body mr-5">
        <div class="container-fluid ml-5 mr-5">
        <?php

if ($data->status=="Assigned" || $data->status=="Assigned (Escalated)"){ ?>


<button class="btn btn-primary pull-right ml-5" ><a style="color:white" href="<?php echo $this->createUrl('index.php/ticket/holdticket', array('id' => $data->id)); ?>"> Hold Ticket</a></button>

<?php
}
?>


<?php

if ($data->status=="Hold"){ ?>

<button class="btn btn-primary pull-right ml-5" ><a style="color:white" href="<?php echo $this->createUrl('index.php/ticket/openticket', array('id' => $data->id)); ?>"> Open Ticket</a></button>

<?php
}


if ($data->status=="Closed"){ ?>


<button class="btn btn-danger pull-right ml-5" > The ticket is CLOSED</button>

<?php
}
?>

    <br><br>
    <br>
    <h4>Ticket title  : </h4><h4 style="color:black;padding-left:10px"><?php echo $data->title;?></h4><hr>
    <h4>Category  :</h4><h4 style="color:black;padding-left:10px"><?php echo $data->category;?></h4><hr>
    <h4>Status  :</h4><h4 style="color:black;padding-left:10px"><?php echo $data->status;?></h4><hr>
    <h4>Priority  :</h4><h4 style="color:black;padding-left:10px"><?php echo $data->priority;?></h4><hr>
    <h4>Assigned to  : </h4><h4 style="color:black;padding-left:10px"><?php echo Register::model()->findByAttributes(array('email'=>$data->assigned_to))['username'];?></h4><hr>

    <br>

    <h3 class="pt-5"><i>Comments :</i></h3>
<hr style="height:3px">
<div>

    <div class="comments">
        
        <?php 
        if ($data->comments)
        {
            foreach ($data->comments as $comment): ?>
        <div class="comment" style="color:grey">
            <div class="comment-header">
                <strong><?php echo $comment['user']; ?>:</strong>
            </div>
            <div class="comment-text">
                <?php echo $comment['text']; ?>
            </div>
        </div>

            <?php endforeach; 
        }
        else{?>
            <div class="comment" style="color:black">
                <strong><i><?php   echo "No Comments to Display"; ?></i></strong>
            </div>
        <?php
        }
         ?>
    </div>

    <?php
    echo CHtml::beginForm(array('ticket/comment'), 'post', array('id' => 'comment-form'));

    // Input textbox for posting comments
    echo CHtml::textField('comment', '', array('placeholder' => 'Write a comment...', 'class' => 'form-control','id'=>'comment_id'));
    echo "<br>";
    // Submit button
    echo CHtml::submitButton('Post Comment', array('class' => 'btn btn-primary pull-right mr-5'));

    echo CHtml::endForm();
    ?>
    <br><br>
</div>

<script type="text/javascript">
    // Submit the form and add a new comment on pressing Enter key
    $('#comment-form input[type="text"]').keypress(function(event) {
        if (event.which === 13) {
            event.preventDefault();
            $('#comment-form').submit();
        }
    });

    // AJAX submit the form and update comments
    $('#comment-form').submit(function() {
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->createUrl('index.php/ticket/comment', array('id' => $data->id)); ?>',
            data: $(this).serialize(),
            success: function(data) {
                $('.comments').html(data);
                $('#comment_id').val('');
                location.reload();
            }
        });
        return false;
    });
</script>


    </div>
</div>





