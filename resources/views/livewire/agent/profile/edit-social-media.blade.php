<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:480px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Social Media</h3>
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
                        <div class="dialog-body bg-light form-bg box-shadow-0">
                            <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
                                <span>Facebook Profile Url :</span>
                                <input type="text" id="facebook_profile" wire:model="facebook_profile" maxlength="255"
                                       class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
                            </div>
                            <div class="input-group-outline input-group my-3 ml-10  w-5/12 inline-flex">
                                <span>Instagram Profile Url</span>
                                <input type="text" id="instagram_profile" wire:model="instagram_profile" maxlength="255"
                                       class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
                            </div>
                            <div class="input-group-outline input-group my-3 w-5/12 inline-flex">
                                <span>Twitter Profile Url :</span>
                                <input type="text" id="twitter_profile" wire:model="twitter_profile" maxlength="255"
                                       class="form-control" style="border: 2px solid lightgrey;" placeholder=""/>
                            </div>
                            <div class="input-group-outline input-group my-3 ml-10 w-5/12 inline-flex">
                                <span>LinkedIn Profile Url :</span>
                                <input type="text" id="linkedin_profile" wire:model="linkedin_profile" maxlength="255"
                                       class="form-control" style="border:2px solid lightgrey;"/>
                            </div>
                        </div>
                    </div>
                    {{-- Footer --}}
                    <div style="padding:0 24px 24px;display:flex;gap:8px;">
                        <button type="submit" class="button button-blue font-bold text-base mb-0 justify-content-end">Save Changes</button>
                        <button type="button" class="button button-grey font-bold text-base mb-0 justify-content-end" @click="$wire.closeModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
