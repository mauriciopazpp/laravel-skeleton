
$(function() 
{
  showClock();
  loadSidebar();
});

function showClock() 
{
  if($("#clock").length)
  {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(showClock, 500);
  }
}

function checkTime(i) 
{
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

function loadSidebar()
{  
  $.each($(".sidebar-menu li a"), function(index, val) {
    if(val.href == "http://"+location.hostname + location.pathname)
    {
      $(this).parent().addClass('active');
    }   
  });

  $.each($(".treeview ul li a"), function(index, val) {
    if(val.href == "http://"+location.hostname + location.pathname)
    {
      $(this).parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().addClass('active');
    }   
  });

  $.each($(".treeview .treeview-menu li ul li a"), function(index, val) {
    if(val.href == "http://"+location.hostname + location.pathname)
    {
      $(this).parent().addClass('active');
      $(this).parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().addClass('active');
      $(this).parent().parent().parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().parent().parent().addClass('active');
    }   
  });

  $.each($(".treeview .treeview-menu li .treeview-menu li ul li a"), function(index, val) {
    if(val.href == location.pathname)
    {
      $(this).parent().addClass('active');
      $(this).parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().addClass('active');
      $(this).parent().parent().parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().parent().parent().addClass('active');
      $(this).parent().parent().parent().parent().parent().parent().addClass('menu-open');
      $(this).parent().parent().parent().parent().parent().parent().parent().addClass('active');
    }   
  });
}