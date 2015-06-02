<?php session_start(); 
?>

<!DOCTYPE html>
<!-- saved from url=(0022)http://x5c.de/jtinder/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exp</title>
    <link rel="stylesheet" type="text/css" href="./jTinder Touch Slider_files/jTinder.css">
</head>
<body>

<script src="jquery-1.11.3.min.js"></script>

    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.jTinder.js"></script>

<script>
    var userData;
    var count = 0
  
	$.post( 
		"users.php",
		"",
		function(info, userData){
			userData = $.parseJSON(info);
			//$("#feedBackArea").empty();
			if (userData != null)
			{
				  for(var i = 0 ; i < userData.length; i++) 
					{
                        
                        console.log();
                        $("#displayarea").append(   '<li class="panel'+i+'"><div class="img"></div><div class = "name"></div><div class = "quote"></div><div class="like"></div><div class="dislike"></div></li>'
                        );
                        $('#tinderslide .panel'+count+' .img').css("background", 'url("'+userData[count].picture+'") no-repeat scroll center center');
                        $('#tinderslide .panel'+count+' .img').css("background-size", "auto 95%");
                        $('#tinderslide .panel'+count+' .quote').css("font-size", "75%");
                        $('#tinderslide .panel'+count+' .name').append(userData[count].name + "<br>");
                        $('#tinderslide .panel'+count+' .quote').append('"'+userData[count].quote + '"<br>');
                        count += 1;
                        
					}
                    
                    go();
                                
                    transform();
                    mainTind();
			}
			else
			{
				$("#feedBackArea").html("failed auth!");
			}									
		}
	);

</script>

    <h2 class = "titles" id = "userLog"> Hatr: </h2>
    <h3 class = "titles" >Connecting people who have an irrational hatred of each other</h3>


    <!-- start padding container -->
    <div class="wrap">
        <!-- start jtinder container -->
        <div id="tinderslide">
            <ul id= "displayarea">

            
            </ul>
        </div>
        <!-- end jtinder container -->
    </div>
    <!-- end padding container -->

    <!-- jTinder trigger by buttons  -->
    <div class="actions">
        <a href="" class="dislike"><i></i></a>
        <a href="" class="like"><i></i></a>
    </div>

    <div id = "feedBackArea" value = <?php echo ($_SESSION['username'])?> >this is the feedback area</div>

    <!-- jTinder status text  -->
    <div id="status"></div>
    

    <!-- jQuery lib -->
    
    <!-- jQuery lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.min.js"></script>
    <!-- transform2d lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.transform2d.js"></script>
    <!-- jTinder lib -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/jquery.jTinder.js"></script>
    <!-- jTinder initialization script -->
    <script type="text/javascript" src="./jTinder Touch Slider_files/main.js"></script>






</body></html>