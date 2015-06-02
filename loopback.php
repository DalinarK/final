<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Loopback.php</title>
</head>
<body>
<h1>Loopback Assignment</h1>
<section>		
	<form action="loopback.php" method="post">
		<legend>send by POST</legend>
	    Name:  <input type="text" name="username" /><br />
	    Email: <input type="text" name="email" /><br />
    	<input type="submit"/>
	</form>

	<form action="loopback.php" method="get">
		<legend>send by GET</legend>
	    Name:  <input type="text" name="username" /><br />
	    Email: <input type="text" name="email" /><br />
    	<input type="submit" />
	</form>


</section>

<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

//web.engr.oregonstate.edu/~dinhd/Ass4/loopback.php?min-multiplicand=1&max-multiplicand=10&min-multiplier=1&max-multiplier=10
$keyPresent = false;

//Post portion
if ($_POST)
{

	foreach($_POST as $key => $value)
	{
		if ($value != null)
		{
			$keyPresent = true;
		}
	}

	if($keyPresent === false)
	{
		print_r('<br> {"Type":"[POST]", "parameters":null}');
	}
	else
	{
		echo '<br>' . '{"Type" : "[POST]", "parameters": ' . json_encode($_POST) . '}';
	}
}
else
{
	print_r('Human, there was no info collected by POST');
}

$keyPresent = false;
//Get portion
if ($_GET)
{
	foreach($_GET as $key => $value)
	{
		if ($value != null)
		{
			//print_r('<br> Human, there are key(s) missing');
			$keyPresent = true;
		}
		// checks to see if a key value is passed in.
		//if (!empty(json_encode($_GET[$key])))

	}

	if($keyPresent === false)
	{
		print_r('<br> {"Type":"[GET]", "parameters":null}');
	}
	else
	{
		echo '<br>' . '{"Type" : "[GET]", "parameters": ' . json_encode($_GET) . '}';
	}
}
else
{
	print_r('<br> Human, there was no info collected by GET');
}

//$_POST works exactly the same way except for variables sent in via a POST request
?>
</body>
</html>
