$(document).ready(function() {
  var triggeredModalOnce = false

  if (!triggeredModalOnce) {
    $(window).scroll(openModal);
  }

  function openModal() {
    console.log(triggeredModalOnce);
    if ( ($('#modal-opener').isOnScreen() == true ) && (!triggeredModalOnce) ) {
      $("body").addClass("modal-open");
      $('#seo-modal').prop('checked', true);
      triggeredModalOnce = true;
    }
  }

  $('#seo-modal').on('change', function() {
    if ($(this).is(':checked')) {
      $('body').addClass('modal-open');
    } else {
      $('body').removeClass('modal-open');
    }
  });

  $('.modal-fade-screen, .modal-close').on('click', function() {
    $('.modal-state:checked').prop('checked', false).change();
  });

  $('.modal-inner').on('click', function(e) {
    console.log('clickededd');
    e.stopPropagation();
  });

  $.fn.isOnScreen = function(){
    var win = $(window);
    var viewport = {
      top : win.scrollTop(),
      left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
  };
});
