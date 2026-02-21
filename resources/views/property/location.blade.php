<section class="bg-white py-5 pb-0">
    <div class="row m-0 p-0" wire:ignore>
        <h2 class="px-0 mb-5 text-center property-page-title site-color">Map and Local Places</h2>
        <div class="map-controls d-none d-md-block">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link rounded-0 active btn-map-address" id="rm">Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="schools">Schools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="parks">Parks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="bars">Bars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places"
                       data-qry="restaurants">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="coffee shops">Coffee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="bank with atm">ATMs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 btn-nearby-places" data-qry="gyms">Gyms</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12 m-0 p-0">
            <div class="position-relative">
                @php
                    /*if($property->latitude != "" && $property->longitude != ""){
                        $url = $property->latitude.",".$property->longitude;
                        $url = urlencode($url);
                    }else{ */
                        $url = $property->address_line_1 . " " . $property->address_line_2 . " " . $property->city  . " "  . (isset($state) ? $state->name : "") . " ";
                        $url .= is_null($property->country) ? "United States" : ($property->country->name ?? '');
                        $url .= $property->zip;
                        $url = urlencode($url);
                    /*}*/
                @endphp
                <input type="hidden" id="mapAddressURL" value="{{urldecode($url)}}">
                <div class="info-box d-flex align-items-center" style="visibility: visible;">
                    <div class="media m-0 p-2">
                        @if($property_Random_Img)
                            <img class="img-fluid _info-window-image"
                                 src="{{asset_s3($property_Random_Img->file_name)}}" width="100" height="100">
                        @endif
                        <div class="media-body my-auto pl-3">
                            <div class="info-window-address">
                                <div style="">{{$property->address_line_1 . " " . $property->address_line_2}}</div>
                                <div class="font-size-80">{{$property->city . " " . ($property->country->name ?? '') . ' ' . $property->zip}}</div>
                            </div>
                            <div class="info-window-property-detail" style="">
                                @if(!is_null($property->bedroom))
                                    <span>{{$property->bedroom}} Bed</span> |
                                @endif
                                @if(!is_null($property->bathroom))
                                    <span>{{$property->bathroom}} Baths</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <iframe id="map-canvas" width="100%" height="600" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCnZnFieqWV0W5WMeu-5v6WSyaCXxF_Ovk&amp;q=789%20Amalfi%20Drive,%20Pacific%20Palisades,%20CA%2090272&amp;zoom=15&amp;center=34.0438,-118.51061" allowfullscreen=""></iframe> -->
                <!-- <iframe class="custom-shadow w-100 property_map" id="map-canvas" height="650" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCnZnFieqWV0W5WMeu-5v6WSyaCXxF_Ovk&amp;q={{$url}}&amp;zoom=15&amp;center={{$property['latitude']}},{{$property['longitude']}}" allowfullscreen=""></iframe> -->
                <iframe class="custom-shadow w-100 property_map" id="map-canvas" height="650"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""
                        allowfullscreen=""></iframe>
                <!-- <iframe class="custom-shadow w-100 property_map" id="map-canvas" height="650" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;q={{$url}}&amp;output=embed"></iframe> -->
            </div>
        </div>
    </div>
</section>
<script>
    var propertyAddress = $("#mapAddressURL").val();
    var streetAddress = $("#mapAddressURL").val();
    var svAddress = $("#mapAddressURL").val();
    var map_zoom = 15;
    var propertyZip = '<?php echo $property['zip']; ?>';
    var mapKey = "<?php echo config('services.google_map.api_key', '')  ?>";
    //var mapKey = "AIzaSyCnZnFieqWV0W5WMeu-5v6WSyaCXxF_Ovk";
    var baseUrl = "https://www.google.com/maps/embed/v1/";
    var map_lat = '<?php echo $property['latitude']; ?>';
    var map_lng = '<?php echo $property['longitude']; ?>';

    mapAddress($("#map-canvas"), streetAddress, map_zoom);
    $(".map-controls .nav-link").on("click", function () {
        $(".map-controls .nav-link").removeClass("active");
        $(this).addClass("active");
    });

    $(".btn-map-address").on("click", function () {
        mapAddress($("#map-canvas"), streetAddress, map_zoom);
    });

    $(".btn-nearby-places").on("click", function () {
        var qry = jQuery(this).data("qry");
        nearbyPlaces($("#map-canvas"), propertyZip, propertyAddress, qry, map_zoom);
    });

    function mapAddress($elem, address, zoom) {
        var frameUrl = baseUrl + "place" + "?key=" + mapKey + "&q=" + encodeURI(address) + "&zoom=" + zoom;
        if (map_lat && map_lng) {
            frameUrl = frameUrl + '&center=' + map_lat + ',' + map_lng;
        }
        $elem.attr("src", frameUrl);
        $(".info-box").css('visibility', 'visible');
    }

    function nearbyPlaces($elem, zip, address, query, zoom) {
        var keywords;
        if (zoom) zoom = zoom - 1;
        if (zip) {
            keywords = query + " " + zip;
        } else {
            keywords = query + " near " + address;
        }
        var frameUrl = baseUrl + "search" + "?key=" + mapKey + "&q=" + encodeURI(keywords) + "&zoom=" + zoom;
        if (map_lat && map_lng) {
            frameUrl = frameUrl + '&center=' + map_lat + ',' + map_lng;
        }
        $elem.attr("src", frameUrl);
        $(".info-box").css('visibility', 'hidden');
    }
</script>