(function($) {
  // init off canvas nav
  $('.servicePage-cta-button, .overlay, .icon-close').on('click', function(){
    $('.overlay').toggleClass('is-active');
    $('.modal').toggleClass('is-active');
  });
})(jQuery);
