/**
 * jTinder initialization
 */

function mainTind(usernames) {

	//used to keep track of what user is being liked or disliked in the array that usernames array
	var slideNum = usernames.length -1;
	var val;
	//the user that's hating.
	var user;
	//the user that's being hated.
	var hate;
	//the object that holds the user and hate to be passed to php
	var userInfo;

	$("#tinderslide").jTinder({
		// dislike callback
	    onDislike: function (item) {
		    // set the status text
		    hate = usernames[slideNum];
		    slideNum -= 1;
		   	user = usernames['0'];

		   	userInfo = {"username": user, "hate": hate};

		   	$.post( 
			"getHatrs.php",
			userInfo,
			function(info){
				
				if (info != null)
				{	

					var sfas = $.parseJSON(info);
					console.log(info);
					console.log("Your hates: " + sfas.hatelist);
					
					var x;
					$("#hateArea").empty();
					$("#hateArea").append("You currently despise: ");
					
		
					for (x in sfas)
					{
						$("#hateArea").append(sfas[x] + ", ");
					}
					
				}								
			}
		);


    		$("#hateArea").empty();
			$("#hateArea").append("You currently despise: ");
			

			for (x in val)
			{
				$("#hateArea").append(val[x] + ", ");
			}

	    },
		// like callback
	    onLike: function (item) {

	
	    var hate = usernames[slideNum];
	    console.log("this is the person that's being hated on:" + hate);
	    slideNum -= 1;
	    var userData;
	    var count = 0

	    var user = usernames['0'];

	    console.log("this is the user: " + user);

		var userInfo = {"username": user, "hate": hate};

		// send data to the updateHates.php to update list of hates
	  	$("#feedBackArea").empty();
		$.post( 
			"updateHates.php",
			userInfo,
			function(info){
				
				if (info != null)
				{	

					var sfas = $.parseJSON(info);
					//alert(sfas.match);
					console.log(info);
					console.log("Your hates: " + sfas.hatelist);
					

					val = sfas.hatelist;
					var x;
					$("#hateArea").empty();
					$("#hateArea").append("You currently despise: ");
					
		
					for (x in val)
					{
						$("#hateArea").append(val[x] + ", ");
					}
					
					//prints out all the people user hate so far
					if (sfas.match == "1")
					{
						var curUser = {"username": $("#userID").val()};
						$.post( 
						"users.php",
						curUser,
						function(info, userData){
							userData = $.parseJSON(info);

							if (userData != null)
							{
								for(var i = 0 ; i < userData.length; i++) 
								{
				                    
			                        if (userData[count].username == sfas.hate)
			                        {
			                        	$("body").empty();
			      
			                        	$("body").append("<div class = 'container'> <div class = 'col-lg-2'></div> <div class = 'titles text-center  col-lg-8'> <h1 class = ''> Human, you have found someone who detests your very existence as you they </h1> <br> To facilitate your mutual hatred, we have provided you with their address. It is: <br> <h3> " + sfas.StreetNum + " " + sfas.Street + " " + sfas.City + ". </h3> <br> <form id = 'myForm' class = ''> <input type='submit' class = 'btn btn-lg btn-primary btn-block' value = 'Find more people to hate' id ='submit'/></form>" );
			                        	

			                        }
		                					 count += 1;
								}

							}									
						
						});
					}
				}
				// if (temp.valStatus == 1)
				// {
				// 	console.log("match!");
					
				// 	//$("#feedBackArea").html(feedback.valstatus);
				// }
				// else
				// {

				// 	$("#feedBackArea").html("failed auth!");
				// }									
			}
		);

	    },
		animationRevertSpeed: 200,
		animationSpeed: 400,
		threshold: 1,
		likeSelector: '.like',
		dislikeSelector: '.dislike'
	});

	/**
	 * Set button action to trigger jTinder like & dislike.
	 */
	$('.actions .like, .actions .dislike').click(function(e){
		e.preventDefault();
		$("#tinderslide").jTinder($(this).attr('class'));
	});

}