function replaceLinks(){
  $('.pagination > a').each(function(){
	$(this).data('href',$(this).attr('href'));
  	$(this).removeAttr('href');
  });

}

function setLinkEvents(){
  $('.pagination > a').click(function(key)
  {
      replaceLinks();
      $('#anlagen').load(
        $(this).data('href') + ' #anlagen'
      );
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
