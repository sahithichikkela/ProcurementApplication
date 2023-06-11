<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

    <title>All categories</title>
</head>


<style>
#my-table tbody tr td {
    padding: 15px;

    border: none; /* Remove borders */
}


</style>
<body>

<div class="content-body">
        <div class="container-fluid">

<?php
Yii::app()->clientScript->registerScriptFile('//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css');
Yii::app()->clientScript->registerScript('datatable-script', CClientScript::POS_READY);
?>

<button class="btn btn-primary pull-right ml-3" ><a style="color:white" href="<?php echo $this->createUrl('index.php/ticket/newcat') ?>">+ New Category</a></button>

<h4>All Categories </h4>
<br><br>

<table id="my-table" class="display">
    <thead>
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Code</th>
            <th>Escalate To</th>
        </tr>
    </thead>
    <tbody style="color:black">
        <?php foreach ($data as $item): 
            
            ?>
            <tr>
                <td><?php echo $item['category']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td><?php echo $item['code']; ?></td>
                <td><?php echo $item['escalate_to']; ?></td>

               
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    </div>
</div>

<script>
$(document).ready(function() {
    $('#my-table').DataTable({
           
     } );

});
</script>


</div>
        </div>

