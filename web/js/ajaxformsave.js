/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function()
{
  $('#ajax_form').submit(function()
  {
      var doAjax = true;
      $('.form_loader').show();
      $("input:file").each(function(){
         if ( $(this).val() != '' ){
   		doAjax = false;
		return;
	 }
      });
      if ( !doAjax )
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

