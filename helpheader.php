<?php

include('retrievedata.php');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>profile</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/onlineNotes.css">
<script src="jq/jquery-3.3.1.min.js"></script>


</head>

<body>

<!--Our navigation bar section-->
<nav role="navigation" class="navbar navbar-dark navbar-expand-md bg-info">
	<div class="container-fluid">
        <a class="text-white navbar-brand">Online Notes</a>
        <button type="button" class="navbar-toggler" data-target="#navbarItem" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
        </button>
       
        <div class="collapse navbar-collapse" id="navbarItem">
        
                <ul class="nav navbar-nav">
                    <?php echo isset($username)? '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>' : "" ?>
                    <li style="background-color:#C82333;"  class="nav-item active"><a class="nav-link" href="help.php">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                     <?php echo isset($username)? '<li><a class="nav-link" href="homepage.php">My Notes</a></li>': "" ?>
                </ul> 
              <?php echo isset($username)? '<ul class="nav navbar-nav" id="toAdjust"><li class="nav-item border-right border-primary"><b class="nav-link">Logged in as ' .$username . '</b></li><li class="nav-item"><form action="logout.php"><button class="nav-link border-0 bg-info" type="submit">Logout</button></form></li></ul>' : '<ul class="nav navbar-nav" id="toAdjust"><li class="nav-item border-primary"><a href="index.php" class="nav-link">Go to login page</a></li></ul>'?>
        </div>  	
	</div>
</nav>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>