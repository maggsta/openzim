function setLinkEvents(){
  $('.pagination > a').click(function()
  {
      $('#paginate_loader').show();
      $('.paginatelist').load(
        $(this).attr('href') + ' .paginatelist', 
	function(){
	        $('#paginate_loader').hide();
	}
      );
      return false;
  });
}

$(document).ready(function()
{
  setLinkEvents();

  $(document).ajaxComplete(function()
  {
    setLinkEvents();
  });
});
