/**
 * jTinder initialization
 */

function mainTind() {
	$("#tinderslide").jTinder({
		// dislike callback
	    onDislike: function (item) {
		    // set the status text
	        $('#status').html('Dislike image ' + (item.index()+1));

	            var userData;
			    var count = 0

			    var user = $("#feedBackArea").val();
				echo (user);

				var userInfo = {"username": user, "password": pass};
			  
				$.post( 
					"updateHates.php",
					userInfo,
					function(info, userData){
						userData = $.parseJSON(info);
						$("#feedBackArea").empty();
						if (userData != null)
						{
							  for(var i = 0 ; i < userData.length; i++) 
								{
  
								}

			                    go();
			                    mainTind();
						}
						else
						{
							$("#feedBackArea").html("failed auth!");
						}									
					}
				);
	    },
		// like callback
	    onLike: function (item) {
		    // set the status text
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