/* 
 * Author: Ralph B. Magnus 
 * Date: 07.2010
 *
 */

function baseUrl() {
   var href = window.location.href.split('/');
   return href[0]+'//'+href[2]+'/';
}

function setBackground(elems, background){
	elems.css('background-image','url("' + baseUrl() +  '/images/' + background + '")');
}	
			
var openZIMExpander = {

		init: function() {
			  $(".msg_content").hide();
			  if ( ! $.cookies.test() ){
				  $(".msg_content:first").slideToggle(600,callback); 
			  }else{
				  $(".msg_content").each(function(){
			        var pos = $(".msg_content").index(this);
			        var key = location.pathname+'/'+ pos;
			        var display = $.cookies.get(key);
					if ( display == null ){
						if ( pos == 0 ){
				    		$(this).slideToggle(600,function(){ 
				    			setBackground($(this).parent().children('.msg_head'), 'div_opened.png');
								$.cookies.set(key, $(this).css('display'));
							});
						} else {
							setBackground($(this).parent().children('.msg_head'), 'div_closed.png');
						    $.cookies.set(key, $(this).css('display'));
						}
					}else{
						if ( display != 'none' ) {
							setBackground($(this).parent().children('.msg_head'), 'div_opened.png');
							$(this).show();
						} else {
							setBackground($(this).parent().children('.msg_head'), 'div_closed.png');
						}
					}				
			     });
			  }
		},
		
		setup: function() {
		
		  $(document).on('click', ".msg_head", function() { 
		    var state = $(this).next(".msg_content").css('display');
		    if( state == 'none' ) {
		    	setBackground($(this), 'div_opened.png');
		    } else {
		    	setBackground($(this), 'div_closed.png');	
		    }
		    $(this).next(".msg_content").slideToggle(600,function(){
		    	$.cookies.set(location.pathname + '/'+$(".msg_content").index(this), $(this).css('display'));
		    });
		  });
		  this.init();
	}
}

$(document).ready(function(){
	openZIMExpander.setup();
});
