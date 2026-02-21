<section class="py-5">
    <div class="container">
        <div class="">
            <h2 class="px-0 mb-5 text-center property-page-title site-color">Amenities</h2>
            <!-- <p class="fs-1 text-uppercase text-center pt-5 pb-3"></p> -->
            <div class="row">
                @foreach($property_amenities as $property_amenitie)
                    <div class="col-6 col-sm-4 col-md-4">
                        <p class="d-inline-block text-dark property_amenities">
                            <svg height="15" width="15" aria-hidden="true" focusable="false"
                                 class="d-inline " role="img" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512">
                                <path fill="currentColor"
                                      d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z"></path>
                            </svg>
                            <span class="ml-2 d-inline-block">{{ $property_amenitie->Amenities->name }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>