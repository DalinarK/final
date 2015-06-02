<?php
session_start();
//header('Content-Type: text/plain');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>content2.php</title>
</head>
<body>
<h1>Content2.php</h1>

<section>
	<?php
	//taken from lecture
	if(isset($_GET['action']) && $_GET['action'] == 'end'){
	//destroys the session by setting $_Session to an empty array.
	$_SESSION = array();
	// destroy the actual session ID. If the client tries to use that cookie again
	// will not evaluate to usable session
	session_destroy();

	//logic that redirects people after they end the session like logging out
	// similar to string functions in c++

	// explode() will split strings where there is a / into an array
	// the second parameter means get all things after oregonstate.edu/.
	// the -1 means grab everything BUT the last thing, in this case the file name.
	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	// implode() will combine things in an array into a string with a / behind them.

	// combined with explode get everything but the filename itself.
	$filePath = implode('/',$filePath);

	//sends you back to the server
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	header("Location: {$redirect}/Logout.html", true);
	die();
	}
	

		if ($_SESSION['username'] == null)
		{
		print_r('You must enter your slave name. ');
		?>

	<br>
	<a href = "http://web.engr.oregonstate.edu/~dinhd/Ass4/src/login.php"> Click Here to return to the login page </a>

		<?php
		}
		else
		{
			echo "Hi $_SESSION[username], you have visited this page $_SESSION[visits] times. \n";
			echo "<br>";
			echo "<a href = 'http://web.engr.oregonstate.edu/~dinhd/Ass4/src/content1.php'> Click Here to go to the content1.php page </a>";
		
		}
	?>
</section>

</body>
</html>
