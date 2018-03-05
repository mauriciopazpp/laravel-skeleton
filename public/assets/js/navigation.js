function continueNavigation()
{
  $(window).off('beforeunload');
}

function stopNavigation()
{
  $(window).on('beforeunload', function(){
    return '';
  });
}