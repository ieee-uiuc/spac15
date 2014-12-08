<?php

// Use the POST data to insert into a database, and echo the results

require_once("../mysql_connection.php");

if (!$con = mysqli_connect($server, $user, $password, $db))
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$username = $_POST['username'];

// First check if they have registered already, and if so, exit.
/*
$query = "SELECT * FROM registration WHERE netid='$netid'";
if (mysqli_num_rows(mysqli_query($con, $query)) != 0)
{
	mysqli_close($con);
	echo "Repeat";
	die();
}
*/

$netid = $_POST['netid'];
$major = $_POST['major'];
$year = $_POST['year'];
$profile = $_POST['profile'];
$size = $_POST['size'];

$columns = "username, netid, major, year, profile, size";
$values = "'$username', '$netid', '$major', '$year', '$profile', '$size'";

$query = "INSERT INTO registration (" . $columns . ") VALUES (" . $values . ")";

if (!mysqli_query($con, $query))
	$return = "Registration failed. Please try again by refreshing the page.";
else
	$return = "Thank you for registering for SPAC 2015!";

echo $return;

mysqli_close($con);

?>