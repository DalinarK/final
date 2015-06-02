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

			var userInfo = {"username": user, "password": pass, "name": name, "streetNumber": num, "street": street, "city": city, "motto": motto };
			alert(num);
			alert(street);

			$.post( 
				"server.php",
				userInfo,
				function(info){
					$("#ack").empty();
					$("#ack").html (info);
				}
			);


			//make sure all forms filled out
			if (user == "" || pass == "" || num == "" || 
				street == "" || city == "" || motto == ""){
				alert('Human, all entries must be entered');
			}
			else
			{

				
			}
		});

</script>



</body>
</html>
