(function($) {
  // LEARN MORE CLICKED
$( "div[id^='serviceButton'], div[id^='serviceTitle']" ).click(function(){
  var id = $(this).attr('id').replace('serviceButton', '').replace('serviceTitle', '');

  $( "div[id^='serviceShort']" )
    .removeAttr("style")
    .removeClass("wow bounceInUp")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("div[id^='serviceShort']").addClass("hide").dequeue();
    });

  $("#serviceExpanded" + id + ", #serviceBack")
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceExpanded" + id).removeClass("hide").dequeue();
    });
});

// BACK ARROW CLICKED
$( "#serviceBack" ).click(function(){
  $(".service-expanded").not(".service-expanded.hide").add("#serviceBack")
    .removeAttr("style")
    .removeClass("animated bounceInLeft")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add(".service-expanded, #serviceBack").not(".service-expanded.hide").addClass("hide").dequeue();
    });

  $("div[id^='serviceShort']")
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("div[id^='serviceShort']").removeClass("hide").dequeue();
    });
});
})(jQuery);

(function($) {
  // init off canvas nav
  $('.siteHeader-navTrigger').on('click', function(){
    $('body').toggleClass('is-offCanvas');
  });

})(jQuery);
