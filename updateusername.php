<?php 

//start session
session_start();

//connect to database
include('connection.php');

//get necessary variables
$userId = $_SESSION['user_id'];
$username = $_POST['username'];

//check for errors
if(empty($username)){
	echo "Please enter a username";
	exit;
	}

$username = filter_var($username, FILTER_SANITIZE_STRING);
$username = mysqli_real_escape_string($conn, $username);

//create query
$sql = "UPDATE users SET username='$username' WHERE user_id='$userId'";

//perform mysql query
$result = mysqli_query($conn, $sql);


//return error message or nothing
if(!$result){
	echo "error";
	}

?>
