<?php ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessionFix'));
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');


	$returnData = array();
	$returnData[]  = 'one:dog';
	$returnData[]  = 'two:cat';


	$username = "doge";
	$password = "pass";

	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


	// Connect to the MySQL server
	$db = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "Mekmy0hd8jvLKeBL" , "dinhd-db");

	// Determine whether an account exists matching this username and password
	$stmt = $db->prepare("SELECT Name FROM hatr WHERE username = ? and password = ?");

	// Bind the input parameters to the prepared statement
	$stmt->bind_param('ss', $username, $password); 

	// Execute the query
	$stmt->execute();

	// Store the result so we can determine how many rows have been returned
	$stmt->store_result();

	if($stmt->num_rows == 1){
		$_SESSION['username'] = $username;
		$status = array( "valStatus" => "1");
		echo (json_encode($status));
	}
	else
	{
		$status = array("valStatus" => "0");
		print (json_encode($status));
	}

	mysqli_close($db);
?>