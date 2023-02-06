(function () {
  "use strict";

  var carousels = function () {
    $(".owl-carousel1").owlCarousel({
      loop: true,
      center: true,
      margin: 0,
      smartSpeed: 1000,
      autoplay: true,
      responsiveClass: true,
      nav: false,
      dots: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        680: {
          items: 3,
          nav: false,
          loop: false
        },
        1000: {
          items: 4,
          nav: true
        }
      }
    });
  };

  (function ($) {
    carousels();
  })(jQuery);
})();
