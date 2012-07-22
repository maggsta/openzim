var openZIMtinyMceGZ = {
	config : {
	        plugins: "autosave, tinyautosave, paste,fullscreen, lists, save",
		themes : 'advanced',
		languages : 'de,en,fr',
		disk_cache : true,
		debug : false
	},
	setup : function () {
	  tinyMCE_GZ.init(this.gzConfig);
	}
}


$(document).ready(function()
{
  openZIMtinyMceGZ.setup();
  $(document).ajaxComplete(function()
  {
    openZIMtinyMceGZ.setup();
  });
});
