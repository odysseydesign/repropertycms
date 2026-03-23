<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:560px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Update Address</h3>
                    <button type="button" @click="$wire.closeModal()"
                            style="color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;padding:4px;line-height:1;">
                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Body --}}
                <form wire:submit.prevent="save">
                    <div style="padding:24px;">
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
                    </div>
                    {{-- Footer --}}
                    <div style="padding:0 24px 24px;display:flex;gap:8px;">
                        <button type="submit" class="button button-green font-bold w-40 mx-1">Save Changes</button>
                        <button type="button" class="button button-grey font-bold w-40 mx-1" @click="$wire.closeModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
