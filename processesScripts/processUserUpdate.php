<?php

session_start();


require_once('../includes/mysqli_connect.php');

$bio = $_POST['bio'];
$email = $_POST['email'];
$uid = $_POST['uid'];


		 
$query="UPDATE user SET email='".$email."', bio='".$bio."'  WHERE uid='".$uid."';";


$results = mysqli_query($dbc,$query);


	mysqli_close($dbc);
	

?>
 		<span class="userMail">Email:<?php echo($email); ?></span>
		<br /><br /><span class="bio">"<?php echo ($bio); ?>"</span>
         <?php 