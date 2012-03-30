<!-- this creates the gallery and the options to order and filter it on the edit home page -->

<div class="galleryOptions">
            
        <span class="showTitle">Show</span>
        <span class="filterTitle">Filter by</span>
                
        <ul class="showNav">
 			<li><a id="allButEdit" href="#">All</a></li>
  			<li><a id="imgButEdit" href="#">Images</a> </li>
 			<li><a id="videoButEdit" href="#">Video</a></li>
  			<li><a id="audioButEdit" href="#">Audio</a></li>
		</ul>
                                
		<ul class="filterNav">
 			<li><a id="dateButEdit" href="#">Date</a></li>
  			<li><a id="viewsButEdit" href="#">Views</a> </li>
 			<li><a id="likesButEdit" href="#">Likes</a></li>
  			<li><a id="commentsButEdit" href="#">Comments</a></li>
		</ul>
                
</div> <!--close gallery options div -->
            
<ul class="grid">
							
		<?php
		
			//this function creates the gallery of the users work with editabilty functionality
			echo editGallery();
		?>
</ul>