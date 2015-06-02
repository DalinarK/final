<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>login.php</title>
</head>
<body>
<h1>Login Page</h1>
<section>		
	<form >
		<legend>Human, enter your slave name</legend>
	    UserName:  <input type="text" name="username" id ="userInput" value = "dinh" /><br />
	    Password: <input type="password" name="password" id ="userPass" value = "pass"/><br />
    	<input type="button" value = "Log in" id ="submit"/>
	</form>

	<form action="accountcreate.php" method="post">
    	<input type="submit" name = "Login" value = "Create an account"/>
	</form>

	<div id = "feedBackArea"></div>

</section>

<script src="jquery-1.11.3.min.js"></script>

<script>
		

		$("#submit").click( function(event) {


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
						$("#feedBackArea").html("passed auth!");
						window.location = 'main.php';
					}
					else
					{
						$("#feedBackArea").html("failed auth!");
					}
					 
					
				}
			);


			//make sure all forms filled out
			if (user == "" || pass == "")
			{
					alert('Human, not all of the fields are filled out!');
			}
			else
			{

				
			}
		});

</script>
</body>
</html>
