<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$name = NULL;
	$quote = NULL;
	$picture = NULL;
	$username = NULL;

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else
	{
		//echo "Successfully connected to database <br>";
	}


	if (!($stmt = $mysqli->prepare("SELECT Name, Quote, Picture, Username FROM hatr"))) {
	    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	else
	{
		//echo "Assigned mysqli object to stmt object <br>";
	}

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}


	if (!$stmt->bind_result($name, $quote, $picture, $username)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$rows = array();
	

	while ($row = $stmt->fetch()) 
	{
		$person = array(
			"name" => $name,
			"quote" => $quote,
			"picture" => $picture,
			"username" => $username
		);

		array_push($rows, $person);

	}

	echo (json_encode($rows));

	// foreach ($rows as $indiv)
	// {
	// 	echo ($indiv['name']); 
	// }

?>