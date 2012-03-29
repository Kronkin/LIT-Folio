<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" 
      type="image/png" 
      href="images/logo-favicon.png">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LIT Folio</title>
<link rel="stylesheet" type="text/css" href="css/styleX.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.validate.js"></script>
<script type="text/javascript" src="scripts/jquery/myjquery.main.js"></script>
			
</head>

<body>

<?php

include ('scripts/functions.php');

$_SESSION['page']='index'; //sets the var for use in filterQuery.php file

include ('includes/header.php');
 
include ('includes/body.html');

include ('includes/gallery.php');

include ('includes/footer.html');
?>



