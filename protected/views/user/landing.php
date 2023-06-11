<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

    <title>All tickets</title>
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

<!-- <button class="btn btn-primary  pull-right ml-3" ><a style="color:white" href="<?php echo $this->createUrl('index.php/ticket/create') ?>">+ Create Ticket</a></button> -->

<h4>All Issues </h4>
<br><br>

<table id="my-table" class="display">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Createdby</th>
            <th>SLA(in hrs)</th>
            <th>Status</th>
           
        </tr>
    </thead>
    <tbody style="color:black">
        <?php foreach ($data as $item): 
            $timestamp = strtotime($item['timestamp']);

            $currentTime = strtotime(date('Y-m-d H:i:s'));
  
            $timeDifference = $currentTime - $timestamp;
    
            if(intval($timeDifference/3600)>24){
                $sla=intval($timeDifference/3600)-24;

            }
            else {
                $sla="-";
            }

            ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><a style="color:black" href="<?php echo $this->createUrl('index.php/ticket/ticketdetails', array('id' =>  $item['id'])) ?>" ><?php echo $item['title']; ?></a></td>
                <td><?php echo $item['description']; ?></td>
                <td><?php echo $item['priority']; ?></td>
                <td><?php echo $item['category']; ?></td>
                <td><?php echo Register::model()->findByAttributes(array('email'=>$item['createdby']))['username']; ?></td>
                <td style="color:red"><?php echo $sla; ?></td>
                <td><?php echo $item['status']; ?></td>
                
               
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    </div>
</div>

<script>
$(document).ready(function() {
    $('#my-table').DataTable({
    ordering: false
});


});
</script>


</div>
        </div>

