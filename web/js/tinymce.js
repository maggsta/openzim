
var openZIMtinyMce = {
	config : {
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,|,numlist,bullist,outdent,indent,|,undo,redo,|,cut,copy,pastetext,|,newdocument,tinyautosave,|,fullscreen, save",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave, paste,fullscreen, lists, save",
		tinyautosave_retention_minutes : 1440,
		tinyautosave_minlength : 10,
		paste_auto_cleanup_on_paste : true,
	        entity_encoding : "raw",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_path : false,
		cleanup_on_startup : true,
		save_enablewhendirty : true,
		save_onsavecallback : function(){ openZIMtinyMce.tinymcesave() },
		mode: "none",
//		theme_advanced_statusbar_location : "bottom",
		paste_preprocess : function(pl, o) {
        		o.content = o.content.replace(/&nbsp;/gi, ' '); 
		},
		setup : function(ed) {
			// Gets executed after DOM to HTML string serialization
			ed.onPostProcess.add(function(ed, o) {
				// State get is set when contents is extracted from editor
				if (o.get) {
					// Remove paragraphs in list elements
					o.content = o.content.replace(new RegExp( "<li>\n<p>", "g" ), '<li>');
					o.content = o.content.replace(new RegExp( "</p>\n</li>", "g" ), '</li>');
				}
			});
		},
		width: '100%',
		height: '200',
		valid_elements : "br,-strong/b,-ol,-ul,li,p,-em,-span[style:text-decoration: underline;]"
       	},

	configNoNumbering : {
		theme_advanced_buttons1 : "bold,italic,underline,|,undo,redo,|,cut,copy,pastetext,|,newdocument,tinyautosave,|,fullscreen, save",
		valid_elements : "-strong/b,p,-em,-span[style:text-decoration: underline;]"
	},

	selector: 'textarea:not(#sendie)',

	tinymcesave: function(){
		alert("saving");
	},

	removeEditors : function(){
		$(this.selector).each(function(){
			tinyMCE.execCommand('mceRemoveControl', true, this.id);
		});
	},

	resetDirty : function(){
		$(this.selector).each(function(){
			tinyMCE.get(this.id).isNotDirty = 1;
			tinyMCE.get(this.id).nodeChanged();
		});
	},

	customAddEditor : function ( config, elmID ) {

    	// create a new instance of tiny mce
		tinyMCE.settings = config;
		tinyMCE.execCommand('mceAddControl', true, elmID);
	},

	setup : function () {
	  var self = this;
	  $(this.selector).each(function(){
		var config = self.config;
		if ( $(this).hasClass('nonumbering'))
			config = $.extend({},self.config,self.configNoNumbering);

		self.customAddEditor(config, this.id); 
	  });
	} 
}

$(document).ready(function() {
  openZIMtinyMce.setup();
});
