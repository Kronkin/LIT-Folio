<?php

session_start();
	
	require('../includes/mysqli_connect.php');
	
		$query  = "SELECT * FROM vimeo WHERE uid='".$_SESSION['uid']."';";
		$results = mysqli_query($dbc,$query);
		
		if($results)
		{
			while($row=mysqli_fetch_array($results))
			{
				$_SESSION['token'] = $row['token'];
				$_SESSION['secret'] = $row['secret'];
			}
			
			mysqli_close($dbc);
		}
		
		include ('../scripts/vimeo.php');
		
		$vimeo = new phpVimeo('3', '1', $_SESSION['token'] , $_SESSION['secret']);

    	$video_tags = $vimeo->call('vimeo.videos.getUploaded');

			if ($video_tags) 
			{
				foreach ($video_tags -> videos -> video  as $node)
				{
						$vidID = $node -> id;
						$title = $node -> title;
						
						$video_thumbnails = $vimeo->call('videos.getThumbnailUrls', array('video_id' => $vidID )); 
						
						$x=$video_thumbnails -> thumbnails -> thumbnail[0];
						
						$thumb = $x -> _content;
						
					require('../includes/mysqli_connect.php');
	
					
					 $query="insert into assets (address, title, type, authorID, description, videoID)
			  
					  values('". $thumb ."', '".$title."', 'video', ".$_SESSION['uid'].", 'This is a video by ".$_SESSION['username']."', ".$vidID.")";
			  
					 $results = mysqli_query($dbc,$query);
					 
					 mysqli_close($dbc);
					 
				}
			}//closes if video tags
	  

		header("Location: ../index.php");
	
?>