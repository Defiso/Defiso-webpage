<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defisomedia
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner">

      <div class="top">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Defisos logotype">
      </div>

      <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer' ) ); ?>
      <div class="company-information">
        <ul>
          <li class="header">Defiso Media AB</li>
          <li>Olof Palmes Gata 20B</li>
          <li>111 37 Stockholm</li>
          <li>08-410 344 35 </li>
          <li>info@defiso.se</li>
        </ul>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAivZpkTmTfd2R-GyDeUpT3v-QwBMH4wEk&amp;sensor=false"></script>
<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 15,
            scrollwheel: false,
						mapTypeControl: false,
					  streetViewControl: false,
					  rotateControl: false,
					  fullscreenControl: false,
						draggable: false,
						zoomControl: false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(59.335607, 18.040728),

            // How you would like to style the map.
            // This is where you would paste any style found on Snazzy Maps.
            styles: [
              {
                  "featureType": "administrative",
                  "elementType": "labels.text.fill",
                  "stylers": [
                      {
                          "color": "#444444"
                      }
                  ]
              },
              {
                  "featureType": "landscape",
                  "elementType": "all",
                  "stylers": [
                      {
                          "color": "#f2f2f2"
                      }
                  ]
              },
              {
                  "featureType": "landscape.man_made",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "saturation": "8"
                      },
                      {
                          "lightness": "15"
                      },
                      {
                          "color": "#f5d9dc"
                      }
                  ]
              },
              {
                  "featureType": "landscape.natural",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#e9e5dc"
                      }
                  ]
              },
              {
                  "featureType": "landscape.natural.landcover",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#e9e5dc"
                      }
                  ]
              },
              {
                  "featureType": "landscape.natural.terrain",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#e9e5dc"
                      }
                  ]
              },
              {
                  "featureType": "poi",
                  "elementType": "all",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "all",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "lightness": 45
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "labels.text.fill",
                  "stylers": [
                      {
                          "color": "#737171"
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "road.highway",
                  "elementType": "all",
                  "stylers": [
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "road.arterial",
                  "elementType": "labels.icon",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "transit",
                  "elementType": "all",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "transit.line",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "color": "#fff6f7"
                      },
                      {
                          "weight": "0.50"
                      }
                  ]
              },
              {
                  "featureType": "transit.line",
                  "elementType": "geometry.stroke",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "all",
                  "stylers": [
                      {
                          "color": "#46bcec"
                      },
                      {
                          "visibility": "on"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "color": "#857ca0"
                      },
                      {
                          "saturation": "8"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "labels.text",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "labels.text.fill",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      },
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                      {
                          "color": "#ffffff"
                      }
                  ]
              }
            ]
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(59.335647, 18.058565),
            map: map
        });
    }
</script>

</body>
</html>
