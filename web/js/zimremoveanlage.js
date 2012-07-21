/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function(){

var openZIMzimRemoveAnlage = {

	setup: function() {
	  $(document).on("click", ".removeAnlage", function() {
	      if ( $.browser.msie )
	    	  return true;

	      var url = $(this).attr('href');
	      var loader = $(this).parent().next().find(".remove_loader");
	      loader.show();
	      $.get( url, function(data) {
	    	  		  openZIMtinyMce.removeEditors();
	    		  	  $('#form_data').replaceWith($(data).find('#form_data'));
	    		  	  // re-init tiny mces
	    		  	  openZIMtinyMce.setup();
	    		  	  loader.hide();
	    		  })
	    		  .error(function() {
	    			  window.document.location = url;
	    		  });
	      return false;
	  });
	}
}

  openZIMzimRemoveAnlage.setup();
});
