$(function() {

	if ( $('.owl-2').length > 0 ) {
        $('.owl-2').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 20,
            smartSpeed: 1000,
            autoplay: true,
            nav: false,
            dots: true,
            pauseOnHover: false,
            responsive:{
                600:{
                    margin: 20,
                    nav: false,
                  items: 3
                },
                1000:{
                    margin: 20,
                    stagePadding: 0,
                    nav: false,
                  items: 4
                }
            }
        });            
    }

if ( $('.carouselInv').length > 0 ) {
        $('.carouselInv').owlCarousel({
            center: true,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 60,
            smartSpeed: 2000,
            autoplay: true,
            nav: false,
            dots: false,
            pauseOnHover: false,
            responsive:{
                600:{
                    margin: 20,
                    nav: false,
                  items: 1
                },
                1000:{
                    margin: 20,
                    stagePadding: 0,
                    nav: false,
                  items: 1
                }
            }
        });            
    }

  if ( $('.boutique_owl').length > 0 ) {
        $('.boutique_owl').owlCarousel({
            center: false,
            items: 1,
            // loop: true,
            stagePadding: 0,
            margin: 60,
            smartSpeed: 1000,
            autoplay: true,
            nav: true,
            dots: false,
            pauseOnHover: false,
            responsive:{
                600:{
                    margin: 20,
                    nav: true,
                  items: 3
                },
                1000:{
                    margin: 20,
                    stagePadding: 0,
                    nav: true,
                  items: 4
                }
            }
        });            
    }

    if ( $('.prestations_owl').length > 0 ) {
        $('.prestations_owl').owlCarousel({
            center: false,
            items: 1,
            // loop: true,
            stagePadding: 0,
            margin: 60,
            smartSpeed: 2000,
            autoplay: true,
            nav: true,
            dots: false,
            pauseOnHover: false,
            responsive:{
                600:{
                    margin: 20,
                    nav: true,
                  items: 3
                },
                1000:{
                    margin: 20,
                    stagePadding: 0,
                    nav: true,
                  items: 4
                }
            }
        });            
    }
})
