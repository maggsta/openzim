var chat;
var name;

function initChat() {

	name = $.cookies.get("chatuser");        
	if(name == null || name === 'null') {
        	name = prompt("Enter your chat name:", "Guest");
                $.cookies.set("chatuser", name);        
	}

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

	if ($.cookies.get("chatstate") === 'shown') {
                $('#page-wrap').css('display', 'block');
                $('#show-chat').css('display', 'none');
        };

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
    
	$('#hide-chat').click(function() {
                $('#page-wrap').toggle();
                $('#show-chat').toggle();
		$.cookies.set("chatstate", "hidden");
        });

        $('#show-chat').click(function() {
                $('#page-wrap').toggle();
                $('#show-chat').toggle();
		$.cookies.set("chatstate", "shown");
        });

}

$(document).ready(function()
{
  initChat();
  setInterval('chat.update()', 10000);
});
