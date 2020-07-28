<?php
//start_session
session_start();

include('connection.php');

//get all the necessary details from the Ajax call
$userId = $_SESSION['user_id'];
$currentPassword = $_POST['password1'];

//define necessary error messages
$missingCurrentPassword = "<p>Please enter your current password</p>";
$incorrectPassword = "<p>The password you entered is incorrect. Please enter a correct password!</p>";
$error = "";

if (empty($currentPassword)){
	$error.=$missingCurrentPassword;
	}
else{
	//sanitize password string
	$currentPassword = filter_var($currentPassword, FILTER_SANITIZE_STRING);
	$currentPassword = hash('sha256',mysqli_real_escape_string($conn, $currentPassword));
	
	//check the password in the database
	$sql = "SELECT * FROM users WHERE user_id='$userId'";
	$result = mysqli_query($conn, $sql);
	
	if(!$result){
		echo "ERROR: Could not execute query";
		exit;
		}
	
	$count = mysqli_num_rows($result);
	if($count == 1){
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$realPassword = $row['password'];
		//compare user inputted password with the one on the database
			//if they do not match, return error
			if($realPassword!=$currentPassword){
				$error.=$incorrectPassword;
				}
			
		}
	
	}
	
if(strlen($error)!=0){
	echo $error;
	}

else{
	
	}







?>