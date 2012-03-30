<?php #script 9- functions
session_start();

//these few lines should stop the site passing PHPSESSID in the URL and messing with my URL checks
if (function_exists ('ini_set'))
{
   // Use cookies to store the session ID on the client side
   @ ini_set ('session.use_only_cookies', 1);

   // Disable transparent Session ID support
   @ ini_set ('session.use_trans_sid',    0);
}


function uniqueViews()
{


$ip = $_SERVER['REMOTE_ADDR'];
$nWid = $_GET['wid'];



require('./includes/mysqli_connect.php');
		$query  = "SELECT * FROM test WHERE IP=INET_ATON('". $ip ."') AND wid=" . $nWid . ";";
		$results = mysqli_query($dbc,$query);
		
		if($row=mysqli_fetch_array($results)) 
			{
				//echo('<div> Welcome Back </div>');
				 //do nothing
			}
		else 
		{
			$query  = "SELECT views FROM assets WHERE wid='". $nWid ."';";
			$results = mysqli_query($dbc,$query);
 
			if($results)
			{
				while($row=mysqli_fetch_array($results)) 
				{
					$views = $row['views'];
				}
				
				$views++;
				
				$query = "UPDATE assets SET views='". $views. "' WHERE wid='". $nWid ."';";
				mysqli_query($dbc,$query);
				
				$query = "INSERT INTO test (IP, wid) VALUES (INET_ATON('".$ip."'), '". $nWid ."');";
				mysqli_query($dbc,$query);
				
				}
			 }
			 
			mysqli_close($dbc);

}

 /*this function queries the database for information to populate the gallery, it takes the info returned from the database and puts it into 
 the html. There is also so jquery functions that do this.*/

