<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Address</x-slot>
    <div class="dialog-body bg-light form-bg box-shadow-0">
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>Business Name * : </span>
            <input type="text" id="business_name" wire:model="business_name"
                   class="form-control" maxlength="100"
                   style="border:2px solid lightgrey;"/>
        </div>
        <div class="input-group-outline input-group my-3 ml-10  w-5/12 inline-flex">
            <span>Address * : </span>
            <input type="text" id="address" wire:model="address" class="form-control"
                   style="border:2px solid lightgrey;" required/>
        </div>
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>City * : </span>
            <input type="text" id="city" wire:model="city" maxlength="100" class="form-control"
                   style="border:2px solid lightgrey;" required/>
        </div>
        <div class="input-group-outline input-group my-3 ml-10 w-5/12 inline-flex is-filled">
            <span>State * : </span>
            <select class="form-control pl-2" name="state_id" id="state_id" wire:model="state_id"
                    placeholder="State" style="border:2px solid lightgrey;" required>
                <option value="">Choose State</option>
                @foreach($states as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>Zip * : </span>
            <input type="text" id="zip" wire:model="zip" maxlength="10"
                   value="{{@$agent->agent_address->zip}}" class="form-control"
                   style="border:2px solid lightgrey;" required/>
        </div>
        <div class="input-group-outline input-group w-5/12 inline-flex ml-10 mt-5">
            <span>Country * : </span>
            <select class="form-control px-3" wire:model="country_id"
                    style="border:2px solid lightgrey;" required>
                <option value="">Choose Country</option>
                @foreach($countries as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
            <span>Phone * : </span>
            <input type="text" id="phone" wire:model="phone" maxlength="50" class="form-control"
                   style="border:2px solid lightgrey;" required/>
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