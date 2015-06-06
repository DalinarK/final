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


		$toDB = json_encode($hatredArray);
		

	}
	//echo ($toDB);

	//update the hate list
	$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	if ($mysqli2->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli2->connect_errno . ") " . $mysqli2->connect_error;
	}
	else
	{
		//echo "Successfully connected to database <br>";
	}

	if (!($stmt2 = $mysqli2->prepare("UPDATE hatr SET hatred = ? WHERE username = ?"))) 
		//500,"  $_GET['videoName'] "," $_GET['category'] ", " $_GET['length'] "," 0 ")"))) 
	{
	    echo "Prepare failed: (" . $mysqli2->errno . ") " . $mysqli2->error;
	}

	if (!$stmt2->bind_param("ss", $toDB, $user)) {
	    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
	}

	if (!$stmt2->execute()) {
		if ($stmt2->errno == 1062)
		{
			echo ("Human, there is already an existing user of that name.");
		}
		else
		{
		    echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
		}

	}
	else
	{

	}



	// check to see if the hated person hates the user back
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else
	{
		//echo "Successfully connected to database <br>";
	}

	if (!($stmt = $mysqli->prepare("SELECT Hatred, StreetNum, Street, City FROM hatr WHERE username = ?"))) {
	    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	else
	{
		//echo "Assigned mysqli object to stmt object <br>";
	}

	// Bind the input parameters to the prepared statement
	$stmt->bind_param('s', $hate);


	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_result($hatersHatesJSON, $StreetNum, $Street, $City)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	else
	{

		while ($stmt->fetch()) 
		{
			$hatedHatesArray = json_decode($hatersHatesJSON);
			
//			echo ("<br>" . $hatersHatesJSON);
		}
			
		//$subjectsArray = json_decode($hatersHatesJSON);	

	}
	//echo ($Street);
	$foundMatch = 0;
	

	for ($i = 0; $i < count($hatedHatesArray); $i++)
		{
			if ($hatedHatesArray[$i] == $user)
			{
				$foundMatch = 1;
				//echo ("hated!");
				//$status = array("1", $StreetNum, $Street, $City); //array("valStatus" => "1");
				$status = array("match" => "1", "hate" => $hate, "StreetNum" => $StreetNum, "Street" => $Street, "City" => $City, "hatelist" => $hatredArray); //array("valStatus" => "1");

				
				//$status = array ("valStatus" => 1, "streetNum" , "street" => $
				echo(json_encode($status));
				//echo (json_encode($status));
			}
			else
			{		
					

					//echo (json_encode($status));
			}


		}

		if ($foundMatch != 1)
		{
					$status = array("match" => "0", "hatelist" => $hatredArray); //array("valStatus" => "0");
					echo(json_encode($status));
		}


	


   	mysqli_close($mysqli);
	mysqli_close($mysqli2);

?>