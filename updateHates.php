<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$hatredArray = array();
	$hatred = NULL;
	$hatredJSON = NULL;

	$test = array();
	$user =  $_POST["username"];
	$hate = $_POST["hate"];

	echo ("user: " . $user . "<br>");
	echo ("Hated on: " . $hate . "<br>");


	// get current hates
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else
	{
		echo "Successfully connected to database <br>";
	}

	if (!($stmt = $mysqli->prepare("SELECT Hatred FROM hatr WHERE username = ?"))) {
	    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	else
	{
		echo "Assigned mysqli object to stmt object <br>";
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
		
		array_push($hatredArray, $hate);


		$toDB = json_encode($hatredArray);
		}


	}
	// //echo ($toDB);

	// //update the hate list
	// $mysqli2 = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	// if ($mysqli2->connect_errno) {
	//     echo "Failed to connect to MySQL: (" . $mysqli2->connect_errno . ") " . $mysqli2->connect_error;
	// }
	// else
	// {
	// 	//echo "Successfully connected to database <br>";
	// }

	// if (!($stmt2 = $mysqli2->prepare("UPDATE hatr SET hatred = ? WHERE username = ?"))) 
	// 	//500,"  $_GET['videoName'] "," $_GET['category'] ", " $_GET['length'] "," 0 ")"))) 
	// {
	//     echo "Prepare failed: (" . $mysqli2->errno . ") " . $mysqli2->error;
	// }

	// if (!$stmt2->bind_param("ss", $toDB, $user)) {
	//     echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
	// }

	// if (!$stmt2->execute()) {
	// 	if ($stmt2->errno == 1062)
	// 	{
	// 		echo ("Human, there is already an existing user of that name.");
	// 	}
	// 	else
	// 	{
	// 	    echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
	// 	}

	// }
	// else
	// {

	// }



	// // check to see if the hated person hates the user back
	// $mysqli3 = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	// if ($mysqli3->connect_errno) {
	//     echo "Failed to connect to MySQL: (" . $mysqli3->connect_errno . ") " . $mysqli3->connect_error;
	// }
	// else
	// {
	// 	//echo "Successfully connected to database <br>";
	// }

	// if (!($stmt3 = $mysqli3->prepare("SELECT hatred FROM hatr WHERE username = ?"))) {
	//     echo "Prepare failed: (" . $mysqli3->errno . ") " . $mysqli3->error;
	// }
	// else
	// {
	// 	//echo "Assigned mysqli object to stmt object <br>";
	// }

	// // Bind the input parameters to the prepared statement
	// $stmt3->bind_param('s', $hate)
	// ; 

	// if (!$stmt3->execute()) {
	//     echo "Execute failed: (" . $mysqli3->errno . ") " . $mysqli3->error;
	// }

	// if (!$stmt3->bind_result($hatersHatesJSON)) {
	//     echo "Binding output parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
	// }

	// $hatedHatesArray = json_decode($hatredJSON);

	// echo ($hatedHatesArray);

 //   	mysqli_close($mysqli);
	// mysqli_close($mysqli2);

	// mysqli_close($mysqli3);

?>