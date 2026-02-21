<div class="w-full">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5></h5>
        <button onclick="Livewire.dispatch('modal.open', {component: 'map.update-map', arguments: { 'property': {{ $property->id }} } })"
                class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Update Map
        </button>
    </div>

    <div wire:ignore id="map" style="width:auto; height:500px"></div>

    <input type="hidden" id="latitude" value="{{ $property->latitude }}">
    <input type="hidden" id="longitude" value="{{ $property->longitude }}">
    <input type="hidden" id="address_line_1" value="{{ $property->address_line_1 }}">
    <input type="hidden" id="address_url" value="{{ $url }}">

    <div class="d-flex justify-content-end mt-5 rs-mb-1 rs-button-full">
        <a href="{{ route('agent.floorplan.index') }}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-2">
            <i class="fa fa-arrow-left mr-2"></i> Prev
        </a>
        <a href="{{ url('agent/property/default') }}" class="button button-blue font-bold text-base mb-0">
            Next <i class="fa fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>
@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map.api_key', '') }}&callback=initMap&libraries=places&v=weekly"
            defer></script>
    <script>
        var map = document.getElementById("map");
        var $latitude = document.getElementById('latitude');
        var $longitude = document.getElementById('longitude');
        var marker;
        var infowindow
        var cribinfo;
        var markersArray = [];
        var loc;
        var coords;
        var service;
        var address = $("#address_url").val();
        var mapstyleindex = 0;

        function initMap() {
            address = $("#address_url").val();
            var geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            var panorama;
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?key={{ config('services.google_map.api_key', '') }}&address=" + address, function (val) {
                var location = val.results[0].geometry.location;
                $("#latitude").val(location.lat.toFixed(8));
                $("#longitude").val(location.lng.toFixed(8));
                var mapOptions = {
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    streetViewControl: false,
                    scrollwheel: false,
                    zoomControl: true,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.LARGE,
                        position: google.maps.ControlPosition.LEFT_CENTER
                    },
                    overviewMapControl: true,
                    center: location
                };
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
                marker = new google.maps.Marker({
                    map: map,
                    position: location,
                    icon: {url: "{{ asset('images/crib.png?v=2') }}"},
                    draggable: true,
                });

                var proImage;
                proImage = '<br><br><img src="{{ $markerImg }}" width="100" height="100">';
                infowindow.setContent("<b>" + $("#address_line_1").val() + "</b>" + proImage);
                infowindow.open(map, marker);

                google.maps.event.addListener(marker, 'dragend', function (a) {
                    $("#latitude").val(a.latLng.lat().toFixed(8));
                    $("#longitude").val(a.latLng.lng().toFixed(8));

                    Livewire.dispatchTo('map.index', 'updateMarker', {
                        lat: a.latLng.lat().toFixed(8),
                        lng: a.latLng.lng().toFixed(8),
                        address: $("#address_line_1").val(),
                    });

                    const latlng = {
                        lat: parseFloat(a.latLng.lat()),
                        lng: parseFloat(a.latLng.lng()),
                    };
                    geocoder
                        .geocode({location: latlng})
                        .then((response) => {
                            if (response.results[0]) {
                                getAddress(response)
                            } else {
                                window.alert("No results found");
                            }
                        })
                        .catch((e) => console.log("Geocoder failed due to: " + e));
                });
            });
        }

        function getAddress(componentArr) {
            let address = "";
            let postcode = "";
            let city = "";
            let state = "";
            let country = "";
            for (const component of componentArr.results[0].address_components) {
                //console.log(component)
                const componentType = component.types[0];

                switch (componentType) {
                    case "subpremise":
                        address = component.long_name + ' ';
                        break;
                    case "premise":
                        address += component.long_name + ' ';
                        break;
                    case "street_number":
                        address += component.long_name + ' ';
                        break;
                    case "landmark":
                        address += component.long_name + ' ';
                        break;

                    case "route":
                        address += component.short_name;
                        break;

                    case "postal_code":
                        postcode = `${component.long_name}${postcode}`;
                        break;

                    case "political":
                        city = component.long_name + ' '
                        break;

                    case "sublocality":
                        city += component.long_name + ' ';
                        break;

                    case "locality":
                        city += component.long_name + ' '
                        break;

                    case "administrative_area_level_1":
                        state = component.long_name;
                        break;

                    case "country":
                        country = component.long_name;
                        break;
                }
            }
            console.log(address + ', ' + city + ', ' + state + ', ' + country + ' - ' + postcode)
            $("#address_line_1").val(address)
            $("#city").val(city)
            $("#state").val(state)
            $("#zip").val(postcode)
            $("#country").val(country)
        }

        $(".updateMap").on("click", function () {
            let address = $("#address_line_1").val();
            let address2 = $("#address_line_2").val();
            let cityname = $("#city").val();
            let state = $("#state :selected").val();
            let country = $.trim($('#country').text());
            let zipcode = $("#zip").val()

            var queryString = encodeURIComponent(address + ',' + address2 + ',' + cityname + ',' + state + ',' + country + ',' + zipcode);
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?key={{ config('services.google_map.api_key', '') }}&address=" + queryString, function (val) {
                if (val.results.length) {
                    marker.setMap(null);
                    var location = val.results[0].geometry.location;
                    marker = new google.maps.Marker({
                        map: map,
                        position: location,
                        icon: {url: "{{ asset('/images/crib.png?v=2') }}"},
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                    });

                    map.setZoom(15);
                    map.setCenter(location);

                    infowindow.setContent("<b>" + $("#address_line_1").val() + "</b>" + '<br><br><img src="' + $("#property_images").val() + '" width="100" height="100">');
                    infowindow.open(map, marker);

                    $("#latitude").val(location.lat.toFixed(8));
                    $("#longitude").val(location.lng.toFixed(8));
                }
            });
        })

        function initializeMap() {
            if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
                setTimeout(function () {
                    initMap();
                }, 100);
            }
        }

        Livewire.on('mapUpdatedJs', (event) => {
            initializeMap();
        });
    </script>
@endpush
