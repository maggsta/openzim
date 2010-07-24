/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

var openZIMzimRemoveAnlage = {

	setup: function() {
	  $(".removeAnlage").click(function()
	  {
	      var url = $(this).attr('href');
	      $(this).parent().next().find(".remove_loader").show();
	      $("#form_data").load(
	        url + ' #form_data',
	        function(response, status, xhr) {
			if (status == "error") {
				window.document.location = url;
			}else
		      		$(this).parent().next().find(".remove_loader").hide();
		}
	      );
	      return false;
	  });
	}
}

$(document).ready(function()
{
  openZIMzimRemoveAnlage.setup();

  $(document).ajaxComplete(function()
  {
    openZIMzimRemoveAnlage.setup();
  });
});
