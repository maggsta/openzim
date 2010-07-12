function initTinyMce () {
        tinyMCE.init({
        	mode : "textareas",
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,separator,undo,redo,separator,cut,copy,paste",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave",
	        theme_advanced_buttons1_add: "tinyautosave",
	        width: '100%'
	});
}

$(document).ready(function()
{
  $(document).ajaxComplete(function()
  {
    initTinyMce();
  });
});
