<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Update Address</x-slot>

    <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg is-filled mt-4 address-map">
        <div class="flex my-5 responsive-row">
            <div class="input-group input-group-outline mx-1 w-1/2 inline-flex w-50">
                <span>Street 1 :</span>
                <input type="text" wire:model="address_line_1" id="address_line_1" placeholder=""
                       style="border: 2px solid lightgrey" class="form-control"/>
            </div>
            <div class="input-group input-group-outline mx-1 w-1/2 inline-flex w-50 ">
                <span>Street 2 :</span>
                <input type="text" wire:model="address_line_2" id="address_line_2" placeholder=""
                       style="border: 2px solid lightgrey"
                       class="form-control"/>
            </div>
        </div>

        <div class="flex my-5 responsive-row">
            <div class="input-group input-group-outline mx-1 w-1/2 inline-flex">
                <span>City :</span>
                <input type="text" wire:model="city" id="city" placeholder="" style="border: 2px solid lightgrey"
                       class="form-control"/>
            </div>
            <div class="input-group input-group-outline  mx-1 w-1/2 inline-flex is-filled">
                <span>State :</span>
                <x-form.select
                        label="Choose Option"
                        placeholder="Choose Option"
                        :options="$states"
                        name="state"
                />
            </div>
        </div>

        <div class="flex my-5 responsive-row">
            <div class="input-group input-group-outline w-1/2 inline-flex mx-1">
                <span>Zip :</span>
                <input type="text" wire:model="zip" id="zip" placeholder="" style="border: 2px solid lightgrey"
                       class="form-control"/>
            </div>
            <div class="input-group input-group-outline w-1/2 mx-1 inline-flex">
                <span>Country :</span>
                <input id="country" type="text" style="border: 2px solid lightgrey"
                       wire:model="country" placeholder=""
                       class="form-control" readonly/>
            </div>
        </div>
    </div>
    <x-slot name="buttons">
        <button type="submit" class="button button-green font-bold w-40 mx-1">
            Save Changes
        </button>
        <button type="button" class="button button-grey font-bold w-40 mx-1" wire:click="$dispatch('modal.close')">
            Cancel
        </button>
    </x-slot>
</x-form-modal>