<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Photo Library</x-slot>
    <div class="m-0">
        <div class='content'>
            <!-- Dropzone 1 -->
            <livewire:dropzone
                    wire:model="thumbnail" :multiple="true"
                    :rules="['image','mimes:png,jpeg,jpg','max:20480']"
                    :key="'dropzone-one'"/>
        </div>
        @error('thumbnail') <span class="error">{{ $message }}</span> @enderror
        <p class="text-grey-500 text-sm mt-2">You can upload up to 200 photos per property. However, you can
            only upload 100 photos simultaneously. If you have more than 100
            you'll need to upload them in multiple batches.
            The max file size for each individual photo is 20 MB. Photos exceeding
            that size may be dropped. Please let us know if you have trouble
            uploading.</p>

        <div class="my-5">
            <button id="addFiles" class="button button-blue p-3" data-ripple-light="true">Add Images</button>
        </div>
    </div>
</x-form-modal>