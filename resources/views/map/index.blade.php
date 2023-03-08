@extends('layouts.app')
@section('title', __('Nearest Location | BD Mirror'))
@section('body-class', 'map-home')
@section('content')
<div class="map-wrapper">
    <!-- In your Laravel 8 view -->
    <div class="mylocation m-4">
        <h5 class="w-100 text-center"><b>{{ Auth::guard('citizen')->user()->name }} your current location is:</b> <br> <span class="location"></span></h5>
    </div>
    <div id="map" style="height: 500px;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHKJ5ggeSmrqD2nX95OzGUOrJl6eT-y0M&libraries=places"></script>
    <script>
        // Initialize the map
        function initMap() {
            // Try to get the user's location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Set the center of the map to the user's location
                    var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: userLocation
                        , zoom: 15
                    });

                    // Create a marker for the user's location
                    var userMarker = new google.maps.Marker({
                        position: userLocation
                        , map: map
                        , title: 'My Location'
                        , icon: {
                            url: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
                        }

                    });

                    // Use the Google Places API to search for nearby places
                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch({
                        location: userLocation
                        , radius: 5000
                        , type: ['police']
                    }, function(results, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            // Add markers for each nearby police station
                            for (var i = 0; i < results.length; i++) {
                                var place = results[i];
                                var marker = new google.maps.Marker({
                                    position: place.geometry.location
                                    , map: map
                                    , title: place.name
                                });


                                // Add a click event listener to the map
                                map.addListener('click', function(event) {
                                    // Get the clicked location
                                    var clickedLocation = event.latLng;

                                    // Create a marker at the clicked location
                                    if (marker) {
                                        marker.setPosition(clickedLocation);
                                    } else {
                                        marker = new google.maps.Marker({
                                            position: clickedLocation
                                            , map: map
                                            , title: 'Destination'
                                        });
                                    }

                                    // Get directions from my current location to the clicked location
                                    var directionsService = new google.maps.DirectionsService();
                                    var directionsRenderer = new google.maps.DirectionsRenderer();
                                    directionsRenderer.setMap(map);
                                    directionsService.route({
                                        origin: {
                                            lat: position.coords.latitude
                                            , lng: position.coords.longitude
                                        }
                                        , destination: clickedLocation
                                        , travelMode: 'WALKING'
                                    }, function(response, status) {
                                        if (status === 'OK') {
                                            directionsRenderer.setDirections(response);
                                        } else {
                                            window.alert('Directions request failed due to ' + status);
                                        }
                                    });
                                });

                            }
                        }
                    });
                }, function() {
                    // If the user denies location access, show an error message
                    alert('Unable to get your location. Please enable location services and try again.');
                });
            } else {
                // If the user's browser doesn't support geolocation, show an error message
                alert('Your browser does not support geolocation. Please upgrade to a modern browser.');
            }
        }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHKJ5ggeSmrqD2nX95OzGUOrJl6eT-y0M&libraries=places&callback=initMap"></script>
    {{-- script for geting current location  --}}
    <script>
        var $locationText = $(".location");

        // Check for geolocation browser support and execute success method
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                geoLocationSuccess
                , geoLocationError, {
                    timeout: 10000
                }
            );
        } else {
            alert("your browser doesn't support geolocation");
        }

        function geoLocationSuccess(pos) {
            // get user lat,long
            var myLat = pos.coords.latitude
                , myLng = pos.coords.longitude
                , loadingTimeout;

            var loading = function() {
                $locationText.text("fetching...");
            };

            loadingTimeout = setTimeout(loading, 600);

            var request = $.get(
                    "https://nominatim.openstreetmap.org/reverse?format=json&lat=" +
                    myLat +
                    "&lon=" +
                    myLng
                )
                .done(function(data) {
                    if (loadingTimeout) {
                        clearTimeout(loadingTimeout);
                        loadingTimeout = null;
                        $locationText.text(data.display_name);
                    }
                })
                .fail(function() {
                    // handle error
                });
        }

        function geoLocationError(error) {
            var errors = {
                1: "Permission denied"
                , 2: "Position unavailable"
                , 3: "Request timeout"
            };
            alert("Error: " + errors[error.code]);
        }

    </script>
</div>
@endsection
