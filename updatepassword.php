<?php
//start_session
session_start();

include('connection.php');


//get the user id
$userId = $_SESSION['user_id'];

//get all the necessary details from the Ajax call
$newPassword = $_POST['password2'];
$confirmPassword = $_POST['password3'];

//define necessary error messages
$missingCurrentPassword = "<p>Please enter your current password</p>";
$missingNewPassword = "<p>Please enter your new password!</p>";
$missingConfirmPassword = "<p>Please confirm your new password!</p>";
$invalidPassword =  "<p>Please enter a valid password. Password must not be less than 8 characters long and should contain at least a capital letter and a number!</p>";
$passwordsMismatch = "<p>The two passwords do not match. Please re-enter the passwords!</p>";
$error = "";
	
if (empty($newPassword)){
	$error.=$missingNewPassword;
	}
else{
	if (!(strlen($newPassword) > 8 and preg_match('/[A-Z]/',$newPassword) and preg_match('/[0-9]/',$newPassword))){
		$error.=$invalidPassword;
	}
	else{
		$newPassword = filter_var($newPassword, FILTER_SANITIZE_STRING);
		if(empty($confirmPassword)){
			$error.=$missingConfirmPassword;
		}
		else{
			$confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING);
			if($newPassword!=$confirmPassword){
				$error.= $passwordsMismatch;
			}
		}
	}
}

if(strlen($error)!=0){
	echo $error;
	}

else{
	
//if no errors, then the password could be hashed
$newPassword = hash('sha256', $newPassword);

//prepare password for sql query
$newPassword = mysqli_real_escape_string($conn, $newPassword);

//create query

$sql = "UPDATE users SET password='$newPassword' WHERE user_id='$userId'";
$result = mysqli_query($conn, $sql);

if(!$result){
	echo "ERROR: Could not update password on database!";
	exit;
	}

echo "success";


}//end of else if no errors







?>