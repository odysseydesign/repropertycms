<div>
    <style>
        .plan-ibtn-ro{padding:11px!important;border-radius:9px!important;font-size:13px!important;font-weight:600!important;border:2px solid #e5e7eb!important;display:flex!important;align-items:center!important;justify-content:center!important;gap:6px!important;width:100%!important;cursor:default!important;}
        .plan-ibtn-ro.ro-monthly{background:#eef2ff!important;color:#4338ca!important;border-color:#c7d2fe!important;}
        .plan-ibtn-ro.ro-yearly{background:#fdf4ff!important;color:#7e22ce!important;border-color:#e9d5ff!important;}
    </style>
    {{-- Modal overlay — driven by Livewire's $show property --}}
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">

        {{-- Flex centering wrapper --}}
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">

        {{-- Backdrop --}}
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);"
             @click="$wire.closeModal()"></div>

        {{-- Panel --}}
        <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:480px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            {{-- Header --}}
            <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:20px;height:20px;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:15px;font-weight:700;color:white;">Edit Plan</div>
                        <div style="font-size:12px;color:rgba(255,255,255,0.75);">Changes sync to Stripe automatically</div>
                    </div>
                </div>
                <button type="button" @click="$wire.closeModal()"
                        style="background:rgba(255,255,255,0.15);border:none;border-radius:8px;width:32px;height:32px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:white;transition:background 0.15s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div style="padding:24px;">

                {{-- Plan Name --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.06em;">Plan Name</label>
                    <input type="text" wire:model="plan_name" maxlength="255" placeholder="e.g. Pro Monthly"
                           style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;outline:none;box-sizing:border-box;transition:border-color 0.15s,box-shadow 0.15s;"
                           onfocus="this.style.borderColor='#7c3aed';this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.12)'"
                           onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                    @error('plan_name')
                        <span style="font-size:11px;color:#dc2626;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Price + Credits row --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                    <div>
                        <label style="display:block;font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.06em;">Price (USD)</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:13px;font-weight:600;">$</span>
                            <input type="number" wire:model="price" min="1" placeholder="29"
                                   style="width:100%;padding:10px 12px 10px 24px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;outline:none;box-sizing:border-box;transition:border-color 0.15s,box-shadow 0.15s;"
                                   onfocus="this.style.borderColor='#7c3aed';this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.12)'"
                                   onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                        </div>
                        @error('price')
                            <span style="font-size:11px;color:#dc2626;margin-top:4px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label style="display:block;font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.06em;">Credits</label>
                        <input type="number" wire:model="credits" min="1" placeholder="10"
                               style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;outline:none;box-sizing:border-box;transition:border-color 0.15s,box-shadow 0.15s;"
                               onfocus="this.style.borderColor='#7c3aed';this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.12)'"
                               onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                        @error('credits')
                            <span style="font-size:11px;color:#dc2626;margin-top:4px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Billing Interval (read-only display) --}}
                <div style="margin-bottom:20px;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#9ca3af;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Billing Interval (locked)</label>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                        <div class="plan-ibtn-ro {{ $interval === 'month' ? 'ro-monthly' : '' }}"
                             style="{{ $interval !== 'month' ? 'opacity:0.4;' : '' }}">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Monthly
                        </div>
                        <div class="plan-ibtn-ro {{ $interval === 'year' ? 'ro-yearly' : '' }}"
                             style="{{ $interval !== 'year' ? 'opacity:0.4;' : '' }}">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Yearly
                        </div>
                    </div>
                    <p style="font-size:11px;color:#9ca3af;margin-top:6px;">Price and interval cannot be changed after creation. Create a new plan instead.</p>
                </div>

                {{-- Stripe notice --}}
                <div style="display:flex;align-items:flex-start;gap:10px;padding:12px 14px;background:#f5f3ff;border:1px solid #ddd6fe;border-radius:9px;margin-bottom:22px;">
                    <svg style="width:15px;height:15px;color:#7c3aed;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/>
                    </svg>
                    <span style="font-size:12px;color:#5b21b6;line-height:1.5;">Name changes update the Stripe product. If the price changes, a new Stripe price is created and the old one is removed. Credits are local only.</span>
                </div>

                {{-- Footer buttons --}}
                <div style="display:flex;align-items:center;gap:10px;justify-content:flex-end;">
                    <button type="button" @click="$wire.closeModal()"
                            style="padding:10px 20px;border:1px solid #e5e7eb;background:white;border-radius:8px;font-size:13px;font-weight:500;color:#374151;cursor:pointer;transition:background 0.15s;white-space:nowrap;"
                            onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                        Cancel
                    </button>
                    <button type="button" wire:click="save" wire:loading.attr="disabled"
                            style="display:inline-flex;align-items:center;gap:7px;padding:10px 24px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;white-space:nowrap;transition:opacity 0.15s;"
                            wire:loading.class="opacity-50">
                        <svg wire:loading.remove wire:target="save" style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span wire:loading.remove wire:target="save">Update Plan</span>
                        <svg wire:loading wire:target="save" style="width:14px;height:14px;animation:spin 1s linear infinite;" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        <span wire:loading wire:target="save">Updating...</span>
                    </button>
                </div>

            </div>{{-- end body --}}
        </div>{{-- end panel --}}
        </div>{{-- end flex centering wrapper --}}
    </div>{{-- end overlay --}}
</div>
