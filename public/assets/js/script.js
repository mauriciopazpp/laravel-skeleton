var iniciar = 0;

var segundo = 0+"0";
var minuto = 0+"0";
var hora = 0+"0"; 

$(document).ready(function($) 
{
    $("[data-toggle=popover]").popover();

    $(".modal-search-by-protocol").click(function(event) {
        $("#modal-search-by-protocol").modal('show');
    });

    loadSelect2();
    loadClock();
    loadSidebar();
    loadTabs();
    loadMasks();
});

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function formSendMail()
{
    var form = $( "#form-sending-mail" )[0].checkValidity();
    console.log("form:", form);
    if(form)
    {
        $(".sending-mail").prop("disabled", true);
        $(".sending-mail").html("Cancelando, aguarde......");
    }else{
        $(".sending-mail").prop("disabled", false);
        $(".sending-mail").html("Cancelar presença");      
    }
}

function split( val ) 
{
    return val.split( /,\s*/ );
}

function extractLast( term ) 
{
    return split( term ).pop();
}

function clickCid(id)
{
    $("#diagnostics").append('<div class="alert alert-link">'+
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">Remover &times;</button>'+
        '<strong>'+id+'</strong>'+
        '<input name="cids[]" type="hidden" value="'+cid+'">'+
        '</div>');
}

function loadSelect2()
{
    if($(".select2").length)
        $(".select2").select2();
}

function loadAjaxSetup()
{
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } } );
}

function loadClock() 
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
        var t = setTimeout(loadClock, 500);
    }
}

function checkTime(i) 
{
if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
return i;
}

function loadSidebar()
{  
    $("a").click(function(event) {
        if(!$("a").hasClass(".ajax"))
        {
            $(".logo-lg").addClass('animated');
            $(".logo-lg").addClass('fadeIn');
        }
    });

    $(".img-perfil").click(function(event) {
        window.location ="/user/" + user_id + "/edit";
    });

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

function continueNavigation()
{
    $(window).off('beforeunload');
}

function stopNavigation()
{
    $(window).on('beforeunload', function(){
        return 'Tem certeza?';
    });
}

function beforeUnload(count)
{
    if(count > 0){
        stopNavigation();
    }else{
        continueNavigation();
    }
}

function loadTabs()
{
    $.each($("a[role=tab]"), function(index, val) {
        if($(val).attr('href') == window.location.pathname)
            $(val).parent('li').addClass('active');
    });
}

function loadMasks()
{
    $('.time-mask').mask("00:00");
    if($('.datetime').length)
    {
        $('.datetime').mask("00/00/0000 00:00", {clearIfNotMatch: true});
        $('.competence').mask("00-0000");
        $('.protocol_mask').mask("00000000000000000000", {clearIfNotMatch: true});
        $("#ticks").mask("0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0");
    }
}

function getDay()
{
    var today = new Date();
    var dd = today.getDate();

    if(dd < 10)
        dd='0'+dd;

    return dd;
}

function getMonth()
{
    var today = new Date();
    var mm = today.getMonth()+1;

    if(mm < 10)
        mm='0'+mm;

    return mm;
}

function getYear()
{
    var today = new Date();
    return today.getFullYear();
}

function cronometro()
{
    if(iniciar != 0)
    {
        if (segundo < 59){
            segundo++
            if(segundo < 10){segundo = "0"+segundo}
        }else 
    if(segundo == 59 && minuto < 59)
    {
        segundo = 0+"0";
        minuto++;
        if(minuto < 10){minuto = "0"+minuto}
    }

    if(minuto == 59 && segundo == 59 && hora < 23)
    {
        segundo = 0+"0";
        minuto = 0+"0";
        hora++;
        if(hora < 10){hora = "0"+hora}
    }else 
    if(minuto == 59 && segundo == 59 && hora == 23)
    {
        segundo = 0+"0";
        minuto = 0+"0";
        hora = 0+"0";
    }
    $("#input-timer").val(hora +":"+ minuto +":"+ segundo);
    }else
        stopNavigation();     

    segundo = 0+"0";
    minuto = 0+"0";
    hora = 0+"0";

    clearInterval(timerId);
}
