<x-form-modal on-submit="save">
    <x-slot name="title">Property Images</x-slot>
    <div class="views-form mt-5 property_image">
        @foreach($property_images as $property_image)
            <div class="inline mr-3" id="{{$property_image->id}}">
                <div class="w-52 h-52 pb-0  inline-block relative gallery-image">
                    <div style="height:10rem;" class="relative  border-b border-grey-300">
                        <img src="{{asset_s3($property_image->thumb ?? 1)}}" id="image{{$property_image->id}}"
                             class="card-image-style"
                             alt="">
                    </div>
                    <div class="w-full p-3 text-center">
                        @if($property->featured_image != $property_image->id)
                            <a href="#" id="featureimage" class=" m-5 featureimage" title="Feature image"
                               wire:click="saveFeatureImage({{ $property_image->id }})">Select Image</a>
                        @else
                            Current Image
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-slot name="buttons">
    </x-slot>
</x-form-modal>