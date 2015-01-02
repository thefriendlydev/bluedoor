(function($) {
  // init off canvas nav
  $('.servicePage-cta-button, .overlay, .icon-close').on('click', function(){
    $('.overlay').toggleClass('is-active');
    $('.modal').toggleClass('is-active');
  });
})(jQuery);

(function($) {
  // LEARN MORE CLICKED
$( "#serviceOneButton, #serviceOneTitle" ).click(function(){
  $( "#serviceOne, #serviceTwo, #serviceThree" )
    .removeAttr("style")
    .removeClass("wow bounceInUp")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceTwo, #serviceThree").addClass("hide").dequeue();
    });

  $('#serviceOneExpanded, #serviceOneBack')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOneExpanded").removeClass("hide").dequeue();
    });
});

$( "#serviceTwoButton, #serviceTwoTitle" ).click(function(){
  $( "#serviceOne, #serviceTwo, #serviceThree" )
    .removeAttr("style")
    .removeClass("wow bounceInUp")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOne, #serviceThree").addClass("hide").dequeue();
    });

  $('#serviceTwoExpanded, #serviceTwoBack')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceTwoExpanded").removeClass("hide").dequeue();
    });
});

$( "#serviceThreeButton, #serviceThreeTitle" ).click(function(){
  $( "#serviceOne, #serviceTwo, #serviceThree" )
    .removeAttr("style")
    .removeClass("wow bounceInUp")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceTwo, #serviceOne").addClass("hide").dequeue();
    });

  $('#serviceThreeExpanded, #serviceThreeBack')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceThreeExpanded").removeClass("hide").dequeue();
    });
});

// BACK ARROW CLICKED
$( "#serviceOneBack" ).click(function(){
  $( "#serviceOneExpanded, #serviceOneBack" )
    .removeAttr("style")
    .removeClass("animated bounceInLeft")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOneExpanded, #serviceOneBack").addClass("hide").dequeue();
    });

  $('#serviceOne, #serviceTwo, #serviceThree')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOne, #serviceTwo, #serviceThree").removeClass("hide").dequeue();
    });
});

$( "#serviceTwoBack" ).click(function(){
  $( "#serviceTwoExpanded, #serviceTwoBack" )
    .removeAttr("style")
    .removeClass("animated bounceInLeft")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceTwoExpanded, #serviceTwoBack").addClass("hide").dequeue();
    });

  $('#serviceOne, #serviceTwo, #serviceThree')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOne, #serviceTwo, #serviceThree").removeClass("hide").dequeue();
    });
});

$( "#serviceThreeBack" ).click(function(){
  $( "#serviceThreeExpanded, #serviceThreeBack" )
    .removeAttr("style")
    .removeClass("animated bounceInLeft")
    .addClass("animated bounceOutLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceThreeExpanded, #serviceThreeBack").addClass("hide").dequeue();
    });

  $('#serviceOne, #serviceTwo, #serviceThree')
    .removeAttr("style")
    .removeClass("animated bounceOutLeft")
    .addClass("animated bounceInLeft")
    .delay(500).queue(function(){
      $(this).add("#serviceOne, #serviceTwo, #serviceThree").removeClass("hide").dequeue();
    });
});

  // init off canvas nav
  $('.siteHeader-navTrigger').on('click', function(){
    $('body').toggleClass('is-offCanvas');
  });

})(jQuery);
