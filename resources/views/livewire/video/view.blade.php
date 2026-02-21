<x-form-modal on-submit="save">
    <x-slot name="title">Preview Video</x-slot>
    <div>
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
    </div>
    <x-slot name="buttons">
        <select wire:model.live="display_on" id="display_on"
                class="font-normal text-sm inline-block w-fit rounded-md border border-gray-300 px-3 py-2">
            <option value="">Choose Display Option</option>
            <option value="both" {{ $display_on == 'both' ? 'selected' : '' }}>Display as: Cover & Featured
            </option>
            <option value="cover" {{ $display_on == 'cover' ? 'selected' : '' }}>Display as: Cover only</option>
            <option value="featured" {{ $display_on == 'featured' ? 'selected' : '' }}>Display as: Featured
                only
            </option>
        </select>
    </x-slot>
</x-form-modal>