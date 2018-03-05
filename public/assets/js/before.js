var base_url = $('meta[name="base_url"]').attr('content');
var inApresentation = false;
var editor = null;
var key_medicine = 1;
var key_meals_nutri = 1;
var key_file = 1;

jQuery(document).ready(function($) {

  $( document ).tooltip();

  sidebar();

});

function sidebar()
{
  $.ajax({
      url: base_url + '/resolution',
      type: 'GET',
      data: {width:  screen.width, height: screen.height}
  });
  $(".sidebar-toggle").click(function(event) {
      $.ajax({
          url: base_url + '/sidebar-mini',
          type: 'GET',
          data: {position: $("body").hasClass("sidebar-collapse")}
      }).done(function(done){
        console.log("done:", done);
      });
  });
}

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

var toggleFx = function() {
  $.fx.off = !$.fx.off;
};

function toggleCheckbox(source) 
{
  var checkboxes = $(".checkbox");
  $.each(checkboxes, function(index, checkbox) 
  {
    checkbox.checked = source.checked;
    checkboxClick(checkbox);
  }); 
}