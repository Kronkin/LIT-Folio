// JavaScript Document


//coverSlides() makes the cover slide up over the thumbnails when the mouse is hovered over them to display the views/coments/likes
function coverSlides() {


						   
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'60px'},{queue:false,duration:160});
				}, function() {
					$(".cover", this).stop().animate({top:'118px'},{queue:false,duration:160});
				});
						  };
						  
function error() {
	
				$('.panel').append('<div>Error!</div>');
				};


$(document).ready(function(){
						   
						   var type='';   //to hold the type of asset selected
						   var order="date";  //to hold how the user wants the gallery filtered by
						   var speed=1200;  // speed of the fade
						   var string="debug";  //debug varible
						   
						   
     						coverSlides();
							
							

							
							
							
							//this handles updating the comments made
							$("body").click(function(event){
													   if ($(event.target).is(".CommentSubmit"))
															{
																var commentsForm = $("#myCommentForm").serialize();
																$("#commentField").html('<textarea  name="comment" id="comment" ></textarea>');
																
																$.ajax({
																	   	url: "./processesScripts/processComments.php",
																		type: "post",
																		data: commentsForm,
																		success: function(comment)
																		{
																			$(".commentsHolder").prepend(comment);
																		}
																	});
																
															}
													 });
							
							//this updates the likes on a piece of work and hides the like icon from the user
							$(".likeButton").click(function(){
												  	
													
														var likeForm=$(".likeForm").serialize();
														
														$.ajax({
															   		url: "./processesScripts/processLike.php",
																	type: "post",
																	data: likeForm,
																	success: function(likeCount)
																	{
																		$("#likesCounter").html(likeCount);
																		$(".likeButton").hide();
																	}
															   });
												  });
	 
	 						$ ("form#userEditForm").hide();  //hides the form that users can edit their thumbnails on
							$ ("#userEditTick").hide();   //hides the green tick on those forms
				
							//if the user clicks on the edit icon in bio panel on edit homepage
							$ ("#userEditIcon").click(function(){
																	$(this).hide();
																	$("#userEditTick").show();
																	$(".userMail, .bio").hide();
																	$("#userEditForm").show();
															   });
							//if the user clicks on the tick in the bio pane to ok new details
							$("#userEditTick").click(function(){
																	$(this).hide();
																	$("#userEditForm").hide();
																	$(".userMail, .bio").show();
																	$("#userEditIcon").show();
																	
																	var userForm=$("#userEditForm").serialize();
														
																	$.ajax({
																				url: "./processesScripts/processUserUpdate.php",
																				type: "post",
																				data: userForm,
																				success: function(userUpdate)
																				{
																					$("#userDetailsUpdate").html(userUpdate);
																				}
																		   });//closes ajax call
															  });//closes userEditTick function
						   
							$ ("form#myEditForm").hide();
				
							//this code determines what to do when editicon is clicked on users galleries, in the editHomePage
							//it hides or shows the relevant edit title description of the piece of work
							$ ("body").click(function(event){
				
														if ($(event.target).is("#editIconBut img")){
																								$ ("form#myEditForm").hide();
																								if ($(".editFormHolder, .editIcon").is(":hidden"))
																								{
																									$(".editFormHolder, .editIcon").show();
																								}
																								$ (event.target).parent().next(".editFormHolder").hide();
																								$ (event.target).hide();
																								$ (event.target).parent().nextAll("#myEditForm").show();
																			$ (event.target).parent().nextAll("myEditForm").children(".tickHolder").show();
																							}//closes if target is editicon
														});//closes body.click function
								
								//this is the function that handles updating the users gallery Title and description
							//when the SubmitEdit form is clicked the edit form is submitted
							$ ("body").click(function(event){
																if ($ (event.target).is(".SubmitEditForm"))
																{
				
																	$ ("form#myEditForm").hide();
																	$ (".editIcon img").show();
																	$ (".editFormHolder").show();
																	var editForm=$(event.target).parents().eq(1).serialize();
																	var newCover=$(event.target).parents().eq(1).prev(".editFormHolder");
																	
																 	$.ajax({
																			
																			url: "./processesScripts/processEdit.php",
																			type: "post",
																			data: editForm,
																			success: function(update)
																			{
																				$ (newCover).html(update);
																				
																			},
																			error: function(xmlhttp) 
																			{
																				$(event.target).next(".editFormHolder").html(xmlhttp.status);
																			}
																  	});//closes the AJAX call
																}//closes if target is
																
													 		});//closes the function submitEditForm
		
        						
								//this hides the user menu under myfolio+ tab
							$(".trigger").click(function(){
															$(".panel").toggle("fast");
															$("a.trigger").css({"background-color":"black","opacity":".90","filter":"alpha(opacity=90)","color":"#EAE9E8"});
															return false;
														});
						
								
								
								//this loads the registration form
							$ (".heading").click(function(){
												  
														
															$ ('html').prepend('<div class="grey-out"></div>')
																
														  	$ ('.header').append('<div id ="register-wrapper"><span id="deleteUploadWindow"> <img src="./images/delete.png" alt="delete"/></span><div class ="logo"><a href="newIndex.php"> <img src="images/logo.png" name="Image2" width="112" height="112" border="0"></a></div><p class="heading"><strong>Enter information below to register</strong></p><form method="post" action="processesScripts/processRegistration.php" id="myRegistrationForm"><div><label for="firstname">First Name</label><input type="text" size="47" name="fname" value="" class="required" /></div><div><label for="lastname"> Last Name</label><input type="text" size="47" name="lname" id="lname" value="" class="required" /></div><div><label for="email">Email</label><input type="text" size="47" name="email" id="email" value="" class="required email" /></div><div><label for="username">Username</label><input type="text" size="47" name="uname" id="uname" value="" class="required" /></div><div><label for="password">Password</label><input type="text" size="47" name="pwd" id="pwd" value="" class="required" /></div><input class="submitRegister" type="submit" value="Register" name="submit" /></form> <br/></div>');
																
														   $ ("#myRegistrationForm").validate({
																								debug: false,
																								rules: 
																									{
																										fname: "required",
																										lname: "required",
																										email: "required",
																									uname: "required",
																									pwd: "required",
																									}
														   		});//closes the validate function
															//closes if the event target is = to .heading
														});//closes body click function 
						
						
						
						//this loads the upload form for users to upload work
						$ ('body').click(function(event){													   
															if ($(event.target).is('#uploadButton'))
															{
														   
														   	$ ('html').prepend('<div class="grey-out"></div>');
															
															$ ('.header').append('<div class="form" id="upload-wrapper">													 																																													 																		<span id="deleteUploadWindow"> <img src="./images/delete.png" alt="delete"/></span>																								 																																																				 											<form id="uploadForm" enctype="multipart/form-data"action="./processesScripts/processUpload.php" method="POST"> 															 																																																		 																	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />						 																																								 																																													 																	<div class="uploadFormHead">Upload Audio or Images</div>			 																																													 																																									 																	<div id="fileUpContainer">																										 																																														 																		<span class="singleUpHolder">																	 																																										 																			<div id="sendFile">																			 																																								 																				<input class="upload-choose" name="mkfile" type="file" />																			 																							 																				 																			</div>																																 																																															 																			<span class="reduce-uploadDetails">				 																																												 																																							 		 																				<div class="uploadTitle">Title					 												 																																																 																					<input type="text" class="upTitle" name="title" value=""/>												 																																														 																				</div>				 																																																									 																																												 																				<div class="uploadDescription">Add a Description																				 																																																		 																					<textarea name="uploadDescription" class="txtDes"></textarea>																	 																																														 																																			 																																										 																				</div>																																						 																																																			 																			</span> <!-- closes span reduce-uploadDetails -->																			 																																																						 																		</span> <!-- closes singleUpHolder -->																									 																																													 																	</div> <!-- closes div fileUpContainer -->																																		 																															 																						 																	<div id="inputUpload"> <input type="submit" value="Upload" />																				 																																									 																	</div> 																	 																																																				 											</form>																					 																																												 										</div>');//closes div class form, id upload-wrapper
										
										//the next part of code hides the upload form fields and makes them appear when the user enters details into the previous field
							$ (".uploadTitle").hide();
							$ (".uploadDescription").hide();
							$ ("#inputUpload").hide();
							
							$ ("body").on("change", ".upload-choose", function(event)
																 {
																	 $ (event.target).parent().next().children(".uploadTitle").show();
																 });
							
							$ ("body").on("keypress", ".upTitle", function(event)
														   {
															   if ($(event.target).parent().next().is(":hidden"))
															   {
															   $ (event.target).parent().next().show();
															   }
														   });
							
							$ ("body").on("keypress", ".txtDes", function(event)
														  {
															  if ($(event.target).parents("#uploadForm").children("#inputUpload").is(":hidden"))
														  	{
															  $ (event.target).parents("#uploadForm").children("#inputUpload").fadeIn();
															  }
														  });
							
														};//closes if event target is uploadButton
											 
												});//closes function body .click
												
												
												//this code loads the form to upload a new avatar for the user
													 $ ("body").on("click", ".editAvatar", function()
																			{
																 			
																			$ ('html').prepend('<div class="grey-out"></div>');
																			
																 			$(".header").append('																 																																														 									<form id="uploadAvatar" enctype="multipart/form-data"action="./processesScripts/processAvatarUpload.php" method="POST"> 															 																																																		 																	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />						 																																								 																																				 																																													 																																									 																	<div id="fileUpContainer">	Upload your new avatar:																									 																																									 																																										 																			<div id="sendFile">																			 																																								 																				<input class="upload-choose" name="mkfile" type="file" />																			 																							 																				 																			</div>																																 																																															 																			<input type="hidden" value="avatar" name="avatar"/>																																		 																																													 																	</div> <!-- closes div fileUpContainer -->																																		 																															 																						 																	<div id="inputUpload"> <input type="submit" value="Upload!" />																				 																																									 																	</div></form>');
													
																			});//closes body.click function relating to event target .uploadProgress a
						
						
						
						//this enables the user to click on the grey background or delete icons and remove register forms or upload forms
						$("html").on("click", ".grey-out, #deleteUploadWindow, #deleteRegisterWindow", function(event)
													  		{
																$(".grey-out, #register-wrapper, #upload-wrapper, #uploadAvatar").remove(); 
															});
						
						
						
															
								//orders the gallery by views
							$ ("#viewsBut").click(function(){
													     	 order='views';
														  	if ($(".filterNav li a").hasClass('filterNavPressed'))
															{
														 		$(".filterNav li a").removeClass('filterNavPressed');
													 		}
												   
													 		$(this).addClass("filterNavPressed");
														  
													        $.ajax({
																			
																	  url: "scripts/filterQuery.php",
																	  type: "GET",
																	  data: "q="+order+"&t="+type,
																	  success: function(data)
																	  {
																		$(".grid").fadeOut(speed, function(){
																											$(".grid").html(data);
																											$(".grid").fadeIn(speed, function()
																																				{
																																				coverSlides();
																																	})//closes fadeIn function
																	  										})//closes fadeOut function
																	   },//closes on success function
																	   error: function(xmlhttp) 
																	   {
																			$(".grid").html(xmlhttp.status);
																	   }
															 });//closes AJAX call
															
																	
													   });//closes function on viewsBut click
						
						//orders the galery by likes
						$ ("#likesBut").click(function(){
													   	  order='likes';
														  if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").fadeOut(speed, function(){
																											$(".grid").html(data);
																											$(".grid").fadeIn(speed, function(){
																															coverSlides();
																												   			})
																											})
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														   
														   
													   });//closes likesBut click
						
						//orders the gallery by comments
						$ ("#commentsBut").click(function(){
														     order='comments';
															 if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").fadeOut(speed, function(){
																											$(".grid").html(data);
																											$(".grid").fadeIn(speed, function(){
																															coverSlides();
																												   			})
																											})
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														    
														  
													   });//closes commentsBut click
						//orders the gallery by date
						$ ("#dateBut").click(function(){
													      order='date';
														  if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").fadeOut(speed, function(){
																											$(".grid").html(data);
																											$(".grid").fadeIn(speed, function(){
																															coverSlides();
																												   			})
																											})
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														   
															
													   });//closes dateBut click
						
						
						//shows all work audio/video and images
						$ ("#allBut").click(function(){ 
													 	type='';
														
															if ($(".showNav li a").hasClass('showNavPressed'))
															 {
																 $(".showNav li a").removeClass('showNavPressed');
															 }
												   
													 	$(this).addClass("showNavPressed");
													 
												 		 $.ajax({
																	  url: "scripts/filterQuery.php",
																	  type: "GET",
																	  data: "q="+order+"&t="+type,
																	  success: function(data)
																	  {
																		  $(".grid").fadeOut(speed, function(){
																									  $(".grid").html(data);
																									  $(".grid").fadeIn(speed, function(){
																													  coverSlides();
																													  })
																									  })
																	  },
																	  error: function(xmlhttp) 
																	  {
																		  $(".grid").html(xmlhttp.status);
																	  }
																  });//closes AJAX call
												  
													 
												   });//closes allBut click function
						
						//filters gallery by audio
						$ ("#audioBut").click(function(){ 
														   type="audio";
														   
														  if ($(".showNav li a").hasClass('showNavPressed'))
														 {
															 $(".showNav li a").removeClass('showNavPressed');
														 }
													   
														 $(this).addClass("showNavPressed");
														 
														  $.ajax({
																		url: "scripts/filterQuery.php",
																		type: "GET",
																		data: "q="+order+"&t="+type,
																		success: function(data)
																		{
																			$(".grid").fadeOut(speed, function(){
																										$(".grid").html(data);
																										$(".grid").fadeIn(speed, function(){
																														coverSlides();
																														})
																										})
																		},
																		error: function(xmlhttp) 
																		{
																			$(".grid").html(xmlhttp.status);
																		}
																  });//closes AJAX call
														  
													   
													   });//closes audioBut click function
						//filters gallery by video
						$ ("#videoBut").click(function(){
														   type='video';
														   if ($(".showNav li a").hasClass('showNavPressed'))
															{
																$(".showNav li a").removeClass('showNavPressed');
															}
													   
														 	$(this).addClass("showNavPressed");
														 
															 $.ajax({
																				url: "scripts/filterQuery.php",
																				type: "GET",
																				data: "q="+order+"&t="+type,
																				success: function(data)
																				{
																					$(".grid").fadeOut(speed, function(){
																												$(".grid").html(data);
																												$(".grid").fadeIn(speed, function(){
																																coverSlides();
																																})
																												})
																				},
																				error: function(xmlhttp) 
																				{
																					$(".grid").html(xmlhttp.status);
																				}
																  });//closes AJAX call
															 
															
													   });//closes videoBut click function
						//filters gallery by images
						$ ("#imgBut").click(function(){
														 type='image';
														 if ($(".showNav li a").hasClass('showNavPressed'))
															{
																$(".showNav li a").removeClass('showNavPressed');
															}
													   
														 	$(this).addClass("showNavPressed");
														 
															 $.ajax({
																				url: "scripts/filterQuery.php",
																				type: "GET",
																				data: "q="+order+"&t="+type,
																				success: function(data)
																				{
																					$(".grid").fadeOut(speed, function(){
																												$(".grid").html(data);
																												$(".grid").fadeIn(speed, function(){
																																coverSlides();
																																})
																												})
																				},
																				error: function(xmlhttp) 
																				{
																					$(".grid").html(xmlhttp.status);
																				}
																  });//closes AJAX call
															 
															
													   });//closes videoBut click function
						//edit galley sort by views
						$ ("#viewsButEdit").click(function(){
													     	 order='views';
														  	if ($(".filterNav li a").hasClass('filterNavPressed'))
															{
														 		$(".filterNav li a").removeClass('filterNavPressed');
													 		}
												   
													 		$(this).addClass("filterNavPressed");
														  
													        $.ajax({
																			
																	  url: "scripts/filterQuery.php",
																	  type: "GET",
																	  data: "q="+order+"&t="+type,
																	  success: function(data)
																	  {
																			$(".grid").html(data);
																			$(".workEditForm").hide();								
																	  },//closes on success function
																	   error: function(xmlhttp) 
																	   {
																			$(".grid").html(xmlhttp.status);
																	   }
															 });//closes AJAX call
															
													   });//closes function on viewsBut click
						//edit gallery filter by likes
						$ ("#likesButEdit").click(function(){
													   	  order='likes';
														  if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").html(data);
																				$(".workEditForm").hide();
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														   
														   
													   });//closes likesBut click
						//edit gallery filter by comments
						$ ("#commentsButEdit").click(function(){
														     order='comments';
															 if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").html(data);
																				$(".workEditForm").hide();
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														   
														  
													   });//closes commentsBut click
						//edit gallery filter by date
						$ ("#dateButEdit").click(function(){
													      order='date';
														  if ($(".filterNav li a").hasClass('filterNavPressed'))
													 {
														 $(".filterNav li a").removeClass('filterNavPressed');
													 }
												   
													 $(this).addClass("filterNavPressed");
													 
													       $.ajax({
																			
																			url: "scripts/filterQuery.php",
																			type: "GET",
																			data: "q="+order+"&t="+type,
																			success: function(data)
																			{
																				$(".grid").html(data);
																				$(".workEditForm").hide();
																			},
																			error: function(xmlhttp) 
																			{
																				$(".grid").html(xmlhttp.status);
																			}
																  });//closes AJAX call
														   
															
													   });//closes dateBut click
						
						//show all work in the filter gallery
						$ ("#allButEdit").click(function(){ 
													 	type='';
														
															if ($(".showNav li a").hasClass('showNavPressed'))
															 {
																 $(".showNav li a").removeClass('showNavPressed');
															 }
												   
													 	$(this).addClass("showNavPressed");
													 
												 		 $.ajax({
																	  url: "scripts/filterQuery.php",
																	  type: "GET",
																	  data: "q="+order+"&t="+type,
																	  success: function(data)
																	  {
																			$(".grid").html(data);
																			$(".workEditForm").hide();						
																	  },
																	  error: function(xmlhttp) 
																	  {
																		  $(".grid").html(xmlhttp.status);
																	  }
																  });//closes AJAX call
												  
													 
												   });//closes allBut click function
						
						
						$ ("#audioButEdit").click(function(){ 
														   type="audio";
														   
														  if ($(".showNav li a").hasClass('showNavPressed'))
														 {
															 $(".showNav li a").removeClass('showNavPressed');
														 }
													   
														 $(this).addClass("showNavPressed");
														 
														  $.ajax({
																		url: "scripts/filterQuery.php",
																		type: "GET",
																		data: "q="+order+"&t="+type,
																		success: function(data)
																		{
																			$(".grid").html(data);
																			$(".workEditForm").hide();
																										
																		},
																		error: function(xmlhttp) 
																		{
																			$(".grid").html(xmlhttp.status);
																		}
																  });//closes AJAX call
														  
													   
													   });//closes audioBut click function
						//show only videos in the edit gallery
						$ ("#videoButEdit").click(function(){
														   type='video';
														   if ($(".showNav li a").hasClass('showNavPressed'))
															{
																$(".showNav li a").removeClass('showNavPressed');
															}
													   
														 	$(this).addClass("showNavPressed");
														 
															 $.ajax({
																				url: "scripts/filterQuery.php",
																				type: "GET",
																				data: "q="+order+"&t="+type,
																				success: function(data)
																				{
																					$(".grid").html(data);
																					$(".workEditForm").hide();
																												
																				},
																				error: function(xmlhttp) 
																				{
																					$(".grid").html(xmlhttp.status);
																				}
																  });//closes AJAX call
														
															
													   });//closes videoBut click function
						//show only images in the edit gallery
						$ ("#imgButEdit").click(function(){
														 type='image';
														 if ($(".showNav li a").hasClass('showNavPressed'))
														 {
															 $(".showNav li a").removeClass('showNavPressed');
														 }
													   
														 $(this).addClass("showNavPressed");
														 
															 $.ajax({
																		  url: "scripts/filterQuery.php",
																		  type: "GET",
																		  data: "q="+order+"&t="+type,
																		  success: function(data)
																		  {
																			  $ (".grid").html(data);
																			  $ (".workEditForm").hide();
																		  },
																		  error: function(xmlhttp) 
																		  {
																			  $(".grid").html(xmlhttp.status);
																		  }
																  });//closes AJAX call
															 
															 
															
													   });//close imgBut click function
            
      	//handles the login form validation and subbmition
		/*$("#myForm").validate({
								debug: false,
								rules: 
									{
										uname: "required",
										pwd: "required",
									},
							  });*/
		//submit the login
		$("body").click(function(event){
								 		if ($(event.target).is(".submitLogin"))
															   				{																						
																																			
																				var form=$('#myForm').serialize();
																				
																				$.ajax({
																						
																							url: "./processesScripts/processLogin.php",
																							type: "post",
																							data: form,
																							
																							success: function(loggedIn)
																												{
																													
																												$('.panel').html(loggedIn);		
																																																			
																												}
															
																						}); //closes ajax
														 
																				} //closes submit event target if
					
											}); //closes body .click function
		
		

});										 
