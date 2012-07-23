/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function(){

var openZIMajaxLink = {

	setup: function() {
	  $(document).on("click", ".ajaxLink", function() {
	      if ( $.browser.msie )
	    	  return true;

	      var url = $(this).attr('href');
	      var loader = $(this).parent().next().find(".link_loader");
	      loader.show();
	      $.get( url, function(data) {
	    	  		  openZIMformsave.replaceForm(data);	    	  		  
	    		  	  loader.hide();
	    		  })
	    		  .error(function() {
	    			  window.document.location = url;
	    		  });
	      return false;
	  });
	}
}

openZIMajaxLink.setup();
});
