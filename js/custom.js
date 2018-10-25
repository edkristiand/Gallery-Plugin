jQuery(document).ready(function ($) { 
    
    $(".custom-gal").slick({ 
        slidesToShow: 1, 
        slidesToScroll: 1, 
        arrows: !1, 
        fade: !0, 
        asNavFor: ".custom-gal-thumb" 
    });

    $(".custom-gal-thumb").slick({ 
        slidesToShow: 5, 
        slidesToScroll: 1, 
        asNavFor: ".custom-gal", 
        centerMode: !0, 
        focusOnSelect: !0,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3
                }
            },
        ]
    });

    // change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
      $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
      });
    });

});