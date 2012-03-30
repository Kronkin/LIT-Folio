<?php 

session_start();

//if upload fails, debugging information
/*echo ('Here is somemore debugging info:');

print_r($_FILES);*/


//if the file has been uploaded
if (isset ($_FILES['mkfile']))
{
	//echo($_FILES['mkfile']['name']); //for debugging
	//echo ('<br/>');
	//echo(($_FILES['mkfile']['type'])); //for debugging
	//echo ('<br/>');
	
	
	
	//creates an array containing type of file uploaded and file extentions allowed for images, will be used to check the file uploaded against
	$allowedImages = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
	
	//creates an array containing type of file uploaded and file extentions allowed for audio
	$allowedAudio = array ('audio/mp3');
	
	//echo(($_FILES['mkfile']['size'])); //debugging info
	//echo ('<br/>');
	
	//check to see the type of file uploaded and the extention it has and if that exists in the array of images, it then sets the $type to image, this will be	 		used on upload to the database to identify media type and present the appropriate icon.
	if (in_array($_FILES['mkfile']['type'], $allowedImages))
	{
		$type = "image";
		$fileLocal = "images";
		$uploaddir="../users/".$_SESSION['username']."/images/"; //set the dir path
		
	}//closes if in allowedImages array
	
	//if it is not an image then check if it is in the allowed allowedAudio array, if it is set its type to audio
	else if (in_array($_FILES['mkfile']['type'], $allowedAudio))
	{
		$type = "audio";
		$fileLocal = "audio";
		$uploaddir="../users/".$_SESSION['username']."/audio/"; //set the dir path
	}
	
	else
	{
		$type = "video";
		$fileLocal = "video";
		$uploaddir = "../users/".$_SESSION['username']."/video/";
	}
	
	  

	  $time = microtime(); //this var takes a sample of microtime, a very fine timestamp to milli seconds hopefully unique
	  
	  //$fileName takes the title the user gave in the form and appends the $time to it and also the type of file extention this will be stored in the 	 	   		database to find the asset when called.
	  $fileName = $_POST['title'].$time.'.'.basename($_FILES['mkfile']['type']); 
	  $title = $_POST['title'];
	  $description = $_POST['uploadDescription'];
	  $author = $_SESSION['username'];
	  $uid = $_SESSION['uid'];
	  $link = "users/".$_SESSION['username']."/".$fileLocal."/".$fileName;
	  $_SESSION['link']=$link;
	  $_SESSION['title']=$title;
	  $_SESSION['description']=$description;
	  
	  //echo($fileName); //for debugging
	  //echo("<br/>");
	  //echo($uploaddir);
	  //echo("<br/>");

	  $uploadfile=$uploaddir.$fileName; //sets the path for the file to be moved from temp folder to actual folder
	  
	  //echo($uploadfile);
	  
	  

	  //if the file is uploaded and succesfully moved to permant location, add its details to the DB
	  if (move_uploaded_file($_FILES['mkfile']['tmp_name'], $uploadfile))
	  {
		 
		 //echo('<div> Its the insert.</div>');
		 
	  require_once('../includes/mysqli_connect.php');
		   
	  $query="insert into assets (address, title, description, authorID, type)
	  		  values('" . $link . "','" . $title . "','" . $description . "','" . $uid . "','" . $type . "')";
	  
	  $results = mysqli_query($dbc,$query);
	  
	  mysqli_close($dbc);
		if ($type=='image')
		{
	  		header("Location: ../home.php?qid=".$uid."");
		}
		else if ($type=='audio')
		{
	  		header("Location: ../home.php?qid=".$uid."");
		}
		else if ($type=='video')
		{
			header("Location: ../processesScripts/uploadtoVimeo.php");
		}
		
		
	  }//close if file is moved loop
	  
	  //debug info if the file is not moved succesfully
	  else
	  {
		  echo('<br/>');
	  echo ('Here is somemore debugging info:');
	  
	  print_r($_FILES);
	  }

	}//closes isset mkfile
	
	 //if the file has not been uploaded
	 else
	 {
		echo ('is no file');
	 }
?>
