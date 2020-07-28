

//Ajax call to updateusername.php
$("#updateusernameform").submit(function(event){
	event.preventDefault();
	var dataToPost = $(this).serializeArray();
	
	$.ajax({
		url: "updateusername.php",
		type: "POST",
		data: dataToPost,
		success: function(data){
			if (data){
				$("#usernameerroralert").html("<div class='alert alert-danger'>ERROR: Could not update username. Please try again later!</div>");
				}
			else{
				//$("#showsessiondetails").html(data);
				location.reload();
				}
			},
		error: function(){
				$("#usernameerroralert").html("<div class='alert alert-danger'>ERROR: Could not make Ajax call!</div>");
			}
	
	});
	
});



//Ajax call to updateemail.php


//Ajax call to validatecurrentpassword.php
$("#validatecurrentpasswordform").submit(function(event){
	event.preventDefault();
	var dataToPost = $(this).serializeArray();
	
	$.ajax({
		url: "validatecurrentpassword.php",
		type: "POST",
		data: dataToPost,
		success: function(data){
			if (data){
				$("#validatecurrentpassworderroralert").html("<div class='alert alert-danger'>" + data + "</div>");
				}
			else{
				$("#currentPasswordModal").modal("toggle");
				$("#updatePasswordModal").modal("toggle");
				}
			},
		error: function(){
				$("#passworderroralert").html("<div class='alert alert-danger'>ERROR: Could not make Ajax call!</div>");
			}
	
	});
	
});

//Ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){
	event.preventDefault();
	var dataToPost = $(this).serializeArray();
	
	$.ajax({
		url: "updatepassword.php",
		type: "POST",
		data: dataToPost,
		success: function(data){
			if (data == "success"){
				$("#updatePasswordModal").modal("toggle");
				$("#successalertContent").text("Your password has been successfully updated!!!");
				$("#successalert").show();
				}
			
			else{
				$("#passworderroralert").html("<div class='alert alert-danger'>" + data + "</div>");
				}
				
			
			},
		error: function(){
				$("#passworderroralert").html("<div class='alert alert-danger'>ERROR: Could not make Ajax call!</div>");
			}
	
	});
	
});	
//update profile picture
var file; var imageType; var imageSize; var wrongType;
$("#profileFile").change(function(){
	file = this.files[0];
	imageType = file.type;
	imageSize = file.size;
	
	var acceptableTypes = ["image/jpg", "image/jpeg", "image/png"];
	wrongType = ($.inArray(imageType, acceptableTypes) == -1);
	if (wrongType){
		$("#updateprofilepictureerroralert").html("<div class='alert alert-danger'>" + "Only jpeg, jpg and png files are accepted" +   "</div>");
		return false;
	}
	
	if(imageSize > 2*1024*1024){
		$("#updateprofilepictureerroralert").html("<div class='alert alert-danger'>" + "Please upload an image that is less than 2MB" +   "</div>");
		return false;
		}
	
	//read image file as binary and use it to change the source attribute of the img
	var reader = new FileReader();
	
	//
	reader.readAsDataURL(file);
	reader.onload = function(event){
		$("#picture").attr("src", event.target.result);
		};
	
	
	});


//update picture
$("#updateprofilepictureform").submit(function(){
	event.preventDefault();
	
	//check if there is file
	
	if(!file){
		$("#updateprofilepictureerroralert").html("<div class='alert alert-danger'>Please select an image</div>");	
		return false;
		}
		
	if (wrongType){
		$("#updateprofilepictureerroralert").html("<div class='alert alert-danger'>" + "Only jpeg, jpg and png files are accepted" +   "</div>");
		return false;
	}
	
	if(imageSize > 2*1024*1024){
		$("#updateprofilepictureerroralert").html("<div class='alert alert-danger'>" + "Please upload an image that is less than 2MB" +   "</div>");
		return false;
		}
	
	//$("#updateprofilepictureerroralert").html("<div class='alert alert-success'>Image ready for uploading</div>");
	
	$.ajax({
		
		url: "updatepicture.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		cache:false,
		processData:false,
		
		success: function(data){
			if(data){
				$("#updateprofilepictureerroralert").html('<div class="alert alert-danger"> ERROR: Profile picture could not be updated. Please try again later...</div>');
				}
			else{
				location.reload();
				}
			},
		error: function(){
			$("#updateprofilepictureerroralert").html('<div class="alert alert-danger">ERROR: The call to Ajax failed!!!</div>');
			}
		
		});
	
	});











	
	
	

