function initTinyMce () {
        tinyMCE.init({
        	mode : "textareas",
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,separator,undo,redo,separator,cut,copy,paste",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave",
	        theme_advanced_buttons1_add: "tinyautosave",
	        width: '100%',
		valid_elements : "-strong/b,p,-em,-span[style:text-decoration: underline;]"
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
