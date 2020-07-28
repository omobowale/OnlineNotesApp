<?php 
//starting session(session has already started @ profile.php)

if (isset($_SESSION['user_id'])){

include('connection.php');

//get session user_id
$user_id = $_SESSION['user_id'];


//get corresponding username and email
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

if(!$result){
	echo "ERROR: Unable to execute query";
	exit;
	}

$count = mysqli_num_rows($result);
if($count == 1){
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$username = $row['username'];
	$email = $row['email'];
	$picture = (in_array('profilepicture', $row)) ? $row['profilepicture'] : 'null';
	}
else {
	echo "ERROR: Unable to fetch result from database!";
	}
}

else{
	//header("location:test.php");
	}
?>