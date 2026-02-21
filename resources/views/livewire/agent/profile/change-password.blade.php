<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Change Password</x-slot>

    <div class="dialog-body bg-light form-bg box-shadow-0">
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </div>
    <div class="input-group-outline input-group my-3"><label for="old_password">Old Password * :</label> <input
                type="password" id="old_password" wire:model="old_password" class="form-control"
                style="border:2px solid lightgrey;" required/></div>
    <div class="input-group-outline input-group my-3"><label for="password">New Password * :</label> <input
                type="password" id="password" wire:model="password" class="form-control"
                style="border:2px solid lightgrey;" required/></div>
    <div class="input-group-outline input-group my-3"><label for="password_confirmation">Confirm Password * :</label>
        <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control"
               style="border:2px solid lightgrey;" maxlength="100" required/></div>

    <x-slot name="buttons">
        <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3"> Save
            Changes
        </button>
        <button type="button" class="button button-grey font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                wire:click="$dispatch('modal.close')"> Cancel
        </button>
    </x-slot>
</x-form-modal>