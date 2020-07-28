<?php
session_start();

include("connection.php");

//declare necessary variables

$id = $_POST['id'];

//prepare delete query
$sql = "DELETE FROM notes WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if(!$result){
	echo "error";
	}

?>