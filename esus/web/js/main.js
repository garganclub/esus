var animationNav = (function() {
  if ($(window).width() > 739) {
    var docElem = document.documentElement,
      nav = document.querySelector('#navbar'),
      didScroll = false,
      changeHeaderOn = 150;

    function init() {
      window.addEventListener('scroll', function(event) {
        if (!didScroll) {
          didScroll = true;
          setTimeout(scrollPage, 150);
        }
      }, false);

    }

    function scrollPage() {
      var sy = scrollY();
      if (sy >= changeHeaderOn) {
        classie.add(nav, 'navblack');
      } else {
        classie.remove(nav, 'navblack');
      }
      didScroll = false;
    }

    function scrollY() {
      return window.pageYOffset || docElem.scrollTop;
    }

    init();
  }
})();

// dropdown plugin appel
$('[data-toggle="dropdown"]').bootstrapDropdownHover({});

// // gestion du changement d'image chargé en fonction de la taille de l'écran (future implémentation)
// if ($(window).width() > 767) {
//     $("img[src$='medium']").each(function() {
//         var new_src = $(this).attr("src").replace('medium', 'mobile');
//         $(this).attr("src", new_src);
//     });
// }
