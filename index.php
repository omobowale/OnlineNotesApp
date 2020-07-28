<?php



include("connection.php");


include("rememberme.php");

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Notes</title>
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
                    <li style="background-color:#C82333;" class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="help.php">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                </ul> 
              <ul class="nav navbar-nav" id="toAdjust"><li class="nav-item"><a class="nav-link" href="#loginModal" data-toggle="modal">Login</a></li></ul>
        </div>  	
	</div>
</nav>

<div style="color:white;" id="showWidth">
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="jumbotron">
                <h1>Online Notes App</h1>
                <p>Your Notes with you wherever you go.</p>
                <p>Easy to use! Protects all your Notes</p>
            </div>
            
            <button id="signUpButton" class="btn btn-lg btn-danger" data-target="#signUpModal" data-toggle="modal">Sign up - It's free!</button>
		</div>
    </div>
</div>



<!--sign up form-->
<div class="container">
	<form method="post" id="signupform">
		<div class="row">
			<div class="col-md-6">
                <div class="modal offset-sm-2 col-sm-8 offset-md-3 col-md-6" id="signUpModal">
                    <div class="modal-content">
                        <p class="modal-title modal-header">Sign Up Today and Start Using our Online Notes App
                        <button class="close" data-dismiss="modal">&times;</button></p>
                        <div id="signupmessagediv"></div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                  <label for="signupusername" class="sr-only">Username</label>
                                    <input type="text" id="signupusername" name="signupusername" class="form-control" placeholder="Username" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="signupemail" class="sr-only">Email</label>
                                    <input type="email" id="signupemail" name="signupemail" class="form-control" placeholder="Email" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="signuppassword" class="sr-only">Choose a password</label>
                                    <input type="password" id="signuppassword" name="signuppassword" class="form-control" placeholder="Choose a password" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="signuppassword2" class="sr-only">Re-enter password</label>
                                    <input type="password" id="signuppassword2" name="signuppassword2" class="form-control" placeholder="Confirm password" />
                                </div>
                                
                           
                        </div>  <!--modal body-->
                        
                        <div class="modal-footer">
                        	<button type="submit" name="signup" class="btn btn-info">sign up</button>
                        	<button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#signUpModal">cancel</button>
                        </div><!--modal footer-->
                    </div> <!--modal content--> 
				</div>
			</div>
		</div>
    </form>
</div>


<!--log in form-->
<div class="container">
	<form method="get" id="loginform">
		<div class="row">
			<div class="col-md-6">
                <div class="modal offset-sm-2 col-sm-8 offset-md-3 col-md-6" id="loginModal">
                    <div class="modal-content">
                        <p class="modal-title modal-header">Enter your details here to log in
                        <button class="close" data-dismiss="modal">&times;</button></p>
                        
                        <div class="modal-body">
                            <div id="loginmessagediv"></div>
                                <div class="form-group">
                                  <label for="loginemail" class="sr-only">Email</label>
                                    <input type="email" id="loginemail" name="loginemail" class="form-control" placeholder="Email" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="loginpassword" class="sr-only">Enter password</label>
                                    <input type="password" id="loginpassword" name="loginpassword" class="form-control" placeholder="Password" />
                                </div>
                                
                              	<div class="bg-dark">
                                    <div class="float-left">
                                        <label class="text-info" for="always">
                                        <input type="checkbox" id="always" name="always" /> Keep me signed in</label>
                                    </div>
                                    <div class="float-right"><a href="#forgotPasswordModal" data-dismiss="modal" data-toggle="modal">Forgot Password?</a></div>
                         		</div>
                            
                        </div>  <!--modal body-->
                        
                        <div class="modal-footer">
                        	<div class="register">
                            	<button type="button" class="btn border border-info" data-target="#signUpModal" data-toggle="modal" data-dismiss="modal">Register</button>
                            </div>
                            <div class="register2">
                            	<button type="submit" class="btn btn-info">log in</button>
                                <button type="button" class="btn border border-danger" data-dismiss="modal" data-target="#loginModal">cancel</button>
                                
                            </div>
                        </div><!--modal footer-->
                        
                    </div> <!--modal content--> 
				</div>
			</div>
		</div>
      </form>
</div>


<!--forgot password form-->
<div class="container">
		<div class="row">
			<div class="col-md-6">
                <div class="modal offset-sm-2 col-sm-8 offset-md-3 col-md-6" id="forgotPasswordModal">
                    <div class="modal-content">
                        <p class="modal-title modal-header">Enter your email address here to recover your password
                        <button class="close" data-dismiss="modal">&times;</button></p>
                        <div class="modal-body">
                            <form method="get">
                                
                                <div class="form-group">
                                    <label for="email" class="sr-only">Enter email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
                                </div>
                                
                            </form>
                        </div>  <!--modal body-->
                        
                        <div class="modal-footer">
                        	<div class="register">
                            	<button type="button" class="btn border border-info" data-dismiss="modal" data-target="#signUpModal" data-toggle="modal">Register</button>
                            </div>
                            <div class="register2">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-target="#forgotPasswordModal"> cancel</button>
                                <button type="button" class="btn btn-info">submit</button>
                            </div>
                        </div><!--modal footer-->
                        
                    </div> <!--modal content--> 
				</div>
			</div>
		</div>
</div>


<div class="container-fluid p-0 text-center">
	<footer class="bg-info text-white">Develop with us thewebdev@offyoucode.co.uk Copyright &copy; 2017-<?php echo date("Y")?> </footer>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script> 
	/*window.onresize = function(){
		$("#showWidth").text(window.innerWidth);
		}*/
</script>
</body>
</html>
