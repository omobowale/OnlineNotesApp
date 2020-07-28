<?php

session_start();

if (!isset($_SESSION['user_id'])){
	header("location:index.php");
}

include('retrievedata.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Notes</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/onlineNotes.css">
<script src="jq/jquery-3.3.1.min.js"></script>

<style>

	.noteContainer{
		border-radius:15px;
		background:linear-gradient(to bottom, #999, #CCC);
		margin:15px 0;
		padding:0 10px;
		cursor:pointer;
		width:100%;
		}
		
	.noteSection{
		color:purple;
		font-size:20px;
		overflow:hidden;
		white-space:nowrap;
		text-overflow:ellipsis;
		}
		
	.timeSection{
		font-size:13px;
		overflow:hidden;
		white-space:nowrap;
		text-overflow:ellipsis;
		}
		
	.deleteButtonDiv{
		display:none;
		}
	
	
	
</style>

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
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="help.php">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li style="background-color:#C82333;" class="nav-item active"><a class="nav-link" href="#">My Notes</a></li>
                </ul> 
              <ul class="nav navbar-nav" id="toAdjust">
              	<li class="nav-item"><a class="nav-link" href="#"><img class="preview" src="images/Jellyfish.jpg"/></a></li>
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
       		 <div class="offset-xs-1 col-xs-10 offset-md-2 col-md-8">
                 <div id="erroralert" class="alert alert-danger collapse">
					  <a class="close" data-dismiss="alert">&times;</a>
                      <p id="erroralertContent"></p>
                 </div>
                 <div id="successalert" class="alert alert-success collapse">
					  <a class="close" data-dismiss="alert">&times;</a>
                      <p id="successalertContent"></p>
                 </div>
             
                <div class="buttons">
                    <button id="allnotes" type="button" class="btn btn-info">All Notes</button>
                    <button id="addnote" type="button" class="btn btn-info">Add Note</button>
                    <button id="edit" type="button" class="btn btn-info float-right">Edit</button>
                    <button id="done" type="button" class="btn btn-success float-right mr-1">Done</button>
                </div>
        		<div id="notePad" class="textarea">
        			<textarea rows="12"></textarea>
       			</div>
                
          
                    <div id="notes" class="notes">
                        <!--Ajax call to PHP files-->
                    </div>
           
           </div>
    </div>
</div>





<div class="container-fluid p-0 text-center">
	<footer class="bg-info text-white">Develop with us thewebdev@offyoucode.co.uk Copyright &copy; 2017-<?php echo date("Y")?> </footer>
</div>
<script src="js/bootstrap.min.js"></script>
<script>
 /*
	window.onresize = function(){
		$("#showWidth").text(window.innerWidth);
		}
		*/
</script>
<script src="myNotes.js"></script>
</body>
</html>
