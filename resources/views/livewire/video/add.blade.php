<x-form-modal on-submit="save">
    <x-slot name="title">Add Video</x-slot>
    <div class="container mx-auto">
        <div class="input-group input-group-outline ">
            <label class="text-bold">Select provider:</label>
        </div>
        <div class="flex">
            <div class="w-1/2">
                <div wire:click="$set('showUploadOption', 'Youtube')"
                     class="flex items-center justify-center h-48 bg-gray-200 rounded-lg m-2 video-icons {{ ($showUploadOption === 'Youtube') ? 'selected' : '' }}">
                    <img src="{{ asset('images/youtube-2.png') }}" class="max-h-full max-w-full"/>
                </div>
            </div>
            <div class="w-1/2">
                <div wire:click="$set('showUploadOption', 'Vimeo')"
                     class="flex items-center justify-center h-48 bg-gray-200 rounded-lg m-2 video-icons {{ ($showUploadOption === 'Vimeo') ? 'selected' : '' }}">
                    <img src="{{ asset('images/vimeo-2.png') }}" class="max-h-full max-w-full"/>
                </div>
            </div>
{{--            <div class="w-1/3">--}}
{{--                <div wire:click="$set('showUploadOption', 'Dropzone')"--}}
{{--                     class="flex items-center justify-center h-48 bg-gray-200 rounded-lg m-2 video-icons {{ ($showUploadOption === 'Dropzone') ? 'selected' : '' }}">--}}
{{--                    <img src="{{ asset('images/video-upload.png') }}" class="max-h-full max-w-full"/>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    @if ($showUploadOption === 'Dropzone')
        <!-- left side video upload drozone box -->
        <div class="w-full mb-4">
            <label>Upload Video:</label>
            <livewire:dropzone
                    wire:model="videos"
                    :rules="['mimes:mp4,mov,ogg,jpg']"/>

            @error('video') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
        </div>
    @endif
    @if ($showUploadOption === 'Youtube')
        <!-- Right side iput box for video url -->
        <div class="w-full">
            <div class="input-group input-group-outline ">
                <label>Add Youtube Url:</label>
                <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                       class="form-control" style="border:2px solid lightgrey;" required/>
                @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
            </div>
            <div class="vid-help youtube-help">
                <img src="{{ asset('images/youtube-help.png') }}" class="img-fluid">
            </div>
        </div>
    @endif
    @if ($showUploadOption === 'Vimeo')
        <div class="w-full">
            <div class="input-group input-group-outline ">
                <label>Add Vimeo Url:</label>
                <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                       class="form-control" style="border:2px solid lightgrey;" required/>
                @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
            </div>
            <div class="vid-help vimeo-help">
                <img src="{{ asset('images/vimeo-help.png') }}" class="img-fluid">
            </div>
        </div>
    @endif
    @if ($showUploadOption === 'Wistia')
        <div class="w-full">
            <div class="input-group input-group-outline ">
                <label>Add Wistia Url:</label>
                <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                       class="form-control" style="border:2px solid lightgrey;" required/>
                @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
            </div>
            <div class="vid-help wistia-help">
                <img src="{{ asset('images/wistia-help.png') }}" class="img-fluid">
            </div>
        </div>
    @endif
    <x-slot name="buttons">
        <button type="submit" class="button button-green font-bold w-40 mx-1">
            Add Video
        </button>
        <button type="button" class="button button-grey font-bold w-40 mx-1" wire:click="$dispatch('modal.close')">
            Cancel
        </button>
    </x-slot>
</x-form-modal>