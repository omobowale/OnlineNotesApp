<?php

//connect to server
$conn = mysqli_connect("localhost", "root", "147258stiga") or die("cannot connect to server " . mysqli_connect_error());

//echo "i got here";
//select database
$db = mysqli_select_db($conn, "onlinenotes");

//if database does not exist, create it
if (empty($db)){
	$sql = "CREATE DATABASE onlinenotes";
	$result = mysqli_query($conn, $sql); 
	if (!$result){
		echo "could not create database ";
		}
	else{
		echo "database successfully created ";
		
		//connect to the database
		$conn = mysqli_connect("localhost", "root", "147258stiga", "onlinenotes") or die("cannot connect to server " . mysqli_connect_error());
		
		//create table of users
		
		$sql = "SELECT 1 FROM `users` group by 1";
		$result = mysqli_query($conn, $sql);
		if ($result){
			echo "The table 1 exists ";
			exit;
			}
		else{
			//Table does not exist, create it
			//echo "i got here";
			$sql = "CREATE TABLE `users`(user_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(64) NOT NULL, activation CHAR(32) NOT NULL)";
			$result2 = mysqli_query($conn, $sql);
			if (!$result2){
				echo "table could not be created " . mysqli_error($conn);
				exit;
				}
			else{
				echo "table USERS successfully created ";
				}

		}
		
		//end of table users creation
		
		
			//create table of remember me
			
			$sql = "SELECT 1 FROM `rememberme` group by 1";
			$result = mysqli_query($conn, $sql);
			if ($result){
				echo "The table 2 exists ";
				exit;
				}
			else{
				//Table does not exist, create it
				//echo "i got here";
				$sql = "CREATE TABLE `rememberme`(id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, authenticator1 CHAR(20) NOT NULL, f2authenticator2 CHAR(64) NOT NULL, user_id INT(11) NOT NULL, expiration DATETIME NOT NULL)";
				$result2 = mysqli_query($conn, $sql);
				if (!$result2){
					echo "table REMEMBERME could not be created " . mysqli_error($conn);
					exit;
					}
				else{
					echo "table REMEMBERME successfully created ";
					}
			
			}
			
			//end of table rememberme creation
			
			//create table of forgotpassword
					$sql = "SELECT 1 FROM `forgotpassword` group by 1";
					$result = mysqli_query($conn, $sql);
					if ($result){
						echo "The table 3 exists ";
						exit;
						}
					else{
						//Table does not exist, create it
						//echo "i got here";
						$sql = "CREATE TABLE `forgotpassword`(id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, user_id INT(11) NOT NULL, keycode CHAR(32) NOT NULL, time INT(11) NOT NULL, status VARCHAR(7) NOT NULL)";
						$result2 = mysqli_query($conn, $sql);
						if (!$result2){
							echo "table could not be created " . mysqli_error($conn);
							exit;
							}
						else{
							echo "table FORGOTPASSWORD successfully created ";
							}
						
						}
			
			//end of table forgotpassword creation
			
			
			//create table of notes
					$sql = "SELECT 1 FROM `notes` group by 1";
					$result = mysqli_query($conn, $sql);
					if ($result){
						echo "The table 4 exists ";
						exit;
						}
					else{
						//Table does not exist, create it
						//echo "i got here";
						$sql = "CREATE TABLE `notes`(id INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT, user_id INT(4) NOT NULL, note TEXT NOT NULL, time INT(10) NOT NULL, status VARCHAR(7) NOT NULL)";
						$result2 = mysqli_query($conn, $sql);
						if (!$result2){
							echo "table could not be created" . mysqli_error($conn);
							exit;
							}
						else{
							echo "table NOTES successfully created ";
							}
						
						}
			
			//end of table forgotpassword creation
					
		}
	}

else{
	//connect to database
	$conn = mysqli_connect("localhost", "root", "147258stiga", "onlinenotes") or die("cannot connect to server " . mysqli_connect_error());
	}
?>