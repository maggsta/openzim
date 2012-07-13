var openZIMsearch = {

	doAjaxCall: function( value, action  ) {
      		$('#loader').show();
	      	$('#anlagen').load(
	        	action + ' #anlagen',
		        { query: value + '*',
	        	  zim: $('#zim').attr('value') },
		        function() {
			   $('#loader').hide();
			}
	        );
	        this.doLoad = false;
	},
	
	cancel: function() {
	    if(typeof this.timeoutID == "number") {
	      window.clearTimeout(this.timeoutID);
	      delete this.timeoutID;
	    }
	},

	setup: function() {
	  var self = this;
	  self.action = $('#search_keywords').parents('form').attr('action');
	  self.oldValue = $('#search_keywords').attr('value');
	  $('#search_keywords').keyup(function(key)
	  {
	    // only react for backspace and delete
	    if ( key.which != '8' && key.which != '46' && !self.doLoad )
		return;
	    if ( (this.value.length >= 3 || this.value == '' ) && 
	    		self.oldValue != this.value )
	    {
	    	// cancel pending ajax calls
	    	self.cancel();
	    	self.oldValue = this.value;
	    	// start new call with 1s delay
	    	self.timeoutID = window.setTimeout(function(){
	    		self.doAjaxCall(self.oldValue, self.action);
	    	}, 1000);
	    }
	  });

	  // fire for all keys except meta-keys
	  $('#search_keywords').keypress(function(key)
	  {
	    if (this.value.length >= 2)
	    	self.doLoad = true;
	  });
	  
	  $('#zim').change(function(){
		  self.doAjaxCall(self.oldValue, self.action);
	  });
	}
}

$(document).ready(function()
{
  //$('.search input[type="submit"]').hide();
  openZIMsearch.setup();
});
