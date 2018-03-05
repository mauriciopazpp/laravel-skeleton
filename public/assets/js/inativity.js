/**
 * Inatividade
 */
var time = new Date().getTime();


jQuery(document).ready(function($) 
{
  setTimeout(refresh, 1000);
});

function refresh() 
{
  if(navigator.onLine){
    $(".navigator_online").addClass('text-success').removeClass('text-danger text-warning');;
    $(".navigator_status").html('Online');
    $(".alert-offline").hide('fadeIn');
  }
  if(!navigator.onLine){
    $(".navigator_online").removeClass('text-success text-warning').addClass('text-danger');;
    $(".navigator_status").html('Offline');
    $(".alert-offline").show('fadeIn');
  }

  if(new Date().getTime() - time >= 870000)
  {
      document.title = "A página irá atualizar em alguns segundos...";
      $(".alert-inativity").fadeIn('slow');
  } 
  if(new Date().getTime() - time >= 870000)
  {
      continueNavigation();
      window.location.reload(true);
  }else 
      setTimeout(refresh, 1000);
}

/**
 * Inatividade
 */

 function continueNavigation()
 {
   $(window).off('beforeunload');
 }
