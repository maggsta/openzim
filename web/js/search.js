var doLoad = false;
var oldValue;

function doAjaxCall( value, action  ) {
      //alert('got argument:' + value+ ':' + action );
      $('#loader').show();
      $('#anlagen').load(
        action + ' #anlagen',
        { query: value + '*' },
        function() { $('#loader').hide(); }
      );
      doLoad = false;
}

$(document).ready(function()
{
  //$('.search input[type="submit"]').hide();
 
  $('#search_keywords').keyup(function(key)
  {
    if ( key.which != '8' && key.which != '46' && !doLoad )
	return;
    if ( (this.value.length >= 3 || this.value == '' ) && 
	   oldValue != this.value )
    {
	oldValue = this.value;
	doAjaxCall(this.value,
		$(this).parents('form').attr('action'));
    }
  });

  $('#search_keywords').keypress(function(key)
  {
    if (this.value.length >= 2)
    	doLoad = true;
  });
});
