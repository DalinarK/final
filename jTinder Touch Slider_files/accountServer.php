<?php 
	header("Access-Control-Allow-Origin: *");
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');


	$returnData = array();
	$returnData[]  = 'one:dog';
	$returnData[]  = 'two:cat';

	if(isset($_POST['username']))
	{
		echo ($_POST['username']);
	}
	else
	{
		echo ("test");
	}

	// Sanitize incoming username and password

	//$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	//$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


	$username = "doge";
	$password = "pass";

	// Connect to the MySQL server
	$db = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ" , "dinhd-db");

	// Determine whether an account exists matching this username and password
	$stmt = $db->prepare("SELECT Name FROM hatr WHERE username = ? and password = ?");

	// Bind the input parameters to the prepared statement
	$stmt->bind_param('ss', $username, $password); 

	// Execute the query
	$stmt->execute();

	// Store the result so we can determine how many rows have been returned
	$stmt->store_result();

	if($stmt->num_rows == 1){
		echo json_encode($returnData);
	}
?>