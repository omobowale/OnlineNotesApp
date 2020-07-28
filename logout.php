<?php
	session_start();
	session_destroy();
	setcookie(
		'always', '', time()-3600	
	);
	
	header('location: index.php');
?>
