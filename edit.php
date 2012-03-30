<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" 
      type="image/png" 
      href="images/logo-favicon.png">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LIT Folio || Edit my homepage</title>
<link rel="stylesheet" type="text/css" href="css/editStyle.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.validate.js"></script>
<script type="text/javascript" src="scripts/jquery/myjquery.main.js"></script>
</head>

<body>

<?php

include ('scripts/functions.php');

//this session var is used in filterQuery.php, it is used to define what functions to perform on the gallery when it is ordered or filtered. It is used in 		 if else statments on filterQuery.php file 
$_SESSION['page']='editHomePage';

include ('includes/header.php');

include ('includes/body.html');

//calls editHomePage function, creates the html that populates the user bio with edit functionality
echo edithomePage();

include ('includes/editGallery.php');

include ('includes/footer.html');
?>