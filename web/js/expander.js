/* 
 * Author: Ralph B. Magnus 
 * Date: 07.2010
 *
 */


function setInitialState(callback)
{
    $(".msg_content").hide();

    $(".msg_content:first").slideToggle(600,callback); 
}

function initExpander()
{
  var firstVisit = false;
  if ( ! $.cookies.test() ){
	setInitialState();
  }else{
     $(".msg_content").each(function()
     {
        if ( firstVisit ) return;
        var display = $.cookies.get(location.pathname+$(".msg_content").index(this));
	if ( display == null ){
		firstVisit = true;
		// set initial cookies
		setInitialState( function() {
	    		$(".msg_content").each(function(){
    				$.cookies.set(location.pathname + $(".msg_content").index(this), $(this).css('display'));	
			});
		});
	}else{
		if ( display == 'none' ){
			$(this).hide();	
		}else{
			$(this).show();
		}
	}
	
     });
  }

  $(".msg_head").click(function()
  {
    $(this).next(".msg_content").slideToggle(600,function(){
    	$.cookies.set(location.pathname + $(".msg_content").index(this), $(this).css('display'));
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
