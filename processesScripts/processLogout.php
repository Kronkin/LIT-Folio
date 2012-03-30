<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location:http://www.eamonnhealy.com/index.php');
?>