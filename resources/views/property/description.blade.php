<section class="py-5">
    <div class="container">
        <div class="row m-0 p-0">
            <h2 class="px-0 mb-4 text-center property-page-title site-color">{{ $property->headline != "" ? $property->headline : "Property Description" }}</h2>
            <div class="px-0 position-relative overflow-hidden text-center">{{ strip_tags($property->description) }}</div>
        </div>
    </div>
</section>