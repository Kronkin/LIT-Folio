<?php

session_start();

//checks if the $_SESSION['page'] var. The var is set in the newIndex.php or home.php files 
if ($_SESSION['page']=='index')
{
		//q and t are sent from the file "main.js" via the ajax query. They are sent through the URL as varibles, t and q. (t) relates to the type of asset 		 			video/image/audio or blank = all types, this is(t).  (q) relates to the filter by comment/likes/view/date this is (q).														 			$t depending on its value is then set to a string that will	be sent in the database query, (q) has a default of date but because it is not complex 			and does not contain quotes, it does not need to be reCast to a complex string.
		
	 $q=$_GET["q"];
	 $t=$_GET["t"];
	
	 if ($t=='audio')
	 {
		$t="AND assets.type='audio'";
	 }
	 else if ($t=='video')
	 {
		$t="AND assets.type='video'";	
	 }
	 else if ($t=='image')
	 {
		$t="AND assets.type='image'";
	 }
	 
	 
	 require('../includes/mysqli_connect.php');

 //echo('<div class="boxgrid caption"><li><h2>1st script'.$q.$t.'</h2></li></div>');		//this line is for debugging

	 $query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, assets.videoID, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid  ". $t ."
				   ORDER BY ".$q." DESC
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
			$videoID = $row['videoID'];
			
			
			echo(' <li class="'.$type.'">
					 
                   			<div class="boxgrid caption">');
							
							if ($type=='image')
							{
							
                      			echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
							else if ($type=='audio')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="../images/audio.png"width="180" height="100" alt="test"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
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
										
						</div> <!-- closes cover boxcaption -->
						
                    </div> <!-- closes boxgrid caption -->
                </li>');
														
			} //closes while results loop
						 
				mysqli_close($dbc);
		}//closes if results loop
			
		else
		{
			echo('No results? Var $q=' .$q);  //this is for debugging
		}
}//closes if session page == index

//if we visit a homepage by clicking on a link we use this script, the QID is passed via the URL, QID is a var attatched to the <a> tag of the previous page it enables us to select the users by userID assets from the database

else if ($_SESSION['page']=='home')
{
	$q=$_GET["q"]; //the filter, comments/likes/views/date
	$t=$_GET["t"]; //the type video/audio/image/all

	if ($t=='audio')
	 {
		$t="AND assets.type='audio'";
	 }
	 else if ($t=='video')
	 {
		$t="AND assets.type='video'";	
	 }
	 else if ($t=='image')
	 {
		$t="AND assets.type='image'";
	 }
	
	//the session var qid is set on the home.php file, it gets the qid var from the URL  and puts it in the session varible for use on this next query
	$uid=$_SESSION['qid'];
		
	//this just says if a type button has been clicked and there is a type selected e.g. audio/video/image/all	
	if ($t!='')
	{
		//echo('<div class="boxgrid caption"><li><h2>2nd script'.$q.$t.'</h2></li></div>');//this is for debugging
				
		require('../includes/mysqli_connect.php');	
		$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, assets.videoID, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid 
				   WHERE user.uid=".$uid." ". $t ."
				   ORDER BY " .$q . " DESC
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
				$videoID = $row['videoID'];
											
				echo(' <li class="'.$type.'">
					 
                   			<div class="boxgrid caption">');
							
							if ($type=='image')
							{
							
                      			echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
							else if ($type=='audio')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="../images/audio.png"width="180" height="100" alt="test"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
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
												
								</div> <!-- closes cover boxcaption -->
								
                    		</div> <!-- closes boxgrid caption -->
                		</li>');			
					} //closes while results loop
					mysqli_close($dbc);
				} //closes if results
					
			}  //closes if $t is not blank
			
			//this else checks if not type has been clicked on, this means the user could hit order by date/comments/likes/views before hitting type
			else if($t=='')
			{
				//echo('<div class="boxgrid caption"><li><h2>3rd script'.$q.$t.'</h2></li></div>'); //this is for debugging
				
				require('../includes/mysqli_connect.php');
				$query  = "SELECT assets.title, assets.address, assets.type, assets.views, assets.likes, assets.comments, assets.wid, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid 
				   WHERE user.uid=".$uid." 
				   ORDER BY " .$q . " DESC
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
								echo ('<a href="./work.php?wid='.$workID.'"><img src="../images/audio.png"width="180" height="100" alt="test"></a>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
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
													
										 </div> <!-- closes cover boxcaption -->
										 
									</div> <!-- closes boxgrid caption -->
								</li>');			
						} //closes while results loop
						
						mysqli_close($dbc);
					} //colses if results
								
				} //closes else if $t is empty string
				
} //closes if page == home

