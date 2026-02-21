@props(['property_slider'])
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($property_slider as $key => $property_slide)
            @if($key == 0)
                <div class="carousel-item active h-100" data-bs-interval="10000">
                    @else
                        <div class="carousel-item h-100" data-bs-interval="6000">
                            @endif
                            <img src="{{asset_s3($property_slide->property_images->file_name)}}"
                                 class="d-block w-100 h-100">
                        </div>
                        @endforeach
                </div>
                <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
    </div>
</div>