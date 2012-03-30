<?php # Script 15- processRegistration.php

session_start();

require_once('../includes/mysqli_connect.php');

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$username = $_POST['uname'];
$password = $_POST['pwd'];

if ($firstname!=''&& $lastname!=''&& $email!=''&& $username!=''&& $password!='')
{

$query="insert into user (fname, lname, email, uname, pwd) values('" . $firstname . "','" . $lastname . "','" . $email . "','". $username . "','" . $password ."')";

$results = mysqli_query($dbc,$query);

if($results) 
{
    $_SESSION['username'] = $username;
	$_SESSION['fname'] = $firstname;
	$_SESSION['lname'] = $lastname;
	$_SESSION['email'] = $email;
	$_SESSION['loggedIn'] = true;
	mysqli_close($dbc);
	
	chdir("../");
	mkdir("users/".$username."", 0777);
	mkdir("users/".$username."/audio", 0777);
	mkdir("users/".$username."/images", 0777); 
	mkdir("users/".$username."/avatar", 0777);
	mkdir("users/".$username."/extra", 0777);
	mkdir("users/".$username."/video", 0777);
	
	header("Location: ../newIndex.php"); 
	}
	
else   
{
	echo("Sorry Username is taken");
}

}
else
{
	$_SESSION['errorMsg'] = 'You must complete all the required fields.';
	header("Location: ../error.php");
	exit;
}
?>