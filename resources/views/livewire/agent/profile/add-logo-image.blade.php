<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Logo Image</x-slot>
    <div class="m-0">
        <div class='content'>
            <!-- Dropzone 1 -->
            <livewire:dropzone
                    wire:model="thumbnail"
                    :rules="['image','mimes:png,jpeg,jpg','max:20480']"
                    :key="'dropzone-one'"/>
        </div>
        @error('thumbnail') <span class="error">{{ $message }}</span> @enderror
        <div class="my-5">
            <button id="addFiles" class="button button-blue p-3" data-ripple-light="true">Upload Image</button>
        </div>
    </div>
</x-form-modal>