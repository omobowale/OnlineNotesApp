

<?php
//starting a session
session_start();

//connect to the database
include "connection.php";


//define error messages
$missingUsername = "<p>Please enter your username</p>";
$missingEmail = "<p>Please enter your email address</p>";
$missingPassword = "<p>Please enter a password</p>";
$missingPassword2 = "<p>Please confirm your password</p>";
$noMatch = "<p>Passwords do not match</p>";
$invalidEmail = "<p>Please enter a valid email address</p>";
$invalidPassword = "<p>Please enter a valid password. Your password should be at least 8 characters long and include one capital letter and one number!</p>";


//declaring all variables
$username = $_POST["signupusername"];
$email = $_POST["signupemail"];
$password = $_POST["signuppassword"];
$password2 = $_POST["signuppassword2"];
$error = "";

if (empty($username)){
	$error.= $missingUsername;
	}
else {
	$username = filter_var($username, FILTER_SANITIZE_STRING);
	}
if (empty($email)){
	$error.= $missingEmail;
	}
else{
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error.=$invalidEmail;
		}
	}
if (empty($password)){
	$error.= $missingPassword;
	}
else {
	if (!(strlen($password)> 8 and preg_match('/[A-Z]/',$password) and preg_match('/[0-9]/',$password))){
		$error.= $invalidPassword;
		}
	else {
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		if (empty($password2)){
		$error.= $missingPassword2;
	}
		else{
			if($password2!=$password){
				$error.= $noMatch;
				}
			}
		}
	}
//if there are errors
if (strlen($error)!=0){
	$resultMessage = '<div class="alert alert-danger">' . $error .  '</div>';
	echo $resultMessage;
	}
//if no errors
else{
	
	
	//prepare variables to insert into the database
	$username = mysqli_real_escape_string($conn, $username);
	$email = mysqli_real_escape_string($conn, $email);
	$password = mysqli_real_escape_string($conn, $password);
	$password = hash('sha256', $password);
	
	//check if the username already exists
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "<div class='alert alert-danger'>ERROR: Unable to execute query</div>";
		exit;
		};
		
	$results = mysqli_num_rows($result);
	if ($results){
		echo "<div class='alert alert-danger'>The username you chose already exists. Do you want to log in instead?</div>";
		exit;
		}
	
	//check if email exists
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($conn, $sql);	
	if(!$result){
		echo "<div class='alert alert-danger'>ERROR: Unable to execute query</div>";
		exit;
		}
	
	$results = mysqli_num_rows($result);
	if($results){
		echo "<div class='alert alert-danger'>The email address already exists. Do you want to log in instead?</div>";
		exit;
		}
	
	//generate activation key
	$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
	
	//insert details into database
	$sql = "INSERT INTO users (username, email, password, activation) VALUES ('$username', '$email','$password','$activationKey')";
	if(!mysqli_query($conn, $sql)){
		echo "<div class='alert alert-danger'>ERROR: Unable to insert details into database</div>";
		exit;
		}
	
	//if the insertion into database is successful, 
	$resultMessage0 = "Click here to continue";
	$resultMessage1 = '<div class="alert alert-success">' . "Thanks for registering with us! A link has been sent to the email address you provided. Please check your email and click on the link to activate your account." . '</div>';
	$resultMessage = "http://localhost/www/onlineNotes/activate.php?email=".urlencode($email)."&key=$activationKey";
	echo '<div class="alert alert-success"><a href='. $resultMessage. '>' . $resultMessage0 . '</a><div>';
	//	echo $resultMessage;
	
	//0177505325
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//end of the if no error exists
	}

?>



