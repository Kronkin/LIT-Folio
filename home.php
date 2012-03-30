<?php # Script 2 -home.php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" 
      type="image/png" 
      href="images/logo-favicon.png">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LIT Folio || Home Page</title>
<link rel="stylesheet" type="text/css" href="css/styleUser.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.validate.js"></script>
<script type="text/javascript" src="scripts/jquery/myjquery.main.js"></script>
</head>

<body>

<?php

include ('scripts/functions.php');

//this varible is stored for access in the filterQuery script, it is used so when the type or order by buttons are clicked it will run script to select rows from the database with the correct user id (specified by qid from the URL) 
$_SESSION['page']='home';

//this varible is for the filterQuery script, it is passed to the function for the DB call, it identifies the users page that is being viewed.
$_SESSION['qid']=$_GET['qid'];

include ('includes/header.php');

include ('includes/body.html');

//this function populates the bio panel on the user page
echo homePage();

include ('includes/gallery.php');

include ('includes/footer.html');
?>