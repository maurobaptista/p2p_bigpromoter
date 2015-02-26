<section id="showMap" style="max-width:%width%; position: relative; top:0px; left: 0px; float: left;" >
    <script src="https://maps.googleapis.com/maps/api/js?key=%google_api%&sensor=false&libraries=places,geometry,drawing"></script>
    <script type="text/javascript">
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;

        
        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                zoom: %start_map_zoom%,
                center: new google.maps.LatLng(%start_map_lat%, %start_map_lon%)
            };
            map = new google.maps.Map(document.getElementById("bigpromoter_map"), mapOptions);
            directionsDisplay.setMap(map);
        }

        function showDirectionOnMap(idStart, idEnd, divMap) {
            var start = document.getElementById(idStart).value;
            var end = document.getElementById(idEnd).value;
            
            var request = {
                origin:start,
                destination:end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            
            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });        
        }        
        google.maps.event.addDomListener(window, 'load', initialize);

        var autocompleteStart, autocompleteEnd;
        
        var bounds = new google.maps.LatLngBounds(new google.maps.LatLng(%start_map_lat%, %start_map_lon%),new google.maps.LatLng(%start_map_lat%, %start_map_lon%));
        
        function geolocateStart() {
            autocompleteStart = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */(document.getElementById('p2p_bigpromoter_start')),{ types: ['geocode'] });
            autocompleteStart.setBounds(bounds);

        }
    
        function geolocateEnd() {
            autocompleteEnd = new google.maps.places.Autocomplete((document.getElementById('p2p_bigpromoter_end')),{ types: ['geocode'] });
            autocompleteEnd.setBounds(bounds);
        }
        
    </script>

    %customcolor%
    <div id="bigpromoter_map" name="bigpromoter_map" style="max-width:%width%; height:%height%;"></div>    
    <div class="space5"></div>
    <div style="max-width:%width%;" class="left">
        <div class="w100p left">
            <div class="p2p_bp_input-group margin-bottom-sm w100p">
                <span class="p2p_bp_input-group-addon p2p_bp_glyphicon p2p_bp_glyphicon-map-marker"></span>
                <input class="p2p_bp_form-control pos1" type="text"  name="p2p_bigpromoter_start" id="p2p_bigpromoter_start" placeholder="Pick-up Location" value=""  onFocus="geolocateStart();">
            </div>
            <div class="space5"></div>
            <div class="p2p_bp_input-group margin-bottom-sm w100p">
                <span class="p2p_bp_input-group-addon p2p_bp_glyphicon p2p_bp_glyphicon-flag"></span>
                <input class="p2p_bp_form-control pos1" type="text" name="p2p_bigpromoter_end" id="p2p_bigpromoter_end" placeholder="Drop-off Location" value=""   onFocus="geolocateEnd();">
            </div>
        </div>
        <div class="space5"></div>
        <div class="right">
            <div class="p2p_bp_btn-group">
                <button type="submit" name="submit" id="submit" class="p2p_bp_btn p2p_bp_btn-default">GET A QUOTE <span class="p2p_bp_glyphicon p2p_bp_glyphicon-circle-arrow-right"></span></button>
            </div>
        </div>
    </div>
    <div id="p2p_show_price" name="p2p_show_price" style="max-width:%width%;" class="left"></div>
	<script  type="text/javascript">
		jQuery("#submit").click(function() {
            openFleetPrice('p2p_bigpromoter_start', 'p2p_bigpromoter_end', 'bigpromoter_map', '%plugin_address%', '#p2p_show_price');
        });
	</script>
</section>