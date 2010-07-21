function initTinyMce () {
        tinyMCE.init({
        	mode : "textareas",
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,separator,undo,redo,separator,cut,copy,pastetext,separator,newdocument,tinyautosave",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave, paste",
		paste_auto_cleanup_on_paste : true,
		paste_preprocess : function(pl, o) {
        		o.content = o.content.replace(/&nbsp;/gi, ' '); 
		},
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
