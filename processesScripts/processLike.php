<?php

session_start();

require_once('../includes/mysqli_connect.php');

$workID = $_POST['wid'];
$userID = $_POST['uid'];

$query="INSERT INTO likes (wid, uid) values('" . $workID . "','" . $userID . "')";

mysqli_query($dbc,$query);

$query="SELECT likes FROM assets WHERE wid='". $workID ."';";

$results = mysqli_query($dbc,$query);

if ($results)
{
	while($row=mysqli_fetch_array($results)) 
			{
				$likes = $row['likes'];
			}
			
			$likes++;
			
			$html="Likes:".$likes;
	
	$query="UPDATE assets SET likes='". $likes . "' WHERE wid='". $workID ."';";
	
	$results = mysqli_query($dbc,$query);

	
}

mysqli_close($dbc);

print $html;

?>