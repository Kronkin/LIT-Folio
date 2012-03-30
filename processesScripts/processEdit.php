<?php

session_start();


require_once('../includes/mysqli_connect.php');

$workID = $_POST['wid'];
$uid = $_POST['uid'];
$title = $_POST['title'];
$description = $_POST['description'];


		 
$query="UPDATE assets SET title='".$title."', description='".$description."'  WHERE wid='".$workID."';";


$results = mysqli_query($dbc,$query);


	mysqli_close($dbc);
	

?>
 		<span class="worktitle"><h2><?php echo $title; ?></h2></span>
 		<span class="description"><?php echo $description; ?></span>
         <?php 

	