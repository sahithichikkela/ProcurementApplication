


<?php
/* @var $this UserController */
/* @var $model User */

// var_dump($allposts);
// exit;
echo "<h1><b>All posts</b></h1>";

for($i=0;$i<count($allposts);$i++){
			echo "<hr> <b>Postedby</b>:". $allposts[$i]->postedby."<br>";
			echo " <b>Posttext</b>:". $allposts[$i]->posttext."<br> <br>";
			if($allposts[$i]->url!="")
			{
			echo "<img style='length:400px;width:300px;' src=".$allposts[$i]->url.">";
			}
			// echo $allposts[$i]->url;




}
?>