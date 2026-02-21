<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Social Media</x-slot>
    <div class="dialog-body bg-light form-bg box-shadow-0">
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>Facebook Profile Url :</span>
            <input type="text" id="facebook_profile" wire:model="facebook_profile" maxlength="255"
                   class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
        </div>
        <div class="input-group-outline input-group my-3 ml-10  w-5/12 inline-flex">
            <span>Instagram Profile Url</span>
            <input type="text" id="instagram_profile" wire:model="instagram_profile"  maxlength="255"
                   class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
        </div>
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>Twitter Profile Url :</span>
            <input type="text" id="twitter_profile" wire:model="twitter_profile" maxlength="255"
                   class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
        </div>
        <div class="input-group-outline input-group my-3 ml-10 w-5/12 inline-flex">
            <span>LinkedIn Profile Url :</span>
            <input type="text" id="linkedin_profile" wire:model="linkedin_profile"  maxlength="255"
                   class="form-control" style="border:2px solid lightgrey;"/>
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