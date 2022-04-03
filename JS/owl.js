$(document).ready(function () {
    $(".owl1").owlCarousel({

        loop: false,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 2,
                nav: false,
                loop: false
            }
        }
    });
    $(".owl2").owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 4,
                nav: false
            },
            1000: {
                items: 6,
                nav: false
            }
        }
    })
});