<div>
    @if(!$published)
        <h2>This Property is not published </h2>
    @else
        <div class="row p-0 m-0">
            @include('property.header-slider')

            @if(!is_null($property->price))
                <section class="py-sm-2 bg-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center property_price_section site-color">
                                OFFERED AT ${{ $property->price }}
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @include('property.agent-profile')

            @include('property.features')

            @if(!empty($property->description))
                @include('property.description')
            @endif

            @if(count($property_videos) > 0)
                @include('property.videos')
            @endif

            @if(count($property_galleries) > 0)
                @include('property.galleries')
            @endif

            @if(count($property_floorplans) > 0)
                @include('property.floorplan')
            @endif
            <div id="fllorplan_margin" class="">
                @if(count($property_matterport) > 0)
                    @include('property.3dtour')
                @endif

                @include('property.location')

                @if(count($property_amenities) > 0)
                    @include('property.amenities')
                @endif

                @if(count($property_documents) > 0)
                    @include('property.documents')
                @endif

                @include('property.agent-profile')

                @include('property.contact')

                @include('property.footer')
            </div>
        </div>
    @endif
</div>

