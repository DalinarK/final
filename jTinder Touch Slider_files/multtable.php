<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>multtable.php</title>
</head>
<body>
	<h1>Multiplication Table</h1>

<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

//web.engr.oregonstate.edu/~dinhd/Ass4/multtable.php?min-multiplicand=1&max-multiplicand=10&min-multiplier=1&max-multiplier=10

$multiplicand;
$multiplier;

$precondPassed = true;

//checks to see if all the inputs are there.
if(!isset($_GET['min-multiplicand']))
{
	print_r('Missing parameter [min-multiplicand] <br>');
	$precondPassed = false;
}
if(!isset($_GET['max-multiplicand']))
{
	print_r('Missing parameter [max-multiplicand]<br>');
	$precondPassed = false;
}
if(!isset($_GET['min-multiplier']))
{
	print_r('Missing parameter [min-multiplier]<br>');
	$precondPassed = false;
}
if(!isset($_GET['max-multiplier']))
{
	print_r('Missing parameter [max-multiplier]<br>');
	$precondPassed = false;
}

//checks to see if the input is an integer
//found ctype_digit on http://stackoverflow.com/questions/2012187/how-to-check-that-a-string-is-an-int-but-not-a-double-etc
if ($precondPassed === true)
	{
		if(!ctype_digit($_GET['min-multiplicand']))
		{
			print_r('[min-multiplicand] must be an integer. <br>');
			$precondPassed = false;
		}
		if(!ctype_digit($_GET['max-multiplicand']))
		{
			print_r('[max-multiplicand] must be an integer.<br>');
			$precondPassed = false;
		}
		if(!ctype_digit($_GET['min-multiplier']))
		{
			print_r('[min-multiplier] must be an integer. <br>');
			$precondPassed = false;
		}
		if(!ctype_digit($_GET['max-multiplier']))
		{
			print_r('[max-multiplier] must be an integer. <br>');
			$precondPassed = false;
		}
	}


// checks to see if the input is valid
if ($precondPassed === true)
{
	if ($_GET['min-multiplicand'] > $_GET['max-multiplicand'] || $_GET['min-multiplier'] > $_GET['max-multiplier'])
	{
		print_r('Minimum [multiplicand|multiplier] larger than maximum.');
		$precondPassed = false;
	}
}

//creates the arrays that hold the values to be printed out/multiplied
if ($precondPassed === true)
{
	$minPlicand = $_GET['min-multiplicand'];
	$maxPlicand = $_GET['max-multiplicand'];
	$minPlier = $_GET['min-multiplier'];
	$maxPlier = $_GET['max-multiplier'];

	echo 'Minimum Multiplicand:' . $minPlicand . '<br>';
	echo 'Maximum Multiplicand:' . $maxPlicand. '<br>';
	echo 'Minimum Multiplier:' . $minPlier . '<br>';
	echo 'Maximum Multiplier:' . $maxPlier . '<br>';

	//creates an array that holds all the values between the min and max
	for ($i = $minPlicand; $i < $maxPlicand + 1; $i++)
	{
		//print_r ($i);
		$multiplicand[] = $i;
	}

	for ($i = $minPlier; $i < $maxPlier + 1; $i++)
	{
		//print_r ($i);
		$multiplier[] = $i;
	}
}

// prints out the table
if ($precondPassed === true)
{
	echo ' 
	<p> <table border="1">';


	echo '<tr> <td>  ';
	foreach($multiplier as $key => $value){
		echo  ' <td>' . $value;
	}

	static $internal = 0;

	foreach($multiplicand as $outside => $value){
		echo  '<tr> <td>' . $value;
		foreach($multiplier as $inside => $value){
			echo '<td>' . $value * $multiplier[$outside];
			// $internal = $internal + 1;
		}
	}

	echo '<table>';
}
//$_POST works exactly the same way except for variables sent in via a POST request
?>
</body>
</html>
