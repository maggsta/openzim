/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

$(document).ready(function()
{
  $('#anlage_form').submit(function()
  {
      $('.anlage_loader').show();
      $('#form_data').load(
        $('#anlage_form').attr('action') + ' #form_data',
        $('#anlage_form').serializeArray(),
         function() { $('.anlage_loader').hide(); }
      );
      return false;
  });
});

