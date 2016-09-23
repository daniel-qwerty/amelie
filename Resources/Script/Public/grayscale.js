/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */
var urlBase = "http://localhost/panasonic";
var caracteres = "0123456789abcdefABCDEF?¿¡!:;";
var longitud = 10;


function validarEmail(email) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!expr.test(email)) {
        swal("Error", "The mailing address is incorrect", "error");
        return false;
    } else
        return true;
}

function saveContact(errorMesage, Message) {

    var nombre = $('#name').val();
    var email = $('#email').val();
    var ci = $('#ci').val();
    var city = $('#city').val();
    var phone = $('#phone').val();
    var cupon = rand_code(caracteres, longitud)


    if (nombre === "" || email === "" || ci === "") {
        swal("Alert!!", "All fields are required", "warning");
    } else {

        if (validarEmail(email)) {
            $.ajax({
                type: "POST",
                url: urlBase + "/Service/Clients/Save",
                data: {Name: nombre, Email: email, Ci: ci, City: city, Phone: phone, Cupon: cupon, Status: 0}
            }).done(function (data) {
                alert(data)
                if(data!=0)
                    swal("Received", "Thank you for writing, we will respond shortly.", "success");
                else
                    swal("Received", "Thank you for writing, we will respond shortly.", "error");

            }).fail(function () {

            });
            $('#name').val("");
            $('#email').val("");
            $('#ci').val("");
            $('#city').val("");
            $('#phone').val("");
        }


    }
}

function rand_code(chars, lon) {

    var code = "";

    for (x = 0; x < lon; x++) {

        rand = Math.floor(Math.random() * chars.length);

        code += chars.substr(rand, 1);

    }

    return code;

}


// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    //if ($(".navbar").offset().top > 50) {
    $(".navbar-fixed-top").addClass("top-nav-collapse");
    //} else {
    //    $(".navbar-fixed-top").removeClass("top-nav-collapse");
    //}
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function () {
    $('a.page-scroll').bind('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function () {
    $(this).closest('.collapse').collapse('toggle');
});

// Google Maps Scripts
var map = null;
// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);
google.maps.event.addDomListener(window, 'resize', function () {
    map.setCenter(new google.maps.LatLng(-17.767795, -63.183580));
});

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 15,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(-17.767795, -63.183580), // New York

        // Disables the default Google Maps UI components
        disableDefaultUI: true,
        scrollwheel: false,
        draggable: true,

        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{
            "featureType": "water",
            "stylers": [{"visibility": "on"}, {"color": "#b5cbe4"}]
        }, {"featureType": "landscape", "stylers": [{"color": "#efefef"}]}, {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [{"color": "#83a5b0"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [{"color": "#bdcdd3"}]
        }, {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [{"color": "#ffffff"}]
        }, {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [{"color": "#e3eed3"}]
        }, {
            "featureType": "administrative",
            "stylers": [{"visibility": "on"}, {"lightness": 33}]
        }, {"featureType": "road"}, {
            "featureType": "poi.park",
            "elementType": "labels",
            "stylers": [{"visibility": "on"}, {"lightness": 20}]
        }, {}, {"featureType": "road", "stylers": [{"lightness": 20}]}]
    };

    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using out element and options defined above
    map = new google.maps.Map(mapElement, mapOptions);

    // Custom Map Marker Icon - Customize the map-marker.png file to customize your icon
    var image = 'http://localhost/panasonic/Resources/Image/Public/map-marker.png';
    var myLatLng = new google.maps.LatLng(-17.767795, -63.183580);
    var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });


    var $select = $('select');
    $select.each(function () {
        $(this).addClass($(this).children(':selected').val());
    }).on('change', function (ev) {
        if ($(this).children(':selected').val() != '')
            $(this).attr('class', '');
        else
            $(this).attr('class', '').addClass('unselected');
    });

    $('.modelo-container').slick({
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
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
}
