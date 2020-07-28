<?php
//start session
session_start();

//connect to the database
include("connection.php");

//define error messages
$missingEmail = "<p>Please enter your email address</p>";
$missingPassword = "<p>Please enter your password</p>";


//define variables
$email = $_POST['loginemail'];
$password = $_POST['loginpassword'];
$error = "";
//get user inputs
if (empty($email)){
	$error.= $missingEmail;
	}
else {
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	}
if (empty($password)){
	$error.=$missingPassword;
	}
else{
	$password = filter_var($password, FILTER_SANITIZE_STRING);
	}
if(strlen($error) != 0){
	//print error message
	echo "<div class='alert alert-danger'>$error</div>";
	}
else{
	//prepare variables for sql 
	$email = mysqli_real_escape_string($conn, $email);
	$password = mysqli_real_escape_string($conn, $password);
	$password = hash('sha256', $password);
	
	//check if user is registered and activated
	$sql = "SELECT * FROM users WHERE (email='$email' AND password='$password' AND activation='activated')";
	$result = mysqli_query($conn, $sql) or die("ERROR: Could not execute query 1");
	
	$count = mysqli_num_rows($result);
	if($count !== 1){
		//display error message
		echo "<div>Wrong Email/Password combination. Check your details and try again!</div>";
		}
		
	else {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['username'] = $row['username'];
		
		
		//if keep-me-signed-in is not checked
		if (empty($_POST['always'])){
			echo "allset";
			}
			
		//else if keep-me-signed-in is checked
		else{
				//generate two random variables
				$var1 = bin2hex(openssl_random_pseudo_bytes(10));
				$var2 = openssl_random_pseudo_bytes(20);
				
				//write a function to merge the two variables
				function mergingOf($a, $b){
					$c = $a . bin2hex($b);
					return $c;
					}
				function encode($a){
					$b = hash('sha256', $a);
					return $b;
					}
					
				$value = mergingOf($var1, $var2);
				
				//store the merge of the two variables in a cookie
				setcookie(
					"always", $value, time() + 129600
				);
				
				//prepare all variables
				$userId = $_SESSION['user_id'];
				$f2var2 = encode($var2);
				$expiration = date("Y-m-d H:i:s", time() + 129600);
				
				//first delete any previous rememberme details // this should not be there though
				$sql = "DELETE FROM rememberme";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "<div class='alert alert-danger'>ERROR: Could not execute the delete query.</div>";
					exit;
					}
				
				//store all necessary details in the database
				$sql = "INSERT INTO rememberme (`authenticator1`, `f2authenticator2`, `user_id`, `expiration`) VALUES('$var1', '$f2var2', '$userId', '$expiration')";
				$result = mysqli_query($conn, $sql);
				
				if(!$result){
					echo "<div class='alert alert-danger'>ERROR: Could not execute query 2.</div>";
					}
				else{
					echo "allset";
					}
			}
		
		}
	
	
	
	
	
	
	
	
	
	}//end of else if no errors in user inputs.
	
	
?>