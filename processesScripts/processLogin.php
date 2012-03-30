<?php # Script 14 processLogin.php

session_start();

$user=0;

require('../includes/mysqli_connect.php');

$username = $_POST['uname'];
$password = $_POST['pwd'];

$query  = "SELECT * FROM user WHERE uname='$username';";
$results = mysqli_query($dbc,$query);
 
  
if($results)
	{
				
		while($row=mysqli_fetch_array($results)) 
		{
			$user=1;
			
			if($row['pwd']==$password) 
			{
				$user=2;
				$_SESSION['username'] = $row['uname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['lname'] = $row['lname'];
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['userThumb'] = $row['userThumb'];
				$_SESSION['videoActive'] = $row['videoActive'];
				$_SESSION['loggedIn']='true';
				mysqli_close($dbc);					
			}
				
		}
}


	

	//if the user is logged in add this to the $html var
if ($user==2)
{
	
	if ($_SESSION['videoActive'] == 'false')
	 {
				  $html='<a id="connectVimeo" href="processesScripts/vimeoUserAuthentication.php"><img src="../images/uploadVideo.png" alt ="upload video"></a><br/>
				  
				  			<a  href="#"><img src="../images/UploadAudioImages.png" alt ="upload audio & images" id="uploadButton" ></a>
							<br/>														 																													 							<a href="./home.php?qid='.$_SESSION['uid'].'"><img src="../images/myGallery.png" alt ="My Gallery"></a>
							<br/>
    						<a class="logoutBut" href="./processesScripts/processLogout.php"><img src="../images/LogOut.png" alt ="logout"></a>';
	 }
	else if ($_SESSION['videoActive'] == 'true')
			  {
			  	  $html='<a id="vimeoVideo" href="processesScripts/processVideoUpdate.php"> <img src="../images/SyncVideo.png" alt ="sync video"></a><br/>
						
						<a  href="#"><img src="../images/UploadAudioImages.png" alt ="upload audio & images" id="uploadButton" ></a>
							<br/>														 																													 							<a href="./home.php?qid='.$_SESSION['uid'].'"><img src="../images/myGallery.png" alt ="My Gallery"></a>
							<br/>
    						<a class="logoutBut" href="./processesScripts/processLogout.php"><img src="../images/LogOut.png" alt ="logout"></a>';
			  }
	
}

 //if not logged in, add this to $html
else if ($user==1)
{
	$html='<div>User Name and Password do not match.</div>
				<br/>
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

        			<p class="heading">New? <a href="#"><strong>Register Here</strong></a></p>';
}

else if ($user==0)
{
	$html='<div>User not found.</div>
				<br/>
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

        			<p class="heading">New? <a href="#"><strong>Register Here</strong></a></p>';
}
print($html);