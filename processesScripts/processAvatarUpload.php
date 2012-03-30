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
	
	
	//echo(($_FILES['mkfile']['size'])); //debugging info
	//echo ('<br/>');
	
	//check to see the type of file uploaded and the extention it has and if that exists in the array of images, it then sets the $type to image, this will be	 		used on upload to the database to identify media type and present the appropriate icon.
	if (in_array($_FILES['mkfile']['type'], $allowedImages))
	{
		$type = "image";
		$uploaddir="../users/".$_SESSION['username']."/avatar/"; //set the dir path
		
	}//closes if in allowedImages array
	
	//if it is not an image 
	else 
	{
		echo('<div>Not an image</div>');
	}
	
	  

	  $time = microtime(); //this var takes a sample of microtime, a very fine timestamp to milli seconds hopefully unique
	  
	  //$fileName takes the title the user gave in the form and appends the $time to it and also the type of file extention this will be stored in the 	 	   		database to find the asset when called.
	  $fileName = $_SESSION['username'].$time.'.'.basename($_FILES['mkfile']['type']); 
	  $uid = $_SESSION['uid'];
	  $link = $uploaddir.$fileName;
	  
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
		   
	  $query="UPDATE user SET userThumb='". $link . "' WHERE uid='". $uid ."';";
	  
	  $results = mysqli_query($dbc,$query);
	  
	  mysqli_close($dbc);
		  
	  header("Location: ../edit.php?qid=".$uid."");
	  
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
