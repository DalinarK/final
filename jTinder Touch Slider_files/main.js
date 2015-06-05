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
		    slideNum -= 1;
	    },
		// like callback
	    onLike: function (item) {

	
	    var hate = usernames[slideNum];
	    console.log("this is the person that's being hated on:" + hate);
	    slideNum -= 1;


	   // $('#userLog').html('Like image ' + (item.index()+1));

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
				//userData = $.parseJSON(info);
				if (info != null)
				{
					$("#feedBackArea").html(info);
				}
				else
				{

					$("#feedBackArea").html("failed auth!");
				}									
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