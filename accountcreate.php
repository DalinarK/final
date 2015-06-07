

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Create new account!</title>
</head>


<body>
<h1>Create new account!</h1>
<section>		
	<form id = "myForm" >
		<legend>Create a new accoun</legend>
	    UserName:  <input type="text" name="username" id = "userInput" value ="Spongebob" /><br />
	    Password: <input type="password" name="password" id = "userPass" value = "pass" /><br />
	    Name: <input type="text" name="name" id = "name" value ="chad" /><br />
	    Street Number: <input type="number" name="streetNumber"  id = "userNum" value = "323" /><br />
	    Street Name: <input type="text" name="streetName"  id = "userStreet" value = "evergreen" /><br />
	    City: <input type="text" name="city"  id = "userCity" value = "Springfield" /><br />
	    Personal Motto: <input type="text" name="motto"  id = "userMotto" value ="yolo" /><br />
	    Picture URL: <input type="text" name="picture"  id = "picture" value ="http://i.imgur.com/26PkJjn.gif" /><br />
	    <input type="button" value = "Create a new account!" id ="submit"/>
	</form>

</section>

<div id="ack"></div>

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
			if (!isNaN(num))
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



</body>
</html>
