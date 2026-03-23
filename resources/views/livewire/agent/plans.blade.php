<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:860px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;max-height:90vh;display:flex;flex-direction:column;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Subscribe to a Plan</h3>
                    <button type="button" @click="$wire.closeModal()"
                            style="color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;padding:4px;line-height:1;">
                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Body --}}
                <div style="padding:24px;overflow-y:auto;flex:1;">
                    <div class="container max-w-screen-xl mx-auto px-4">

                        {{-- Subscription Rules Info --}}
                        <div x-data="{ open: false }" class="mb-6">
                            <button
                                type="button"
                                @click="open = !open"
                                class="w-full flex items-center justify-between bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-300 hover:bg-slate-700 transition-colors"
                            >
                                <span class="flex items-center gap-2 font-medium">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    How subscriptions work
                                </span>
                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition class="mt-2 bg-slate-900 border border-slate-700 rounded-lg p-4 text-sm text-slate-400 space-y-4">

                                {{-- Rules grid --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex gap-3">
                                        <div class="mt-0.5 shrink-0 text-blue-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-slate-200 font-medium mb-0.5">Property Credits</p>
                                            <p class="leading-snug">Each plan includes a set number of published property listings. Once you reach your limit, new publications are blocked until you upgrade.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="mt-0.5 shrink-0 text-blue-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-slate-200 font-medium mb-0.5">Renewal</p>
                                            <p class="leading-snug">Billed monthly or yearly. At renewal, if your published properties exceed your plan's credit limit, the oldest listings are automatically unpublished to bring you back within your limit.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="mt-0.5 shrink-0 text-blue-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-slate-200 font-medium mb-0.5">Cancellation</p>
                                            <p class="leading-snug">When a subscription is cancelled, all published properties are removed from public view. Your listing data is retained and can be restored if you re-subscribe.</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Status badge legend --}}
                                <div class="border-t border-slate-700 pt-4">
                                    <p class="text-slate-300 font-medium mb-2">Subscription statuses</p>
                                    <div class="flex flex-wrap gap-3">
                                        <span class="inline-flex items-center gap-1.5 bg-green-900/40 text-green-400 border border-green-700/50 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                                            active — All features available
                                        </span>
                                        <span class="inline-flex items-center gap-1.5 bg-blue-900/40 text-blue-400 border border-blue-700/50 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>
                                            trialing — Free trial period
                                        </span>
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-900/40 text-yellow-400 border border-yellow-700/50 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                                            past_due — Payment failed; update payment method
                                        </span>
                                        <span class="inline-flex items-center gap-1.5 bg-red-900/40 text-red-400 border border-red-700/50 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>
                                            canceled — Subscription ended; properties unpublished
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Plan Cards --}}
                        <div class="flex flex-wrap justify-center">
                            @foreach($plans as $plan)
                                <div class="md:w-1/3 lg:w-1/3 p-6">
                                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 relative">
                                        <div class="absolute top-0 right-0 -mt-3 -mr-3 bg-blue-500 text-white px-2 py-1 rounded-bl-md text-sm font-bold">{{ $plan->name }}</div>

                                        @if($plan->name == 'Pilot')
                                        <div class="text-center text-5xl font-bold text-blue-500 mb-4 relative">
                                            <div class="inline-block bg-blue-500 text-white px-3 py-1 rounded-bl-md text-sm font-bold ml-5">
                                                50% off <span class="line-through text-white text-xs ml-1">was ${{ $plan->price }}</span>
                                            </div>
                                            <div>
                                                ${{ $plan->price / 2 }}
                                                <span class="text-lg font-normal text-gray-500">/{{ $plan->interval }}</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="text-center text-5xl font-bold text-blue-500 mb-4">
                                            ${{ $plan->price }}<span class="text-lg font-normal text-gray-500">/{{ $plan->interval }}</span>
                                        </div>
                                        @endif

                                        <ul class="list-disc list-inside mb-6 text-gray-600">
                                            <li class="font-semibold">{{ $plan->credits }} {{ Str::plural('Property', $plan->credits) }}</li>
                                        </ul>

                                        <div class="text-center">
                                            <button wire:click="subscribeNow({{ $plan->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Subscribe Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                {{-- Footer --}}
                <div style="padding:16px 24px;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;flex-shrink:0;">
                    <button type="button" class="button button-grey font-bold" @click="$wire.closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
