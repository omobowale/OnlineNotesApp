<?php

session_start();

if (!isset($_SESSION['user_id'])){
	//echo 'it is set and the value is ' . $_SESSION['user_id'];
	header("location:index.php");
}

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
                    <li style="background-color:#C82333;" class="nav-item active"><a class="nav-link" href="#">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="help.php">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li><a class="nav-link" href="homepage.php">My Notes</a></li>
                </ul> 
              <ul class="nav navbar-nav" id="toAdjust">
              	<!-- <li class="nav-item"><a class="nav-link" href="#">
                	<div data-toggle="modal" data-target="#profilePictureModal">
                		 <?php
						if(empty($picture)){
						 echo "<img class='preview' src='images/Jellyfish.jpg'/>";
						}
						else{
						 echo "<img class='preview' src='$picture'/>";					
							}
                		?>
                    </div></a>
                </li> -->
              	<li class="nav-item border-right border-primary"><a class="nav-link">Logged in as <?php echo isset($username)? $username: "Unnamed" ?></a></li>
              	<li class="nav-item"><form action="logout.php"><button class="nav-link border-0 bg-info" type='submit'>Logout</button></form></li>
              </ul>
        </div>  	
	</div>
</nav>

<div style="color:white;" id="showWidth">
</div>

<div class="container-fluid">
	
	<div class="row">
       		 <div class="offset-xs-0 col-xs-12 offset-sm-2 col-sm-10 offset-md-3 col-md-8 pt-5 profile-table">
                <h2 class="text-info"><strong>General Account Settings:</strong></h2>
                <div id="successalert" class="alert alert-success collapse">
					  <a class="close" data-dismiss="alert">&times;</a>
                      <p id="successalertContent"></p>
                 </div>
               
                <div style="cursor:pointer" class="table-responsive text-white table-md">
                	<table class="table table-hover table-borderless">
                    	<tr data-target="#usernameModal" data-toggle="modal"><td><strong>Username</strong></td><td><?php echo isset($username)? $username : "-" ?></td></tr>
                        <tr data-target="#emailModal" data-toggle="modal"><td><strong>Email</strong></td><td><?php echo isset($email)? $email: "-" ?></td></tr>
                        <tr data-target="#currentPasswordModal" data-toggle="modal"><td><strong>Password</strong></td><td>hidden</td></tr>
                    </table>
                </div>
                
           </div>
    </div>
</div>

<div class="modal offset-xs-1 col-xs-10 offset-md-2 col-md-8" id="usernameModal">
	<form method="post" id="updateusernameform">
	<div class="modal-content">
        	<p class=" modal-header modal-title">Edit Username:<button class="close" data-dismiss="modal">&times;</button></p>
        <div class="modal-body">
        	<div id="usernameerroralert"></div>
                 
        	<div class="form-group">
            	<label for="username">Username:</label>
            	<input type="text" id="username" name="username" class="form-control" placeholder="<?php echo isset($username)? $username : "-"?>">
            </div>
        </div>
        
        <div class="modal-footer">     
        		<button type="submit" class="btn btn-info" id="updateusernamebutton">submit</button> 	
                <button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#usernameModal">cancel</button>
                
        </div>
    </div>
    </form>
</div>

<div class="modal offset-xs-1 col-xs-10 offset-md-2 col-md-8" id="emailModal">
	<form id="updateemailform" method="post">
	<div class="modal-content">
        	<p class=" modal-header modal-title">Edit Email:<button class="close" data-dismiss="modal">&times;</button></p>
        <div class="modal-body">
        <div id="emailerroralert"></div>
        	<div class="form-group">
            	<label for="email">Email:</label>
            	<input type="email" id="email" name="email" class="form-control" placeholder=<?php echo isset($email)? $email: "-"?>>
            </div>
        </div>
        
        <div class="modal-footer">
        		<button type="submit" class="btn btn-info" id="updateemailbutton">submit</button>      	
                <button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#emailModal">cancel</button>
        </div>
    </div>
    </form>
</div>

<div class="modal offset-xs-1 col-xs-10 offset-md-2 col-md-8" id="currentPasswordModal">
	<form id="validatecurrentpasswordform" method="post">
	<div class="modal-content">
        	<p class=" modal-header modal-title">Edit Password:<button class="close" data-dismiss="modal">&times;</button></p>
        <div class="modal-body">
        <div id="validatecurrentpassworderroralert"></div>
        	<div class="form-group">
            	<label for="password1" class="sr-only">Password:</label>
            	<input type="password" id="password1" name="password1" class="form-control" placeholder="Enter current password">
            </div>
        </div>
        
        <div class="modal-footer">
        		<button type="submit" class="btn btn-info" id="updatepasswordbutton">submit</button>      	
                <button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#currentPasswordModal">cancel</button>
                
        </div>
    </div>
    </form>
</div>


<div class="modal offset-xs-1 col-xs-10 offset-md-2 col-md-8" id="updatePasswordModal">
	<form id="updatepasswordform" method="post">
	<div class="modal-content">
        	<p class="modal-header modal-title">Enter Current and New Passwords:<button class="close" data-dismiss="modal">&times;</button></p>
        <div class="modal-body">
        <div id="passworderroralert"></div>
            <div class="form-group">
            	<label for="password2" class="sr-only">Enter New Password</label>
            	<input type="password" id="password2" name="password2" class="form-control" placeholder="Choose a new password">
            </div>
            <div class="form-group">
            	<label for="password3" class="sr-only">Re-enter New Password</label>
            	<input type="password" id="password3" name="password3" class="form-control" placeholder="Confirm new password">
            </div>
        </div>
        
        <div class="modal-footer">       	
        		<button type="submit" class="btn btn-info">submit</button>
                <button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#updatePasswordModal">cancel</button>
        </div>
    </div>
    </form>
</div>

<div class="modal offset-xs-1 col-xs-10 offset-md-3 col-md-6" id="profilePictureModal">
	<form id="updateprofilepictureform" method="post" enctype="multipart/form-data">
        <div class="modal-content">
        	<p class="modal-header modal-title">Upload Picture<button class="close" data-dismiss="modal">&times</button></p>
            <div class="modal-body">
            	<div id="updateprofilepictureerroralert"></div>
            	<div class="profilePicture mb-5">
               <!-- <?php
				if(empty($picture)){
                 echo "<img id='picture' class='picture' src='images/Jellyfish.jpg'/>";
				}
				else{
                 echo "<img id='picture' class='picture' src='$picture'/>";					
					}
                ?> -->
				</div>
                  <div class="form-inline form-group">
                	<label class="d-block" for="profileFile">Choose a file:</label>
                	<input id="profileFile" class="form-control btn btn-info" name="picture" type="file" />
                  </div>
              
               
            </div>
            <div class="modal-footer">
            	<button class="btn btn-info" type="submit">Upload</button>
                <button class="btn border-danger" data-dismiss="modal" data-target="#profilePictureModal">Cancel</button>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid p-0 text-center">
	<footer class="bg-info text-white">Develop with us thewebdev@offyoucode.co.uk Copyright &copy; 2017-<?php echo date("Y")?> </footer>
</div>
<script src="js/bootstrap.min.js"></script>
<script> 
	/*window.onresize = function(){
		$("#showWidth").text(window.innerWidth);
		}*/
</script>
<script src="profile.js"></script>
</body>
</html>
