<div class="galleryOptions">
            
        <span class="showTitle">Show</span>
        <span class="filterTitle">Filter by</span>
                
        <ul class="showNav">
 			<li><a id="allBut" href="#">All</a></li>
  			<li><a id="imgBut" href="#">Images</a> </li>
 			<li><a id="videoBut" href="#">Video</a></li>
  			<li><a id="audioBut" href="#">Audio</a></li>
		</ul>
                                
		<ul class="filterNav">
 			<li><a id="dateBut" href="#">Date</a></li>
  			<li><a id="viewsBut" href="#">Views</a> </li>
 			<li><a id="likesBut" href="#">Likes</a></li>
  			<li><a id="commentsBut" href="#">Comments</a></li>
		</ul>
                
</div> <!--close gallery options div -->
            
<ul class="grid">
							
		<?php
		
			if (isset ($_GET['qid']))
			{
				//populates the gallery using the qid passed via the url
				echo populateHomeGallery();
			}
			else
			{
				//populates the gallery with all users work
				echo populateGallery();
			}
		?>
</ul>

				
			
			
			
		
		
    