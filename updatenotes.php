<?php
session_start();

include('connection.php');

//get necessary variables from the Ajax call
$id = $_POST['id'];
$notecontent = $_POST['notecontent'];
$time = time();


//prepare variables for mysqli_operations
$notecontent = mysqli_real_escape_string($conn,$notecontent);

$sql = "UPDATE notes SET note='$notecontent', time='$time' WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if(!$result){
	echo 'error';
	}

?>