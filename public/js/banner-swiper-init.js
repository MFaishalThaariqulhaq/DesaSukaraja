document.addEventListener('DOMContentLoaded', function () {
  if (typeof Swiper === 'undefined') return;

  new Swiper('.hero-swiper', {
    loop: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
    speed: 800,
    effect: 'slide',
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    on: {
      init: function () {
        // nothing for now; images use native lazy loading
      }
    }
  });
});
