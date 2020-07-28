<?php
session_start();

include("connection.php");
$user_id = $_SESSION["user_id"];
$name  =  $_FILES["picture"]["name"];
$error = $_FILES['picture']['error'];

//print_r($_FILES);

$extension = pathinfo($name, PATHINFO_EXTENSION);
$temp_location = $_FILES["picture"]["tmp_name"];
$permanent_location = "profilepicture/" . md5(time()) . ".$extension";
$move_file = move_uploaded_file($temp_location, $permanent_location);
if($move_file){
	$sql = "UPDATE users SET profilepicture='$permanent_location' WHERE user_id='$user_id'";
	$result = mysqli_query($conn, $sql);
	
	if(!$result){
		echo "There was an error updating profile picture";
		}
}

if ($error > 0){
	echo "There was an error updating profile picture " . $error;
	}



?>