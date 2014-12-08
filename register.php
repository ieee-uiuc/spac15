<?php

// Use the POST data to insert into a database, and echo the results

require_once("mysql_conection.php");

if (!$con = mysqli_connect($server, $user, $password, $db))
{
	die("Failed to connect to MySQL. Error: " . mysqli_connect_error());
}

$columns = "username, netid, major, year, profile, size";
$values = implode(", ", $_POST);

$query = "INSERT INTO registration (" . $columns . ") VALUES (" . $values . ")";

if (!mysqli_query($con, $query))
	$output = "Query failed.";
else
	$output = "Thank you for registering for SPAC 2015!";

echo $output;

mysqli_close($con);

?>