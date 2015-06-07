

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
<title>Create new account!</title>
</head>
	<link href="css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">

<body>

<div class="container">
	<section>		
		<form class="form-signin">
		<h2>Create new account!</h2>
			
		<form id = "myForm" class="form-signin">
			
		    <input type="text" class="form-control" name="username" id = "userInput" placeholder = "UserName" >
		    <input type="password" class="form-control" name="password" id = "userPass" placeholder = "Password" >
		    <input type="text" class="form-control" name="name" id = "name" placeholder = "Name" >
		    <input type="text" class="form-control" name="streetNumber"  id = "userNum" placeholder = "Street Number" >
		    <input type="text" class="form-control" name="streetName"  id = "userStreet" placeholder = "Street Name" >
		    <input type="text" class="form-control" name="city"  id = "userCity" placeholder = "City" >
		    <input type="text" class="form-control" name="motto"  id = "userMotto" placeholder = "Personal Motto" >
		    <input type="url" class="form-control" name="picture"  id = "picture" placeholder = "Selfie URL" /><br />
		    <input type="button" class="btn btn-lg btn-primary btn-block" value = "Create a new account!" id ="submit"/>
		</form>

	</section>

	<div id="ack" class="form-signin"></div>
</div>
</body>

<script src="jquery-1.11.3.min.js"></script>

<script>

		$("#submit").click( function(event) {

			var user = $("#userInput").val();
			var pass =  $("#userPass").val();
			var name = $("#name").val();
			var num = $("#userNum").val();
			var street = $("#userStreet").val();
			var city = $("#userCity").val();
			var motto = $("#userMotto").val();
			var picture = $("#picture").val();

			//make sure all forms filled out
			if (isNaN(num))
			{
				alert('Human, the street address must consist of numbers!');
				
			}
			else if (user == "" || pass == "" || num == "" || 
				street == "" || city == "" || motto == "" || picture == "")
			{
				alert('Human, all entries must be entered');
			}
			else
			{
				//send request to server
				var userInfo = {"username": user, "password": pass, "name": name, "streetNumber": num, "street": street, "city": city, "motto": motto, "picture": picture };


				$.post( 
				"server.php",
				userInfo,
				function(info){
					var temp = JSON.parse(info);
					$("#ack").empty();
					if (temp.valStatus == 1)
					{
							$("#feedBackArea").html("passed auth!");
							window.location = 'main.php';
					}
					else if (temp.valStatus == 0)
					{	
						$("#ack").html("Human, there that username already exists! Pick another");
					}
					else
					{
						$("#ack").html ("info");
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


</html>
