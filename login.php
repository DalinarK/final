<?php 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessionFix'));
session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
<title>login.php</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<body>

<div class="container">



<section>		
	<form class="form-signin">
		<h2 class="form-signin-heading text-center">Hatr</h2>
		<label for="userInput" class="sr-only">UserName:  </label>
	    <input type="text" class="form-control" name="username" id ="userInput" placeholder="Username" autofocus=""
	    style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;" autocomplete="off">
	    <input type="password" class="form-control" name="password" id ="userPass"placeholder="Password" required="" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;" autocomplete="off">
    	<input type="button" value = "Log in" id ="submit" class="btn btn-lg btn-primary btn-block"/>
	</form>

	<form action="accountcreate.php" method="post" class="form-signin">
    	<input type="submit" name = "Login" value = "Create an account" class="btn btn-sm btn-block"/>
	</form>

	<div class="form-signin" id = "feedBackArea"></div>

</section>

<script src="jquery-1.11.3.min.js"></script>

<script>
		$("#submit").click( function(event) {

			//make sure all forms filled out
			if (user == "" || pass == "")
			{
					alert('Human, not all of the fields are filled out!');
			}
			else
			{
				var user = $("#userInput").val();
				var pass =  $("#userPass").val();

				var userInfo = {"username": user, "password": pass};
				
				$.post( 
					"uservalidation.php",
					userInfo,
					function(info){
						var temp = JSON.parse(info);
						$("#feedBackArea").empty();
						if (temp.valStatus == 1)
						{
							//$("#feedBackArea").html("passed auth!");
							window.location = 'main.php';
						}
						else
						{
							$("#feedBackArea").html("Human, the username or password was incorrect!");

							$("#feedBackArea").fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
						}
						 
						
					}
				);
			}



		});

</script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

     </div> 
</body>
</html>
