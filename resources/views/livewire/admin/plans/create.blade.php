<x-form-modal on-submit="save" :content-padding="false">
    <x-slot name="title">Add Plan</x-slot>

    <div class="input-group-outline input-group my-3 is-filled w-4/4 input-group mx-1">
        <span>Plan Name:</span>
        <input type="text" id="plan_name" placeholder="" wire:model="plan_name" maxlength="255" class="form-control"/>
        @error('plan_name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="input-group-outline input-group my-3 is-filled w-4/4 input-group mx-1">
        <span>Price:</span>
        <input type="number" id="price" placeholder="" wire:model="price" min="1" class="form-control"/>
        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="input-group-outline input-group my-3 is-filled w-4/4 input-group mx-1">
        <span>Credits:</span>
        <input type="number" id="credits" placeholder="" wire:model="credits" min="1" class="form-control"/>
        @error('credits') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>


    <div class="input-group-outline input-group my-3 is-filled w-4/4 input-group mx-1">
        <span>Interval:</span>
        <select wire:model="interval" class="form-control">
            <option value="month">Monthly</option>
            <option value="year">Yearly</option>
        </select>
        @error('interval') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <x-slot name="buttons">
        <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3">
            Create
        </button>
        <button type="button" class="button button-grey font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                wire:click="$dispatch('modal.close')">
            Cancel
        </button>
    </x-slot>
</x-form-modal>