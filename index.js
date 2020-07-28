//AJAX call for the sign up form
//Once the form is submitted

$("#signupform").submit(function(event){
	
	//prevent default php processing
	event.preventDefault();
	
	var dataToPost = $(this).serializeArray();
	
	$.ajax({
		url: "signup.php",
		type:"POST",
		data:dataToPost,
		success:function(data){
			if(data){
				$("#signupmessagediv").html(data);
				}
			
			},
		error: function(){
				$("#signupmessagediv").html('<div class="alert alert-danger">There was an error with the Ajax call!</div>');
			}
		
		});
	});
	
	
//AJAX call for the login form
//once the login form is submitted
$("#loginform").submit(function(event){
	event.preventDefault();
	
	var dataToPost = $(this).serializeArray();
	
	$.ajax({
		url:"login.php",
		type:"POST",
		data:dataToPost,
		success:function(data){
			if(data=="allset"){
				window.location = "homepage.php";
				}
			else{
				$("#loginmessagediv").html("<div class='alert alert-danger'>" + data + "</div>");
				}
			
			},
		error:function(){
			$("#loginmessagediv").html('<div class="alert alert-danger">There was an error with the Ajax call!</div>');
			}
		
		});
	
	});
