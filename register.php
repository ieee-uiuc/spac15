<?php

// Use the POST data to insert into a database, and echo the results

require_once("../mysql_connection.php");

if (!$con = mysqli_connect($server, $user, $password, $db))
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$username = $_POST['username'];

// First check if they have registered already, and if so, exit.
$query = "SELECT id FROM registration WHERE username='$username'";
if (mysqli_num_rows($mysqli_query($con, $query)) != 0)
{
	mysqli_close($con);
	die("Repeat");
}

$netid = $_POST['netid'];
$major = $_POST['major'];
$year = $_POST['year'];
$profile = $_POST['profile'];
$size = $_POST['size'];

$columns = "username, netid, major, year, profile, size";
$values = "'$username', '$netid', '$major', '$year', '$profile', '$size'";

$query = "INSERT INTO registration (" . $columns . ") VALUES (" . $values . ")";

// check if they've registered already

if (!mysqli_query($con, $query))
	$return = "Fail";
else
	$return = "Success";

echo $return;

mysqli_close($con);

?>