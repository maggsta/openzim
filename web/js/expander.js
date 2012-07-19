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
		    		$(this).parent().children('.msg_head').css('background-image','url("' + baseUrl() +  '/images/div_opened.gif")');
				$.cookies.set(key, $(this).css('display'));
			});
		} else {
			$(this).parent().children('.msg_head').css('background-image','url("' + baseUrl() +  '/images/div_closed.gif")');
		    	$.cookies.set(key, $(this).css('display'));
		}
	}else{
		if ( display != 'none' ) {
			$(this).parent().children('.msg_head').css('background-image','url("' + baseUrl() +  '/images/div_opened.gif")');
			$(this).show();
		} else {
			$(this).parent().children('.msg_head').css('background-image','url("' + baseUrl() +  '/images/div_closed.gif")');
		}
	}
	
     });
  }

  $(".msg_head").click(function()
  { 
    var state = $(this).next(".msg_content").css('display');
    if( state == 'none' ) {
	$(this).css('background-image','url("' + baseUrl() +  '/images/div_opened.gif")');
    } else {
        $(this).css('background-image','url("' + baseUrl() +  '/images/div_closed.gif")');	
    }
    $(this).next(".msg_content").slideToggle(600,function(){
	$.cookies.set(location.pathname + '/'+$(".msg_content").index(this), $(this).css('display'));
    });
  });
}

function baseUrl() {
   var href = window.location.href.split('/');
   return href[0]+'//'+href[2]+'/';
}

$(document).ready(function()
{
  initExpander(); 
  $(document).ajaxComplete(function()
  {
    initExpander();
  });

});
