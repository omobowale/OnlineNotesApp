$(function(){
	
	//declare necessary variables
	var activeNote = 0;
	var editMode = false;
	
	
	//Ajax call to loadnotes.php
	loadNotes();
	
	//when the user clicks on add note buttons
	$("#addnote").click(function(){
		//Make an Ajax call to createnotes.php
		$.ajax({
			url: "createnotes.php",
			
			success: function(data){
				if (data == 'error'){
					//display the error on an alert box on the page
					$("#erroralertContent").text('There was an error adding the new note to the database');
					$("#erroralert").fadeIn();
					}
				else{
				//do something else
					
					activeNote = data;
					$("textarea").val("");
					showHideElements(["#notePad","#allnotes"],["#addnote", "#notes", "#edit", "#done"]);
					$("textarea").focus();	
					$("#successalertContent").text('Notes will be automatically saved!');
					$("#successalert").fadeIn();
					}
				},
				
				error:function(){
					$("#erroralertContent").text('An error occured!');
					$("#erroralert").fadeIn();
					}
			});
		
		
		});
		
		//when the user clicks on the all notes button
		$("#allnotes").click(function(){
			editMode = false;
			$.ajax({
				url: "loadnotes.php",
				success: function(data){
					$("#notes").html(data);
					showHideElements(["#addnote", "#notes", "#edit"], ["#allnotes", "#done", "#notePad"]);
					noteClicked();
					deleteButtonClicked();
					},
				error: function(){
					$("#notes").html("There was an error with the Ajax call");
					}
			
			});
			
			});
			
		//when the user starts typing
		$("textarea").keyup(function(){
			$.ajax({
				url: "updatenotes.php",
				type: "POST",
				data: {notecontent:$(this).val(), id:activeNote},
				success: function(data){
					if(data == 'error'){
						$("#erroralertContent").text("ERROR: Could not update note. Please try again later!");
						$("#erroralert").show();
						}
					else{
						$("#successalertContent").text("Note successfully saved!");
						$("#successalert").show();
						}
					},
				error: function(){
					$("#erroralertContent").text("ERROR: Could not make a successful Ajax call!");
					$("#erroralert").show();
					}
				
				});
			
			});
			
		//when the user clicks on the edit button
		$("#edit").click(function(){
			editMode = true;
			$(".deleteButtonDiv").addClass("col-xs-5 col-sm-2 mt-3 p-0");
			$(".noteContainer").addClass("col-xs-7 col-sm-10");
			showHideElements(["notes", ".deleteButtonDiv", "#done", "#addnote"],[this, "#notePad", "allnotes",])
			});
			
		//when the user clicks on the done button
		$("#done").click(function(){
			editMode = false;
			showHideElements(["notes", "#edit", "#addnote"],[this, "#notePad", ".deleteButtonDiv", "allnotes",])
			loadNotes();
			});
	
	
	
		//ALL FUNCTIONS GO IN HERE
		
		//function to load notes.
		function loadNotes(){
		$.ajax({
			url: "loadnotes.php",
			success: function(data){
				$("#notes").html(data);
				noteClicked();
				deleteButtonClicked();
				},
			error: function(){
				$("#notes").html("There was an error with the Ajax call");
				}
			
			});
	}
		//when user clicks on any of the notes
		function noteClicked(){
			$(".noteContainer").click(function(){
				
				if(!editMode){
					
					//set the activeNote id to the id of the clicked note
					activeNote = $(this).attr("id");
					
					//set the content of the text area to the content of the clicked note
					$("textarea").val($(this).find(".noteSection").text());
					showHideElements(["#notePad","#allnotes"],["#addnote", "#notes", "#edit", "#done"]);
					$("textarea").focus();	
					$("#successalertContent").text('You can now edit your note!');
					$("#successalert").fadeIn();
					}
				
				});
		}
		
		//when the user clicks on the delete button
		function deleteButtonClicked(){
			$(".deleteButtonDiv").click(function(){
				deleteButton = $(this);
				deleteButtonId = $(this).next().attr("id");
				
				$.ajax({
					url:"deletenotes.php",
					type:"POST",
					data: {id:deleteButtonId},
					success: function(data){
						if (data == 'error'){
							$("#erroralertContent").text('ERROR: Could not delete note. Please try again later!');
							$("#erroralert").fadeIn();
							}
						else{
						
							//alert("The id is " + activeNote);	
							deleteButton.parent().remove();
							}
						},
					error: function(){
						$("#erroralertContent").text('ERROR: Ajax call failed!');
						$("#erroralert").fadeIn();
						}
					});
				
				});
			
			}
		
		//declaring all functions here
		function showHideElements(arr1, arr2){
			for(i=0; i<arr1.length; i++){
				$(arr1[i]).show();
				}
				
			for(i=0; i<arr2.length; i++){
				$(arr2[i]).hide();
				}
		}
	
});