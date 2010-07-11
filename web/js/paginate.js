function setLinkEvents(){
  $('.pagination > a').click(function()
  {
      $('#anlagen').load(
        $(this).attr('href') + ' #anlagen'
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
