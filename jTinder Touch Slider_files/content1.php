<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//header('Content-Type: text/plain');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>content1.php</title>
</head>
<body>
<h1>Content1.php</h1>

<section>
	<?php

	

		if ($_POST['username'] == null || $_POST['username'] == null)
		{
			print_r('Human, you must enter both a username and password. ');
		?>

	<br>
	<a href = "login.php"> Click Here to return to the login page </a>

		<?php
		}
		else
		{	// this section of code was copied from the lecture
			if(session_status() == PHP_SESSION_ACTIVE)
			{

				// Sanitize incoming username and password
				$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
				$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

				// Connect to the MySQL server
				$db = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ" , "dinhd-db");

				// Determine whether an account exists matching this username and password
				$stmt = $db->prepare("SELECT Name FROM hatr WHERE username = ? and password = ?");

				// Bind the input parameters to the prepared statement
				$stmt->bind_param('ss', $username, $password); 

				// Execute the query
				$stmt->execute();

				// Store the result so we can determine how many rows have been returned.
				$stmt->store_result();

				if($stmt->num_rows == 1){

					print_r('Successfully authenticated');

					?>
					<script language="JavaScript">

						window.location = 'content2.php';

					</script>

					<?php

				}
				else
				{
					print_r('authentication failed');
				}

			}
		}
	?>

	
		
</section>

</body>
</html>
