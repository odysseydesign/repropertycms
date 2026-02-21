<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Add Amenity</x-slot>

    <div class="input-group-outline input-group my-3 is-filled w-4/4 input-group mx-1">
        <span>Amenity:</span>
        <input type="text" id="add_amenity" placeholder="" wire:model="add_amenity" maxlength="100"
               class="form-control"/>
        <span class="text-grey-500 text-sm mt-1">Note: Add custom amenity</span>
    </div>
    <x-slot name="buttons">
        <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3">
            Save Changes
        </button>
        <button type="button" class="button button-grey font-bold text-base mb-0 mt-5 justify-content-end ml-3" wire:click="$dispatch('modal.close')">
            Cancel
        </button>
    </x-slot>
</x-form-modal>