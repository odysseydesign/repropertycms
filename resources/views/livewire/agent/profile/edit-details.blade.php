<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Basic Details</x-slot>

    <div class="dialog-body bg-light form-bg box-shadow-0">
        <div class="input-group-outline input-group my-3">
            <span>First Name * : </span>
            <input type="text" id="first_name"
                   wire:model="first_name" class="form-control" maxlength="100"
                   style="border:2px solid lightgrey;" required/>
        </div>
        <div class="input-group-outline input-group my-3">
            <span>Last Name * : </span>
            <input type="text" id="last_name"
                   wire:model="last_name" class="form-control"
                   style="border:2px solid lightgrey;" maxlength="100" required/>
        </div>
        <div class="input-group-outline input-group my-3">
            <span>Email * : </span>
            <input type="email" id="email" wire:model="email" readonly
                   class="form-control" maxlength="255"
                   style="border:2px solid lightgrey;"/>
        </div>
    </div>
    <x-slot name="buttons">
        <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3">
            Save Changes
        </button>
        <button type="button" class="button button-grey font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                wire:click="$dispatch('modal.close')">
            Cancel
        </button>
    </x-slot>
</x-form-modal>