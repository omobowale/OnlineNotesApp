<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/styles.css" />
<title>contact</title>
</head>

<body>

<?php
session_start();
	include("header.php");
?>

<div class="container-fluid">
	<div class="row">
    	<div class="offset-1 col-10 offset-sm-2 col-sm-8 offset-md-3 col-md-6 contact-form">
	        <h2>Contact Us:</h2>
            
             <?php 
        	if(isset($_POST["submit"])){
				$error = "";
            	$name = $_POST["name"];
                $email = $_POST["email"];
				$message = $_POST["message"];
                $name = filter_var($name, FILTER_SANITIZE_STRING);
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);
				
				$message = filter_var($message, FILTER_SANITIZE_STRING);
				
				if (!isset($name) | $name==""){
					$error .= "<p>Name field should not be left blank</p>";
					}
					
				if ($email==""){
					$error .= "<p>Email field should not be left blank</p>";
					}
					
				if (!isset($message) | $message==""){
					$error .= "<p>Please enter the message to be sent</p>";
					}
				
				IF ($email!=""){	
				$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				
				if (!$email){
					$error .= "<p>Please enter a valid email address</p>";
					}
				}
				
				if ($error!=""){
					echo "<div class='alert alert-danger'>$error</div>";
					}
				else {
					echo "<div class='alert alert-success'>Details correctly filled and message ready to be sent</div>";
					}
    	        }
			
			
	        ?>
            
            <form method="post">
            	<div class="form-group">
            		<label for="name">Name:</label>
                	<input name="name" class="form-control" type="text" placeholder="Name" id="name" value="<?php echo isset($_POST['submit'])? $_POST['name']: ""?>" />
                <div>
                <div class="form-group">
                	<label for="email">Email:</label>
                	<input name="email" class="form-control" type="email" placeholder="Email" id="email" value="<?php echo isset($_POST['submit'])? $_POST['email']: ""?>" />
                </div>
                <div class="form-group">
                	<label for="message">Message:</label>
					<textarea name="message" class="form-control" rows="5" cols="40" id="message" placeholder="Please type your message here"><?php echo isset($_POST['submit'])? $_POST['message']: ""?></textarea>
                </div>
                
                <div class="form-group">
                	<button name="submit" type="submit" class="btn btn-light btn-lg btn-lg border">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
