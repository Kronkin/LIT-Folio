<?php

session_start();

require_once('../includes/mysqli_connect.php');

$workID = $_POST['workID'];
$comment = $_POST['comment'];
$authorID = $_SESSION['uid'];
$userName = $_SESSION['username'];
$date = date(DATE_RSS);

$query="insert into comments (wid, comment, authorID, date) values('" . $workID . "','" . $comment . "','". $authorID . "','" . $date . "');";

mysqli_query($dbc,$query);

$query="SELECT comments FROM assets WHERE wid='". $workID ."';";

$results = mysqli_query($dbc,$query);

if ($results)
{
	while($row=mysqli_fetch_array($results)) 
			{
				$comments = $row['comments'];
			}
			
			$comments++;
	
	$query="UPDATE assets SET comments='". $comments . "'WHERE wid='". $workID ."';";
	
	$results = mysqli_query($dbc,$query);
}

$query="SELECT userThumb FROM user WHERE uid='". $authorID ."';";

$results = mysqli_query($dbc,$query);

if ($results)
{
	while($row=mysqli_fetch_array($results)) 
			{
				$thumb = $row['userThumb'];
			}
}


$html = ' <div id="CommentWrapper">
				  
            			<hr>
						
             				<div id ="showComment">
             	
            					<img src="'. $thumb .'" width="60" height="60" alt="profileThumb"/>
								
                				<span class="CommentName"><a href="./home.php?qid='.$authorID.'">'.$userName.'</a></span>
					
                				<br />
								<br />'.$comment.'
								<br />
								<br />
								<span class="CommentName" id="CommentDate">Posted on'.' '.$date.'</span>
                	
							</div> <!-- closes showComment div -->
            		</div> <!-- closes CommentWrapper div -->';
					
					print $html;
?>