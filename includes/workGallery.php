<?php
		echo uniqueViews();
		
		echo workView();
		
		$workID=$_GET['wid'];
			 
            
            if (isset($_SESSION['loggedIn']) == true)
		{

            echo ('<div id="enterComment">
            
            <form method="post" action="" id="myCommentForm">
                          
                          <div id="commentField">
                                                           
                              <textarea  name="comment" id="comment" ></textarea>
                              
                          </div>
                  
                          <input class="CommentSubmit" type="button" value="Submit Comment" name="Comment-Submit" />
						  
						  <input type="hidden" value="' . $workID . '" name="workID"/>
          	</form>
            
            
            </div>');
		}
		else
		{
			echo ('<br/><br/>
				  <div id="loginToComment"> Please Register or Login to leave a comment.</div>');
		}
		echo ('<div class="commentsHolder">');
		
		echo commentView();
		
		echo ('</div>'); 
			?>
            
            
          
            
          
            
			
</div><!--end div wrapper-->


</body>
</html>