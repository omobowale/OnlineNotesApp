<?php
//connect to server
echo "<h1>Connecting to a server</h1>";

$conn = mysqli_connect("localhost", "root", "") or die("Unable to connect to server " . mysqli_connect_error());
var_dump($conn);

echo "Connected successfully to the server";

//Create a database
echo "<h1>Create a database</h1>";

$sql = "CREATE DATABASE usersDatabase4";

if(mysqli_query($conn, $sql)){
	echo "<p>Database successfully created!!!</p>";
	}

else {
	echo "ERROR: Could not execute query!!!" . mysqli_error($conn);
	}
	
//	connect to database

$conn = mysqli_connect("localhost", "root", "", "usersDatabase4") or die("Unable to connect to database " . mysqli_connect_error());;

$sql = "CREATE TABLE usersDetails (ID INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30) NOT NULL, email VARCHAR(40) NOT NULL, password VARCHAR(30) NOT NULL)";

if(mysqli_query($conn, $sql)){
	echo "<p>Table successfully created</p>";
	}
else {
	echo "ERROR: Unable to execute query ";
	}
//Add table to database


?>