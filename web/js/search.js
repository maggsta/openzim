var openZIMsearch = {

	doAjaxCall: function( value, action  ) {
      		$('#loader').show();
	      	$('#anlagen').load(
	        	action + ' #anlagen',
		        { query: value + '*' },
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
		action = $(this).parents('form').attr('action');
		// start new call with 1s delay
		self.timeoutID = window.setTimeout(function(){
					self.doAjaxCall(self.oldValue,action);
				}, 1000);
	    }
	  });

	  // fire for all keys except meta-keys
	  $('#search_keywords').keypress(function(key)
	  {
	    if (this.value.length >= 2)
	    	self.doLoad = true;
	  });
	}
}

$(document).ready(function()
{
  //$('.search input[type="submit"]').hide();
  openZIMsearch.setup();
});
