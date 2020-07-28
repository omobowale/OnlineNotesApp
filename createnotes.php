<?php
session_start();

include('connection.php');

$userId = $_SESSION['user_id'];
$time = time();

$sql = "INSERT INTO notes (`user_id`,`note`,`time`) VALUES ($userId, '', $time)";
$result = mysqli_query($conn, $sql);

if(!$result){
	echo 'error';
	}
	
else{
	echo mysqli_insert_id($conn);
	}

?>