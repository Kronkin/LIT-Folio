<!-- # Script 3 -header.php -->

<div id="wrapper">  <!-- wrapper class div start -->

	<div class="header"> <!--header div starts-->
    
	<a href="./newIndex.php"><img src="images/logo.png" width="112" height="112" alt="Logo"></a>
    
<?php
	
	//checks to see if the user is logged in or not and if they are creates html to make the myfolio menu
	if (isset ($_SESSION['uid']))
	{
		echo ('<div class="panel">');
		
		
		//checks to see if they have linked their vimeo account and if they have offers to update their videos
			if ($_SESSION['videoActive'] == 'false')
			  {
				  echo ('<a id="connectVimeo" href="processesScripts/vimeoUserAuthentication.php"> <img src="../images/uploadVideo.png" alt ="upload video"></a><br/>');
			  }
			  else if ($_SESSION['videoActive'] == 'true')
			  {
			  	  echo ('<a id="vimeoVideo" href="processesScripts/processVideoUpdate.php"> <img src="../images/SyncVideo.png" alt ="sync video"></a><br/>');
			  }
			  
				  echo ('<a  href="#"><img src="../images/UploadAudioImages.png" alt ="upload audio & images" id="uploadButton"></a><br/>
				  
				  <a href="./home.php?qid='.$_SESSION['uid'].'"><img src="../images/myGallery.png" alt ="My Gallery"></a><br/>');
		  
				  //check to see if user is visiting their own homepage and if so gives them the option to edit it.
				  if ($_SESSION['uid'] == $_GET['qid'])
				  {
					  echo ('<a id="enableEdit" href="edit.php?qid='.$_SESSION['uid'].'"><img src="../images/editGallery.png" alt ="edit Gallery"></a><br/>');
				  }	  
				
				  echo ('<a class="logoutBut" href="./processesScripts/processLogout.php"><img src="../images/LogOut.png" alt ="logout"></a>
				
			  </div> <!-- closes panel div -->');
	}
	
	//if the user is not logged in
	else
	{
     	echo('   <div class="panel">

                  	<form id="myForm" method="post" action="" >

						<div id="inputForUserName">
	
							<label for="username">Username</label>
	
							<input type="text" size="47" name="uname" id="uname" value="" class="required" />
	
						</div> <!-- closes inputForUserName div -->
	
						<div id="inputForPassword">
	
							<label for="password">Password</label>
	
							<input type="text" size="47" name="pwd" id="pwd" value="" class="required" />
	
						</div> <!-- closes inputForPassword div -->
	
						<input class="submitLogin" id="loginSubmit" type="button" value="Sign In" name="submit" />

                	</form>

        			<p class="heading">New? <a href="#"><strong>Register Here</strong></a></p>

    			</div> <!-- closes panel div -->');
		
	}//closes else (if user is not logged in
?>

<a class="trigger" href="#">MYFOLIO</a>