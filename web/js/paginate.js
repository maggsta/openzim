function setLinkEvents(){
  $('.pagination > a').click(function()
  {
      $('.paginatelist').load(
        $(this).attr('href') + ' .paginatelist'
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
