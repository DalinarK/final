<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
 	session_start();

		$username = filter_var($_POST["username"]);
		$password = filter_var($_POST["password"]);
		$name = filter_var($_POST["name"]);
		$streetNumber = filter_var($_POST["streetNumber"]);
		$street = filter_var($_POST["street"]);
		$city = filter_var($_POST["city"]);
		$motto = filter_var($_POST["motto"]);
		$picture = filter_var($_POST["picture"]);
		$hate = "[]";


		$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu", "dinhd-db", "XTJ5gewxEKlbzpgJ", "dinhd-db");
			if ($mysqli2->connect_errno) {
			    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			else
			{
				//echo "Successfully connected to database <br>";
			}

			if (!($stmt2 = $mysqli2->prepare("INSERT INTO hatr(Username, Password, Name, StreetNum, Street, City, Quote, picture, Hatred) VALUES (?,?,?,?,?,?,?,?,?)"))) 
				//500,"  $_GET['videoName'] "," $_GET['category'] ", " $_GET['length'] "," 0 ")"))) 
			{
			    echo "Prepare failed: (" . $mysqli2->errno . ") " . $mysqli2->error;
			}

			if (!$stmt2->bind_param("sssisssss", $username, $password, $name, $streetNumber, $street, $city, $motto, $picture, $hate)) {
			    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
			}

			if (!$stmt2->execute()) {
				if ($stmt2->errno == 1062)
				{
					$status = array( "valStatus" => "0");
					echo (json_encode($status));
				}
				else
				{
				    echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
				}

			}
			else
			{
					$_SESSION['username'] = $username;
					$status = array( "valStatus" => "1");
					echo (json_encode($status));
			}

			mysqli_close($mysqli2);

?>