function populateGallery()
{
	$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
		require('./includes/mysqli_connect.php');
		$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid
				   ORDER BY assets.date DESC;";
		$results = mysqli_query($dbc,$query);
 
  		if($results)
		{
			while($row=mysqli_fetch_array($results)) 
			{
				$title = $row['title'];
				$author = $row['uname'];
				$link = $row['address'];
				$type = $row['type'];
				$authorID = $row['uid'];
				$views = $row['views'];
				$likes = $row['likes'];
				$comments = $row['comments'];
				$workID = $row['wid']; 
									
				echo(' <li class="'.$type.'">
					 
                   			<div class="boxgrid caption">');
							
							if ($type=='image')
							{
							
                      			echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
							else if ($type=='audio')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="images/audio.png"width="180" height="100" alt="test"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="'.$title.'"></a>');
							}
                       			echo('<div class="cover boxcaption">
												
	       							<h2><a href="./work.php?wid='.$workID.'">'.$title.'</a></h2>');
								
									if($type=='audio')
									{
                          				echo ('<span class="mediaIcon"><img src="images/audioIcon.png" alt="'.$type.'"></span>');
									}
									else if ($type=='image')
									{
										echo ('<span class="mediaIcon"><img src="images/imageIcon.png" alt="'.$type.'"></span>');
									}
									else if ($type=='video')
									{
										echo ('<span class="mediaIcon"><img src="images/videoIcon.png" alt="'.$type.'"></span>');
									}
																
                         			echo(' <span class="artistName"><a href="./home.php?qid='.$authorID.'">'.$author.'</a></span>
										 
                         				 	<span class="viewsIcon"><img src="images/viewsIcon.png" alt="views">'.$views.'</span>
											
                         				 	<span class="commentsIcon"><img src="images/commentsIcon.png" alt="comments">'.$comments.'</span>
											
                          				 	<span class="likesIcon"><img src="images/likesIcon.png" alt="likes">'.$likes.'</span>
											
                     			</div> <!-- closes cove boxcaption div --> 
								
                    		</div> <!-- closes boxgrid caption div -->
                		</li>');
														
						}//closes while results
					mysqli_close($dbc);
				}//closes if resuts
			
	/*this checks to see if the URL is that of the home page and if the varible session UID exists, ie. if user is logged in, and then if the login var is the 		same as the QID, the QID is passed in any author or user clickble link. So really it just checks to see if a user is logged in and if the home page 			 		they are visiting is their own homepage or not.	*/
	
}//closes populateGallery function


function populateHomeGallery()
{
	if (isset($_GET['qid']))
	{
		$uid = $_GET['qid'];
	}
	else
	{
		$uid = $_SESSION['uid'];
	}	
		require('./includes/mysqli_connect.php');
		$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, user.uname, user.uid 
				   FROM assets 
				   INNER JOIN user
				   ON assets.authorID=user.uid
				   WHERE assets.authorID='" . $uid. "'
				   ORDER BY date DESC
				   ;";
				   
		$results = mysqli_query($dbc,$query);
	 
		if($results)
		{
			while($row=mysqli_fetch_array($results)) 
			{
				$title = $row['title'];
				$author = $row['uname'];
				$link = $row['address'];
				$type = $row['type'];
				$authorID = $row['uid'];
				$views = $row['views'];
				$likes = $row['likes'];
				$comments = $row['comments'];
				$workID = $row['wid'];
				
				
				echo(' <li class="'.$type.'">
					 
                   			<div class="boxgrid caption">');
							
							if ($type=='image')
							{
							
                      			echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
							else if ($type=='audio')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="images/audio.png"width="180" height="100" alt="test"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="'.$title.'"></a>');
							}
                       			echo('<div class="cover boxcaption">
												
	       							<h2><a href="./work.php?wid='.$workID.'">'.$title.'</a></h2>');
								
									if($type=='audio')
									{
           								echo ('<span class="mediaIcon"><img src="images/audioIcon.png" alt="'.$type.'"></span>');
									}
									else if ($type=='image')
									{
										echo ('<span class="mediaIcon"><img src="images/imageIcon.png" alt="'.$type.'"></span>');
									}
									else if ($type=='video')
									{
										echo ('<span class="mediaIcon"><img src="images/videoIcon.png" alt="'.$type.'"></span>');
									}
																
                         			echo(' <span class="artistName"><a href="./home.php?qid='.$authorID.'">'.$author.'</a></span>
										 
                         				 	<span class="viewsIcon"><img src="images/viewsIcon.png" alt="views">'.$views.'</span>
											
                         				 	<span class="commentsIcon"><img src="images/commentsIcon.png" alt="comments">'.$comments.'</span>
											
                          				 	<span class="likesIcon"><img src="images/likesIcon.png" alt="likes">'.$likes.'</span>
											
                     			</div> <!-- closes cover boxcaption div -->
								
                    		</div> <!-- closes boxgrid caption -->
                		</li>');
					
					}//closes while results
					mysqli_close($dbc);
				}//closes if results
		//}//closes else statment
		
}//closes function populateHomeGallery

 /*This function fetches the users data from the database to populate their homepage. The $nUid is passed via a click on an <a> tag
 to the url as qid, this is just a user id to populate different homepages with the correct information*/

function homePage()
{
	//checks to see if qid has been passed via the url from clicking on a link of an author
	if (isset ($_GET['qid']))
	{
		$nUid=$_GET['qid'];
	}
	else
	{
		$nUid=$_SESSION['uid'];
	}
	
		require('./includes/mysqli_connect.php');
		$query  = "SELECT uname, email, fname, lname, bio, userThumb 
				   FROM user
				   WHERE uid='" . $nUid. "'
				   ;";
		$results = mysqli_query($dbc,$query);
 
		if($results)
		{
			while($row=mysqli_fetch_array($results)) 
			{
			$username = $row['uname'];
			$email = $row['email'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$bio = $row['bio'];
			$thumb = $row['userThumb'];
			}
		}//closes if results
		mysqli_close($dbc);	
		
		//this creates the html for the bio and the users pic to be displayed
		echo('<div id ="userInfo">

            	<img src="'.$thumb.'" width="60" height="60" alt="'.$username.'">

                <br /><br /><span class="name">'.$fname." ".$lname.'</span>
				
				<br/><br /><spann class="name">Email:'.$email.'

                <br /><br />"'.$bio.'"

                <br /><br />

                <span class="facebook"><a href=""><img src="images/facebook.png" alt="facebook"></a></span>

              	<span class="twitter"><a href=""><img src="images/twitter.png" alt="twitter"></a></span>

             	 <span class="linkedin"><a href=""><img src="images/linkedin.png" alt="linkedin"></a></span>

              	<span class="flickr"><a href=""><img src="images/flickr.png" alt="flickr"></a></span>

              	<span class="vimeo"><a href=""><img src="images/vimeo.png" alt="vimeo"></a></span>

              	<span class="soundcloud"><a href=""><img src="images/soundcloud.png" alt="soundcloud"></a></span>

              </div> <!-- closes userInfo div -->');

} //closes the function homepage
  		
		//this function populates the individual piece of work page 
function workView()
{	

	$workID= $_GET['wid']; //wid is passed through the url when a user clicks on an individual piece of work, it is used to select work from the DB
			
	require('./includes/mysqli_connect.php');
	$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.description, assets.videoID, user.userThumb, user.uid, 	 						user.uname
			   FROM assets
			   INNER JOIN user
			   ON assets.authorID=user.uid AND wid='" .$workID. "'
			   ORDER BY date DESC
			   ;";
			   
	$results = mysqli_query($dbc,$query);
 
  	if($results)
	{
		while($row=mysqli_fetch_array($results)) 
		{
			$title = $row['title'];
			$author = $row['uname'];
			$link = $row['address'];
			$type = $row['type'];
			$authorID = $row['uid'];
			$views = $row['views'];
			$likes = $row['likes'];
			$comments = $row['comments'];
			$description = $row['description'];
			$userThumb = $row['userThumb'];
			$videoID = $row['videoID'];
								
			if ($type == 'image')
			{								
				echo (' <span class="workTitle">'.$title.' <img src="images/addLike.png" alt="like" class="likeButton"/> </span>
				
				
					  
						<div id="workDisplay">
						
							<img src="'.$link.'" alt="'.$title.' width="1800" height="300"">
							<br/>
							<div id="statsArea">
							<span id="viewsCounter"><img src="../images/viewsIconDark.png" alt = "views icon">'. $views .'</span>
							<span id="commentsCounter"><img src="../images/commentsIconDark.png" alt = "comments icon">' .$comments .'</span>
							<span id="likesCounter"><img src="../images/likesIconDark.png" alt = "likes icon">' .$likes .'</span>
							</div><!-- closes statsArea div -->
							</div> <!-- closes workDisplay div -->
							
						');
			} //closes if $type == image
								
			if ($type == 'audio')
			{
				$linkAddress = $link;
				
				echo('<span class="workTitle">'.$title.' <img src="images/addLike.png" alt="like" class="likeButton"/> </span>
										 
					  <br/>
					  <br/>
					
					  <div id="workDisplay">
					  
					<script> 
					$(document).ready(function(){
						
							$("#jquery_jplayer_1").jPlayer({
								ready: function (event) {
									$(this).jPlayer("setMedia",
									 {mp3:"'.
										$link
									.'"});
								},
								swfPath: "scripts/jquery/js/Jplayer.swf",
								supplied: "mp3",
								wmode: "window"
							});
						});
						
						</script>
					  
							<div id="jquery_jplayer_1" class="jp-jplayer"></div>

							<div id="jp_container_1" class="jp-audio">
								<div class="jp-type-single">
									<div class="jp-gui jp-interface">
										<ul class="jp-controls">
											<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
											<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
											<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
											<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
											<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
											<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
										</ul>
										<div class="jp-progress">
											<div class="jp-seek-bar">
												<div class="jp-play-bar"></div>
											</div>
										</div>
										<div class="jp-volume-bar">
											<div class="jp-volume-bar-value"></div>
										</div>
										<div class="jp-time-holder">
											<div class="jp-current-time"></div>
											<div class="jp-duration"></div>
					
											<ul class="jp-toggles">
												<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
												<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
											</ul>
										</div>
									</div>
									
									<div class="jp-no-solution">
										<span>Update Required</span>
										To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
									</div>
								</div>
							</div>
							
							
							<br/>
							<div id="statsArea">
							<span id="viewsCounter"><img src="../images/viewsIconDark.png" alt = "views icon">'. $views .'</span>
							<span id="commentsCounter"><img src="../images/commentsIconDark.png" alt = "comments icon">' .$comments .'</span>
							<span id="likesCounter"><img src="../images/likesIconDark.png" alt = "likes icon">' .$likes .'</span>
							</div><!-- closes statsArea div -->
							
							</div> <!-- closes workDisplay div -->
						');	
			}//closes if $type == audio
			
			if ($type == 'video')
			{
				$linkAddress = $videoID;
				
				echo('<span class="workTitle">'.$title.' <img src="images/addLike.png" alt="like" class="likeButton"/> </span>
										 
					  <br/>
					  <br/>
					
					  <div id="workDisplay">
					  
					 
					  
					  
						<iframe src="http://player.vimeo.com/video/'. $linkAddress .'?title=0&amp;byline=0&amp;portrait=0&amp;color=cfcccc" width="500" height="370" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						
		
							<br/>
							<div id="statsArea">
							<span id="viewsCounter"><img src="../images/viewsIconDark.png" alt = "views icon">'. $views .'</span>
							<span id="commentsCounter"><img src="../images/commentsIconDark.png" alt = "comments icon">' .$comments .'</span>
							<span id="likesCounter"><img src="../images/likesIconDark.png" alt = "likes icon">' .$likes .'</span>
							</div><!-- closes statsArea div -->
							
							</div> <!-- closes workDisplay div -->
						');	
			}//closes if $type == video
			
			//will need to add if $type == video here at some point
									  
			
			
			if (isset($_SESSION['uid']))
			{
				
				$query="SELECT * FROM likes WHERE uid='". $_SESSION['uid'] ."' AND wid='". $workID ."';";
				$results = mysqli_query($dbc,$query);
				
				if($row=mysqli_fetch_array($results)) 
				{
					 //do nothing
				}
			else 
				{
					echo (' 
						  
						  <form method="post" action="" class="likeForm">
							  
									<input type="hidden"  name="uid"  value="'.$_SESSION['uid'] .'" />
									<input type="hidden" name="wid" value="'. $workID .'"/>
							</form>		
									
				   
				  
				   ');
				}
			}
			
			echo('<div id ="userInfo">
				 
            		<img src="'.$userThumb.'" width="60" height="60" alt="profileThumb">
					
                	<br /><br />
					<span class="name">'.$title.'</span>
                	<br /><br />
					<span class="name">By <a href="./home.php?qid='.$authorID.'">'.$author.'</a></span>
                	<br />
					<br /><span class="bio">'.$description.'</span>
                	<br />
					<br />
				</div> <!-- closes userInfo div -->');
			
		}//closes while results loop
		mysqli_close($dbc);
	}//closes if results
			
}//closes function work view

//this function handles the comments below the piece of work
function commentView()
{
	$workID= $_GET['wid']; //work id is passed via the url from clicking on the thumbnail of the work
			
	require('./includes/mysqli_connect.php');
	$query  = "SELECT comments.comment, comments.date, user.uid, user.uname, user.userThumb
			   FROM comments
			   INNER JOIN user 
			   ON comments.authorID=user.uid
			   WHERE comments.wid='". $workID . "'
			   ORDER BY date DESC
			   ;";

$results = mysqli_query($dbc,$query);
 
  	if($results)
	{
		while($row=mysqli_fetch_array($results)) 
		{
			$comment = $row['comment'];
			$date = $row['date'];
			$author = $row['uname'];
			$userThumb = $row['userThumb'];
			$authorID = $row['uid'];
					
			echo (' <div id="CommentWrapper">
				  
            			<hr>
						
             				<div id ="showComment">
             	
            					<img src="'.$userThumb.'" width="60" height="60" alt="profileThumb"/>
								
                				<span class="CommentName"><a href="./home.php?qid='.$authorID.'">'.$author.'</a></span>
					
                				<br />
								<br />'.$comment.'
								<br />
								<br />
								<span class="CommentName" id="CommentDate">Posted on'.' '.$date.'</span>
                	
							</div> <!-- closes showComment div -->
            		</div> <!-- closes CommentWrapper div -->');
		}//closes while results loop
		mysqli_close($dbc);
	}//closes if results
			
}//closes commentView function

//this function handles the edit homepage functionality
function editGallery()
{
	$uid=$_SESSION['uid']; //the session userID should be set upon login
	
	require('./includes/mysqli_connect.php');
	$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, assets.description, assets.wid,      					user.uname, user.uid 
			   FROM assets
			   INNER JOIN user
			   ON assets.authorID=user.uid
			   WHERE authorID='" .$uid. "
			   ORDER BY date DESC
			   ';";
			   
	$results = mysqli_query($dbc,$query);
	 
	if($results)
	{
		while($row=mysqli_fetch_array($results)) 
		{
			$title = $row['title'];
			$author = $row['uname'];
			$link = $row['address'];
			$type = $row['type'];
			$authorID = $row['uid'];
			$views = $row['views'];
			$likes = $row['likes'];
			$comments = $row['comments'];
			$workID = $row['wid'];
			$description = $row['description'];
			
			//creates the html to create the gallery with input boxes and edit/delete icons
			echo(' <li>
                    	<div class="boxgrid">');
						
                      	if ($type=='image')
							{
							
                      			echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="'.$title.'"></a>');
							}
							else if ($type=='audio')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="images/audio.png"width="180" height="100" alt="'.$title.'"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="'.$title.'"></a>');
							}
							
                      	echo ('<div class="cover boxcaption">
						
                      	  <span class="deleteIcon"><img src="images/delete.png" alt="audio"></span>
						  
                          <span class="editIcon" id="editIconBut">
						  
						  		<img src="images/edit.png" alt="audio">
							
						  </span> <!-- closes editIco span -->
						
						  <span class="editFormHolder">
						  
                          		<span class="worktitle"><h2>'.$title.'</h2></span>
								
                          		<span class="description">'.$description.'</span>
								
						  </span> <!-- closes editFormHolder -->
						  
						  <form method="post" action="" class="userEditForm" id="myEditForm">
						  
                          		<input type="text"  name="title" id="WorkTitle" value="'.$title.'" />
								
                          		<textarea  name="description">'.$description.'</textarea>
								
						  		<input type="hidden" name="wid" value="'.$workID.'"/>
								
						  		<input type="hidden" name="uid" value="'.$authorID.'"/>
								
                        		<div class="tickHolder"> 
								
									<img src="images/ok.png" class="SubmitEditForm"/>
									
								</div> <!-- closes tickHolder div -->
                        	</form>');
								
							if($type=='audio')
							{
								echo ('<span class="mediaIcon"><img src="images/audioIcon.png" alt="'.$type.'"></span>');
							}
							else if ($type=='image')
							{
								echo ('<span class="mediaIcon"><img src="images/imageIcon.png" alt="'.$type.'"></span>');
							}
							else if ($type=='video')
							{
								echo ('<span class="mediaIcon"><img src="images/videoIcon.png" alt="'.$type.'"></span>');
							}
						echo('</div> <!-- closes cover boxcaption div -->
							 
                   </div> <!-- closes boxgrid div -->
               </li>');			
			}//closes while results loop
			mysqli_close($dbc);
			
	}//closes if results
			
}//closes function editGallery


//this function creates the edit bio pane functionality
function edithomePage()
{	
	//checks the user is logged in, should not be able to view this page without being logged in
	if (isset ($_SESSION['uid']))
	{
		$nUid=$_SESSION['uid'];
	
		require('./includes/mysqli_connect.php');
		$query  = "SELECT user.uname, user.email, user.fname, user.lname, user.bio, user.userThumb, user.uid 
				   FROM user
				   WHERE uid='" .$nUid. "'
				   ;";
				   
		$results = mysqli_query($dbc,$query);
 
  		if($results)
		{
			while($row=mysqli_fetch_array($results)) 
			{
			  $username = $row['uname'];
			  $email = $row['email'];
			  $fname = $row['fname'];
			  $lname = $row['lname'];
			  $bio = $row['bio'];
			  $thumb = $row['userThumb'];
			  $uid = $row['uid'];
			}
		}
		
		mysqli_close($dbc);
		
		echo('<div id ="userInfo">
			 
			 	<span class="profileEditIcon" id="userEditIcon"> <img src="images/edit.png" alt="audio"> </span>
				
				<span class="profileEditIcon" id="userEditTick"> <img src="images/ok.png" class="SubmitUserEditForm"/> </span>

            	<img src="'.$thumb.'" width="60" height="60" alt="'.$username.'"/>																																			 																																												 				<a class="editAvatar" href="#"><img src="images/edit.png" alt="edit avatar"/></a>

                <br />
				<span class="name">'.$fname." ".$lname.'</span>
				
				<br/>
				<span id="userDetailsUpdate">
				
					<span class="userMail">'.$email.'</span>

                	<br />
					<br />
					<span class="bio">"'.$bio.'"</span>
					
				</span> <!-- closes userDetailsUpdate div -->
				
				<form method="post" action="" id="userEditForm">
				
                	<input type="text"  name="email" id="newEmail" value="'.$email.'" />
					
					<span>
                    	<textarea  name="bio" id="bio">'.$bio.'</textarea>
					</span>
								
					<input type="hidden" name="uid" value="'.$uid.'"/>
                        		
                </form>

                <br />
				<br />
				<span class="facebook"><a href=""><img src="images/facebook.png" alt="facebook"></a></span>

             	<span class="twitter"><a href=""><img src="images/twitter.png" alt="twitter"></a></span>

              	<span class="linkedin"><a href=""><img src="images/linkedin.png" alt="linkedin"></a></span>

             	<span class="flickr"><a href=""><img src="images/flickr.png" alt="flickr"></a></span>

              	<span class="vimeo"><a href=""><img src="images/vimeo.png" alt="vimeo"></a></span>

              	<span class="soundcloud"><a href=""><img src="images/soundcloud.png" alt="soundcloud"></a></span>
				
			</div> <!-- closes userInfo div -->');
	
	}//closes isset $_SESSION['uid']
		
}//closes function editHomePage
	
?>