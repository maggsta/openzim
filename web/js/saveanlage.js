/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function()
{
  $('#anlage_form').submit(function()
  {
      var doAjax = true;
      $('.anlage_loader').show();
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
        $('#anlage_form').attr('action') + ' #form_data',
        $('#anlage_form').serializeArray(),
         function() { $('.anlage_loader').hide(); }
      );
      return false;
  });
});

