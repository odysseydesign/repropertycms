<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:480px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Preview Video</h3>
                    <button type="button" @click="$wire.closeModal()"
                            style="color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;padding:4px;line-height:1;">
                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Body --}}
                <div style="padding:24px;">
                    @if($property_video)
                        @if($property_video->video_type == \App\Enums\VideoType::Dropzone)
                            <video width="285" height="100%" controls autoplay="0">
                                <source src="{{asset('/files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                        type="video/mp4">
                                <source src="{{asset('/files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                        type="video/ogg"/>
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <x-embed-video url="{{ $property_video->video_url }}" autoplay="0"/>
                        @endif
                    @endif
                </div>
                {{-- Footer --}}
                <div style="padding:0 24px 24px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    @if($property_video)
                        <select wire:model.live="display_on" id="display_on"
                                class="font-normal text-sm inline-block w-fit rounded-md border border-gray-300 px-3 py-2">
                            <option value="">Choose Display Option</option>
                            <option value="both" {{ $display_on == 'both' ? 'selected' : '' }}>Display as: Cover &amp; Featured</option>
                            <option value="cover" {{ $display_on == 'cover' ? 'selected' : '' }}>Display as: Cover only</option>
                            <option value="featured" {{ $display_on == 'featured' ? 'selected' : '' }}>Display as: Featured only</option>
                        </select>
                    @endif
                    <button type="button" class="button button-grey font-bold" @click="$wire.closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
