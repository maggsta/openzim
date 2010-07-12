/* 
 * Author: Ralph B. Magnus 
 * Date: 07.2010
 *
 */

function initExpander()
{
  $(".msg_content").hide();

  $(".msg_content:first").slideToggle(600); 

  $(".msg_head").click(function()
  {
    $(this).next(".msg_content").slideToggle(600);
  });
}

$(document).ready(function()
{
  initExpander(); 
  $(document).ajaxComplete(function()
  {
    initExpander();
  });

});
