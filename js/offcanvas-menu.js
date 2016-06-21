menuButton = $('#openMenu');
menuWrapper = $('.menu-wrapper');
mainWrapper = $('.main-wrapper');
wrapperBackground = $('#wrapperBackground');

menuButton.click(function() {
  menuWrapper.attr('id', 'open');
  mainWrapper.attr('id', 'menuOpen');
  $('body').addClass('no-scroll');
})

wrapperBackground.click(function() {
  menuWrapper.removeAttr('id', 'open');
  mainWrapper.removeAttr('id', 'menuOpen');
  $('body').removeClass('no-scroll');
})
