// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

/* Máscara para telefone */
$(document).ready(function() {
    $(".cel").setMask('(99) 99999-9999');
    $(".cep").setMask('99999-999');
    $(".cpf").setMask('999.999.999-99');
    $(".data").setMask('99/99/9999');

});

$('.slikcenter').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

$(document).foundation({
  orbit: {
    animation: 'slide',
    timer_speed: 5000,
    pause_on_hover: false,
    animation_speed: 500,
    navigation_arrows: false,
    bullets: false
  }
});