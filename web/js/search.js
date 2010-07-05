$(document).ready(function()
{
  //$('.search input[type="submit"]').hide();
 
  $('#search_keywords').keyup(function(key)
  {
    if (this.value.length >= 3 || this.value == '')
    {
      $('#loader').show();
      $('#anlagen').load(
        $(this).parents('form').attr('action') + ' #anlagen',
        { query: this.value + '*' },
        function() { $('#loader').hide(); }
      );
    }
  });
});
