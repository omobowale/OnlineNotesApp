<?php
//check if user is not logged in and rememberme cookie is set
/*if(!isset($_SESSION['user_id'])){
		echo "<div class='alert alert-success'>User is logged in</div>";
		//exit;
	}
if(!empty($_COOKIE['always'])){
		echo "<div class='alert alert-success'>cookie is set</div>";
		//exit;
	}*/

if (!isset($_SESSION['user_id']) and !empty($_COOKIE['always']) | !empty($_COOKIE['always'])){
	
	//extract authenticators 1 and 2 from the cookie
	//list($auth1, $auth2) = explode(";", $_COOKIE['always']);
	$auth1 = substr($_COOKIE['always'], 0, 20);
	$auth2 = substr($_COOKIE['always'], 20, 40);
	echo $auth1;
	echo "<br>";
	echo $auth2;
	echo "<br>";
	echo strlen($auth1);
	echo "<br>";
	echo strlen($auth2);
	$auth2 = hex2bin($auth2);
	$f2auth2 = hash('sha256', $auth2);
	
	
	//search the database table to see if authenticator1 exists
	$sql = "SELECT * FROM rememberme WHERE authenticator1='$auth1'";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "<div class='alert alert-danger'>ERROR: Could not execute query</div>";
		exit;
		}
	
	//if it does exist
		$count = mysqli_num_rows($result);
		if ($count != 1){
			echo "<div class='alert alert-danger'>ERROR: Could not authenticate the remember me process!</div>";
			}
		else{
			//check if the corresponding authenticator2 matches the one extracted from cookie
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
		//if they match
			if($f2auth2 == $row['f2authenticator2']){
				$userId = $row['user_id'];
				echo "<br> User id is " . $userId . "<br>";
				
				//create session variables from the corresponding details on the users table
				$sql2 = "SELECT * FROM users WHERE user_id='$userId'";
				$result2 = mysqli_query($conn, $sql2);
				
				if (!$result2){
					echo "<div class='alert alert-danger'>ERROR: Process failed!</div>";
					exit;
					}
				$count2 = mysqli_num_rows($result2);
				echo "<br>" . $count2;
				if ($count2 != 1){
					echo "<div class='alert alert-danger'>ERROR: Failed!</div>";
					
					}
				else{
				$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
				$_SESSION['email'] = $row2['email'];
				$_SESSION['username'] = $row2['username'];
				$_SESSION['user_id'] = $row2['user_id'];
				//$email = $_SESSION['email'];
				 
				//generate new authenticators
				$auth1 = bin2hex(openssl_random_pseudo_bytes(10));
				$auth2 = openssl_random_pseudo_bytes(20);
				
				function mergeOf($a, $b){
					$c = $a . bin2hex($b);
					return $c;
					}
				function encode($a){
					$b = hash('sha256',$a);
					return $b;
					}
				//store them in both the database and the cookie
					$valueOfCookie = mergeOf($auth1, $auth2);
					//storing in a cookie
					setcookie(
						'always', $valueOfCookie, time() + 129600
					);
					//storing in the database
						//preparing the variables for query
						$f2auth2 = encode($auth2);
						
						$expiration = date("Y-m-d H:i:s", time() + 129600);
					$sql = "UPDATE rememberme SET authenticator1='$auth1',f2authenticator2='$f2auth2', expiration='$expiration' WHERE user_id='$userId'";
					if(!mysqli_query($conn, $sql)){
						echo "<div class='alert alert-danger'>ERROR: An error occured</div>";
						exit;
						}
					//log the user in
					header("location:homepage.php");
					//echo "<div class='alert alert-success'>User is remembered in in</div>";
						
					
				}
			}
		else{
			//else (if they don't match)
			//print an error message
			echo "<div class='alert alert-danger'>ERROR: Could not perform the remember-me process!</div>";
			}
		
		}
	}
	
else {
		//echo "<div class='alert alert-success'>User is not logged in</div>";
	//echo "The user id is ". $_SESSION['user_id'];
	//echo "<br> The remember me cookie value is " . $_COOKIE['always'];
	}


?>
