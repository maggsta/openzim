var chat;
var name;

function initChat() {
	name = getUser();//prompt("Enter your chat name:", "Guest");

	// default name is 'Guest'
	if (!name || name === ' ') {
		name = "Guest";      
	}
	// strip tags
	name = name.replace(/(<([^>]+)>)/ig,"");

	// display name on page
	$("#name-area").html("You are: <span>" + name + "</span>");

	// kick off chat
	chat =  new Chat();

	// chat.getState(); 

	// watch textarea for key presses
	$("#sendie").keydown(function(event) {  
		var key = event.which;  
	 	//all keys including return.  
	 	if (key >= 33) {
	     		var maxLength = $(this).attr("maxlength");  
	     		var length = this.value.length;  
	     
	     		// don't allow new content if length is maxed out
	     		if (length >= maxLength) {  
		 		event.preventDefault();  
	     		}  
	  	}  
	});

 	// watch textarea for release of key press
	$('#sendie').keyup(function(e) {       
		if (e.keyCode == 13) { 
			var text = $(this).val();
			var maxLength = $(this).attr("maxlength");  
			var length = text.length; 
			// send 
			if (length <= maxLength + 1) { 
				chat.send(text, name);  
				$(this).val("");
			} else {
				$(this).val(text.substring(0, maxLength));
			}       
		}
	});
    
}

function getUser() {
   return window.location.hostname;
}

$(document).ready(function()
{
  initChat();
  setInterval('chat.update()', 10000);
});