//if editHomePage is clicked it is only by a user, so session UID exists and we can use this when we query the DB. The session var should be set in edit.php

else if ($_SESSION['page']=='editHomePage')
{
			$q=$_GET["q"];
			$t=$_GET["t"];

			if ($t=='audio')
			 {
				$t="AND assets.type='audio'";
			 }
			 else if ($t=='video')
			 {
				$t="AND assets.type='video'";	
			 }
			 else if ($t=='image')
			 {
				$t="AND assets.type='image'";
			 }
			
			$uid=$_SESSION['uid'];  //uid is passed via the URL, it is attatched to any link that relates to an author, it is then passed to the DB query.
			
			//if a type of media audio/video/image/all has been selected
			if ($t!='')
			{
				//echo('<div class="boxgrid caption"><li><h2>2nd script'.$q.$t.'</h2></li></div>'); //this is for debugging
				
			require('../includes/mysqli_connect.php');	
			$query  = "SELECT assets.title, assets.address, assets.type, assets.wid, assets.description, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid 
				   WHERE user.uid=".$uid." ". $t ."
				   ORDER BY " .$q . " DESC
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
					$workID = $row['wid'];
					$description = $row['description'];
											
					echo('<li>
                    		<div class="boxgrid">');
							
							if ($type=='image')
							{
                      			echo('<img src="'.$link.'" width="325" height="260" alt="image"/>');
							}
							else if ($type=='audio')
							{
								echo('<img src"../images/audio.png" width="180" height="100" alt="audio"/>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
                      			echo('<div class="cover boxcaption">
						
                      	 		 	<span class="deleteIcon"><img src="images/delete.png" alt="audio"></span>
						  
                          			<span class="editIcon" id="editIconBut">
						  
						  				<img src="images/edit.png" alt="audio">
							
						  			</span> <!-- closes editIco span -->
						
						  			<span class="editFormHolder">
						  
                          				<span class="worktitle"><h2>'.$title.'</h2></span>
								
                          				<span class="description">'.$description.'</span>
								
						  			</span> <!-- closes editFormHolder -->
						  
									<form method="post" action="" class="workEditForm" id="myEditForm">
								  
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
									 
                    		</div> <!-- closes boxgrid caption div -->
                		</li>');			
					}//closes while results 
					mysqli_close($dbc);
				}//closes if results
					
			}  //closes if $t is not blank
			
			//if type has not been selected and order by date/comments/views/likes is pressed
			else if ($t=='')
			{
				//echo('<div class="boxgrid caption"><li><h2>2nd script'.$q.$t.'</h2></li></div>'); //debugging
				
			require('../includes/mysqli_connect.php');	
			$query  = "SELECT assets.title, assets.address, assets.type, assets.description, assets.wid, user.uname, user.uid
				   FROM assets
				   INNER JOIN user
				   ON assets.authorID=user.uid 
				   WHERE user.uid=".$uid." 
				   ORDER BY " .$q . " DESC
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
					$workID = $row['wid'];
					$description = $row['description'];
											
					echo('<li>
                    		<div class="boxgrid">');
							
							if ($type=='image')
							{
                      			echo('<img src="'.$link.'" width="325" height="260" alt="image"/>');
							}
							else if ($type=='audio')
							{
								echo('<img src"../images/audio.png" width="180" height="100" alt="audio"/>');
							}
							else if ($type=='video')
							{
								echo ('<a href="./work.php?wid='.$workID.'"><img src="'.$link.'"width="325" height="260" alt="test"></a>');
							}
                      			echo('<div class="cover boxcaption">
						
                      	 		 	<span class="deleteIcon"><img src="images/delete.png" alt="audio"></span>
						  
                          			<span class="editIcon" id="editIconBut">
						  
						  				<img src="images/edit.png" alt="audio">
							
						  			</span> <!-- closes editIco span -->
						
						  			<span class="editFormHolder">
						  
                          				<span class="worktitle"><h2>'.$title.'</h2></span>
								
                          				<span class="description">'.$description.'</span>
								
						  			</span> <!-- closes editFormHolder -->
						  
						 			<form method="post" action="" class="workEditForm" id="myEditForm">
						  
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
									 
                    		</div> <!-- closes boxgrid caption div -->
                		</li>');			
					}//closes while results 
					mysqli_close($dbc);
				}//closes if results
					
			}  //closes if $t is not blank		
				
} //closes if page == editHomePage

?>