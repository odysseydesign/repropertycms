<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:520px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;max-height:90vh;display:flex;flex-direction:column;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Select Header Image</h3>
                    <button type="button" @click="$wire.closeModal()"
                            style="color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;padding:4px;line-height:1;">
                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Body --}}
                <div style="padding:24px;overflow-y:auto;flex:1;">
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
                </div>
                {{-- Footer --}}
                <div style="padding:16px 24px;border-top:1px solid #e5e7eb;flex-shrink:0;">
                    <button type="button" class="button button-grey font-bold" @click="$wire.closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
