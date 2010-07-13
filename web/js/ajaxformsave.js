/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function()
{
  $('#ajax_form').submit(function()
  {
      $('.form_loader').show();
      
      // do not do ajax call if there are any
      // non-empty file inputs
      if ( $("input:file[value|='']").length > 0 )
	return true;
	
      tinyMCE.triggerSave(); 
      $('#form_data').load(
        $('#ajax_form').attr('action') + ' #form_data',
        $('#ajax_form').serializeArray(),
         function() { $('.form_loader').hide(); }
      );
      return false;
  });
});

