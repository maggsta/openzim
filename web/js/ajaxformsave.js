/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

var openZIMformsave = {
        autosave : 900000,
	doSave: function() {
	     var self = this;
      	     $('.form_loader').show();
      
	      // do not do ajax call if there are any
	      // non-empty file inputs
	      if ( self.ajaxError || $.browser.msie || 
		   $("input:file[value|='']").length > 0 )
		return true;

	      self.ajaxError = false;

	      tinyMCE.triggerSave(); 
	      $('#form_data').load(
	        $('#ajax_form').attr('action') + '?random=' + Math.random()*99999 + ' #form_data',
	        $('#ajax_form').serializeArray(),
	         function(response, status, xhr) {
			if (status == "error") {
				self.ajaxError = true;
	  			$('#ajax_form').submit();
			}else
				$('.form_loader').hide(); 
		 }
	      );
	      return false;
	},

	cancel: function() {
	    if(typeof this.timeoutID == "number") {
	      window.clearTimeout(this.timeoutID);
	      delete this.timeoutID;
	    }
	},

	setTimeout: function() {
	  var self = this;
	  self.cancel();
	  self.timeoutID = window.setTimeout(function(){
		  $('#ajax_form').submit();
	  }, self.autosave);
	},

	setSaveEvent: function(elem){
		elem.keypress(function(event){
			if ((event.which == 115 && event.ctrlKey)){
				$('#ajax_form').submit();
				return false;
			}
		});
	},

	setup: function() {
	  var self = this;
	  self.setTimeout();
	  $('#ajax_form').submit(function() {
		self.setTimeout();
		return self.doSave();
	  });

	  // bind ctrl+s to tiny mces
	  tinyMCE.onAddEditor.add(function(mgr,ed) {
		  ed.onInit.add(function(ed) {
			  self.setSaveEvent($(ed.getDoc()));
		  });
	  });

	  // bind ctrl+s to the document
	  this.setSaveEvent($(document));
	}
}

$(document).ready(function()
{
	openZIMformsave.setup();
});

