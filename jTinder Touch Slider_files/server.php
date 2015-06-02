<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

		$username = filter_var($_POST["username"]);
		$password = filter_var($_POST["password"]);
		$name = filter_var($_POST["name"]);
		$streetNumber = filter_var($_POST["streetNumber"]);
		$street = filter_var($_POST["street"]);
		$city = filter_var($_POST["city"]);
		$motto = filter_var($_POST["motto"]);



		$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
			if ($mysqli2->connect_errno) {
			    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			else
			{
				echo "Successfully connected to database <br>";
			}

			if (!($stmt2 = $mysqli2->prepare("INSERT INTO hatr(Username, Password, Name, StreetNum, Street, City, Quote) VALUES (?,?,?,?,?,?,?)"))) 
				//500,"  $_GET['videoName'] "," $_GET['category'] ", " $_GET['length'] "," 0 ")"))) 
			{
			    echo "Prepare failed: (" . $mysqli2->errno . ") " . $mysqli2->error;
			}

			if (!$stmt2->bind_param("sssisss", $username, $password, $name, $streetNumber, $street, $city, $motto)) {
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
				echo "this overwrote teh last message";
			}

?>