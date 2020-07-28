<?php
//starting a session
session_start();

//connect to the database
include "connection.php";


if (!isset($_GET['email']) || !isset($_GET['key'])){
	echo "<div class='alert alert-danger'>Your account could not be activated! Please click on the link sent to your email address</div>";
	exit;
	}
	
//set variables
$email = $_GET['email'];
$key = $_GET['key'];


//prepare variable for mysql operations
$email = mysqli_real_escape_string($conn, $email);
$key = mysqli_real_escape_string($conn, $key);


//update details by setting the activation field to activated
$sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND  activation='$key') LIMIT 1";


$result = mysqli_query($conn, $sql) or die("ERROR: Cannot update details");


if(mysqli_affected_rows($conn) == 1){
	echo "<div class='alert alert-success'>Your account has been successfully activated!</div>";
	echo "Click <a href='index.php'>here</a> to login";
	}


else {
	echo "<div class='alert alert-danger'>Your account could not be activated! Please try again later" . mysqli_error($conn) . "</div>";
	}


?>


