/* 
 * Author: Ralph B. Magnus 
 * Date: 07.2010
 *
 */


function initExpander()
{
  $(".msg_content").hide();
  if ( ! $.cookies.test() ){
    $(".msg_content:first").slideToggle(600,callback); 
  }else{
     $(".msg_content").each(function()
     {
        var pos = $(".msg_content").index(this);
	var key = location.pathname+'/'+ pos;
        var display = $.cookies.get(key);
	if ( display == null ){
		if ( pos == 0 ){
    			$(this).slideToggle(600,function(){ 
		    		$.cookies.set(key, $(this).css('display'));
			});
		}else
		    	$.cookies.set(key, $(this).css('display'));
	}else{
		if ( display != 'none' )
			$(this).show();	
	}
	
     });
  }

  $(".msg_head").click(function()
  {
    $(this).next(".msg_content").slideToggle(600,function(){
    	$.cookies.set(location.pathname + '/'+$(".msg_content").index(this), $(this).css('display'));
    });
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
