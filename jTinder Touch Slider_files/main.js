/**
 * jTinder initialization
 */

function mainTind() {
	$("#tinderslide").jTinder({
		// dislike callback
	    onDislike: function (item) {
		    // set the status text
	    },
		// like callback
	    onLike: function (item) {
	    var userData;
	    var count = 0

	    var user = $("#userID").val();

		var userInfo = {"username": user};
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