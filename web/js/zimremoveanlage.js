function setRemoveLinkEvents(){
  $(".removeAnlage").click(function()
  {
      $(this).parent().next().find(".remove_loader").show();
      $("#form_data").load(
        $(this).attr('href') + ' #form_data',
	function(){
      		$(this).parent().next().find(".remove_loader").hide();
	}
      );
      return false;
  });
}

$(document).ready(function()
{
  setRemoveLinkEvents();

  $(document).ajaxComplete(function()
  {
    setRemoveLinkEvents();
  });
});
