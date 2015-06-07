/**
 * jTinder initialization
 */

function mainTind(usernames) {

	//used to keep track of what user is being liked or disliked in the array that usernames array
	var slideNum = usernames.length -1;


	$("#tinderslide").jTinder({
		// dislike callback
	    onDislike: function (item) {
		    // set the status text

		    var user = usernames['0'];
		    var hate = usernames[slideNum];
		    var userInfo = {"username": user, "hate": hate};
		    slideNum -= 1;

		    		$.post( 
			"updateHates.php",
			userInfo,
			function(info){
				
				if (info != null)
				{	

					var sfas = $.parseJSON(info);
					console.log(info);
					console.log("Your hates: " + sfas.hatelist);
					

					var val = sfas.hatelist;
					var x;
					$("#hateArea").empty();
					$("#hateArea").append("You currently despise: ");
					
		
					for (x in val)
					{
						$("#hateArea").append(val[x] + ", ");
					}
						
				}
							
			}
		);
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
					console.log(info);
					console.log("Your hates: " + sfas.hatelist);
					

					var val = sfas.hatelist;
					var x;
					$("#hateArea").empty();
					$("#hateArea").append("You currently despise: ");
					
		
					for (x in val)
					{
						$("#hateArea").append(val[x] + ", ");
					}
					
					//prints out all the people user hates so far
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
			                        	$("body").append('<h3 class = "container text-center"> Human, you have found someone who detests your very existence as you they </h3> <br> <h3 class = "container text-center"> To facilitate your mutual hatred, their address is: ' + sfas.StreetNum + ' ' + sfas.Street + ' ' + sfas.City + '. </h3>');
			                        	$("body").append( '<form class = "container form-signin text-center " id = "myForm" > <input type="submit" class = "btn btn-lg btn-primary btn-block" value = "I want to find more people to hate"/> </form>');
	
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