/* 
 * Author: Ralph B. Magnus 
 * Date: 07.2010
 *
 */

$(document).ready(function()
{
  
  $(".msg_content").show();

  $(".msg_content").slideToggle(0);

  $(".msg_content:first").slideToggle(0); 

  $(".msg_head").click(function()
  {
    $(this).next(".msg_content").slideToggle(600);
  });

});
