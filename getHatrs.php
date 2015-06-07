<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$hatredArray = array();
	$hatedHatesArray = array();
	$hatred = NULL;
	$hatredJSON = NULL;

	$test = array();
	$user =  $_POST["username"];
	$hate = $_POST["hate"];

	$streetNum = NULL;
	$street = NULL;
	$city = NULL;

//	echo ("user: " . $user . "<br>");
//	echo ("Hated on: " . $hate . "<br>");


	// get current hates
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else
	{
		//echo "Successfully connected to database <br>";
	}

	if (!($stmt = $mysqli->prepare("SELECT Hatred FROM hatr WHERE username = ?"))) {
	    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	else
	{
		//echo "Assigned mysqli object to stmt object <br>";
	}

	// Bind the input parameters to the prepared statement
	$stmt->bind_param('s', $user); 

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_result($hatredJSON)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	else
	{

		while ($stmt->fetch()) {

		$hatredArray = json_decode($hatredJSON);
//		echo ($hatredJSON);
		}

		 $foundExisting = 0;
 
		for ($i = 0; $i < count($hatredArray); $i++)
		{
			if ($hatredArray[$i] == $hate)
			{
//				echo("<br> found duplicate entry");
				$foundExisting = 1;
			}
		}

		if ($foundExisting == 0)
		{
			array_push($hatredArray, $hate);
		}

		echo json_encode($hatredArray);	
	}