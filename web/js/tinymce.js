function initTinyMce () {
        tinyMCE.init({
        	mode : "textareas",
	        theme : "advanced",
	        readonly : true
	});
}

$(document).ready(function()
{
  initTinyMce();

  $(document).ajaxComplete(function()
  {
    initTinyMce();
  });
});
