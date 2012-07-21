/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

var openZIMformsave = {
    autosave : 900000,
    
    replaceForm: function(data) {
    	openZIMtinyMce.removeEditors();
    	$('#form_data').replaceWith($(data).find('#form_data'));
    	// re-init tiny mces
    	openZIMtinyMce.setup();
    	// re init expanders
    	openZIMExpander.init();
    },
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
	      $.post( $('#ajax_form').attr('action') + '?random=' + Math.random()*99999,
	    		  $('#ajax_form').serializeArray(), function(data) {
	    	  		self.replaceForm(data);
	    	  		$('.form_loader').hide();
	    		  })
	    		  .error(function() {
	    			  self.ajaxError = true;
	    			  $('#ajax_form').submit();
	    		  });

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
		elem.keydown(function(event){
			if ((String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey) ||
					(event.which == 19)){
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

$(document).ready(function(){
	openZIMformsave.setup();
});

