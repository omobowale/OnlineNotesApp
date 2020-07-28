<?php
session_start();

include('connection.php');


//get userid
$userId = $_SESSION['user_id'];

//run query to delete empty notes
$sql = "DELETE FROM notes WHERE note=''";

$result = mysqli_query($conn, $sql);
if(!$result){
	echo "<div class='alert alert-danger'>ERROR: There was an error performing the delete query</div>";
	exit;
	}

//run query to look for user's notes
$sql = "SELECT * FROM notes where user_id='$userId' ORDER BY time DESC";
$result = mysqli_query($conn, $sql);
if (!$result){
	echo "<div class='alert alert-danger'>ERROR: There was an error performing the select query</div>";
	exit;
	}
$count = mysqli_num_rows($result);
if($count > 0){
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$note = $row['note'];
		$time = $row['time'];
		$note_id = $row['id'];
		$time = date("F d, Y h:i:s A", $time);
		
		echo "<div class='note row m-0'>
		 
		<div class='deleteButtonDiv'>
			<button type='button' class='btn btn-lg btn-danger'>delete</button>
		</div>
		
		<div class='noteContainer' id='$note_id'>
			<div class='noteSection'>$note</div>
			<div class='timeSection'>$time</div>	
		</div>
		
		</div>";
		
		}
	}
	
else {
	echo "<div class='alert alert-warning'>You have not created any notes yet</div>";
	exit;
	}

//show notes or show error message



?>