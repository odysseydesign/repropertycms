<div>

    {{-- ─── Page Heading ─────────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <div>
            <h5 class="mb-0">Subscription Plans</h5>
            <nav style="font-size:13px;color:#6b7280;margin-top:4px;display:flex;align-items:center;gap:6px;">
                <a href="{{ route('admin.dashboard') }}" style="color:#9ca3af;text-decoration:none;">Dashboard</a>
                <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span>Plans</span>
            </nav>
        </div>
    </div>

    {{-- ─── How Plans Work — Info Banner ───────────────────────────────────── --}}
    <div x-data="{ open: true }" style="margin-bottom:24px;">
        <div style="background:white;border:1px solid #c7d2fe;border-left:4px solid #4f46e5;border-radius:12px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            {{-- Banner header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;cursor:pointer;"
                 @click="open = !open">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:32px;height:32px;background:#eef2ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:16px;height:16px;color:#4f46e5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span style="font-size:13px;font-weight:600;color:#3730a3;">How Plans &amp; Subscriptions Work</span>
                </div>
                <svg :style="'width:16px;height:16px;color:#6366f1;transition:transform 0.2s;' + (open ? 'transform:rotate(180deg)' : '')" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            {{-- Banner body --}}
            <div x-show="open" x-collapse style="border-top:1px solid #e0e7ff;">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:0;">

                    <div style="padding:16px 18px;border-right:1px solid #e0e7ff;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                            <div style="width:24px;height:24px;background:#4f46e5;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:12px;height:12px;color:white;" fill="currentColor" viewBox="0 0 24 24"><path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/></svg>
                            </div>
                            <span style="font-size:12px;font-weight:700;color:#1e1b4b;">Stripe Sync</span>
                        </div>
                        <p style="font-size:12px;color:#4b5563;line-height:1.6;margin:0;">Plans created here are immediately synced to your Stripe account as Products. Deleting a plan removes it from Stripe too.</p>
                    </div>

                    <div style="padding:16px 18px;border-right:1px solid #e0e7ff;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                            <div style="width:24px;height:24px;background:#0891b2;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:12px;height:12px;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span style="font-size:12px;font-weight:700;color:#1e1b4b;">Agent Subscriptions</span>
                        </div>
                        <p style="font-size:12px;color:#4b5563;line-height:1.6;margin:0;">Agents subscribe via their Billing page using Stripe Checkout. Subscription status updates automatically through webhooks.</p>
                    </div>

                    <div style="padding:16px 18px;border-right:1px solid #e0e7ff;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                            <div style="width:24px;height:24px;background:#059669;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:12px;height:12px;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>
                            <span style="font-size:12px;font-weight:700;color:#1e1b4b;">Credits = Property Limit</span>
                        </div>
                        <p style="font-size:12px;color:#4b5563;line-height:1.6;margin:0;">Each plan grants a credit count. Agents can publish up to that many properties. Exceeding the limit auto-unpublishes the oldest ones.</p>
                    </div>

                    <div style="padding:16px 18px;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                            <div style="width:24px;height:24px;background:#d97706;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:12px;height:12px;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span style="font-size:12px;font-weight:700;color:#1e1b4b;">Billing Intervals</span>
                        </div>
                        <p style="font-size:12px;color:#4b5563;line-height:1.6;margin:0;">Plans are Monthly or Yearly. The interval is set at creation and cannot be changed. Create separate plans for each billing cycle.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ─── Plans Header + Add Button ───────────────────────────────────────── --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <div style="font-size:15px;font-weight:700;color:#111827;">
                {{ $plans->count() }} {{ Str::plural('Plan', $plans->count()) }}
            </div>
            <div style="font-size:12px;color:#6b7280;margin-top:2px;display:flex;align-items:center;gap:5px;">
                <svg style="width:12px;height:12px;color:#6366f1;" fill="currentColor" viewBox="0 0 24 24"><path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/></svg>
                Synced with Stripe
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            {{-- Sync from Stripe --}}
            <button wire:click="syncFromStripe" wire:loading.attr="disabled" wire:target="syncFromStripe"
                    style="display:inline-flex;align-items:center;gap:7px;padding:10px 18px;background:white;color:#4f46e5;border:1.5px solid #c7d2fe;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;white-space:nowrap;"
                    onmouseover="this.style.background='#eef2ff';this.style.borderColor='#a5b4fc'"
                    onmouseout="this.style.background='white';this.style.borderColor='#c7d2fe'"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                <svg wire:loading.remove wire:target="syncFromStripe" style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <svg wire:loading wire:target="syncFromStripe" style="width:14px;height:14px;animation:spin 1s linear infinite;" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                <span wire:loading.remove wire:target="syncFromStripe">Sync from Stripe</span>
                <span wire:loading wire:target="syncFromStripe">Syncing...</span>
            </button>
            {{-- Add Plan --}}
            <button wire:click="$dispatch('open-create-plan')"
                    style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#4f46e5;color:white;border:none;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;box-shadow:0 2px 8px rgba(79,70,229,0.35);transition:all 0.15s;white-space:nowrap;"
                    onmouseover="this.style.boxShadow='0 4px 16px rgba(79,70,229,0.45)';this.style.transform='translateY(-1px)'"
                    onmouseout="this.style.boxShadow='0 2px 8px rgba(79,70,229,0.35)';this.style.transform='none'">
                <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Add Plan
            </button>
        </div>
    </div>

    {{-- ─── Plan Cards ─────────────────────────────────────────────────────── --}}
    @if($plans->isEmpty())
        {{-- Empty State --}}
        <div style="text-align:center;padding:60px 20px;background:white;border:1px solid #e5e7eb;border-radius:14px;">
            <div style="width:64px;height:64px;background:#eef2ff;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg style="width:30px;height:30px;color:#6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div style="font-size:16px;font-weight:700;color:#111827;margin-bottom:6px;">No plans yet</div>
            <div style="font-size:13px;color:#6b7280;margin-bottom:20px;">Create your first subscription plan to get started.</div>
            <button wire:click="$dispatch('open-create-plan')"
                    style="display:inline-flex;align-items:center;gap:7px;padding:10px 22px;background:#4f46e5;color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;">
                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Create your first plan
            </button>
        </div>
    @else
        <div x-data="{ confirmId: null, confirmName: '' }" style="position:relative;">

            {{-- Cards Grid --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px;">
                @foreach($plans as $plan)
                    @php $isMonthly = $plan->interval === 'month'; @endphp
                    <div style="background:white;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,0.06);transition:box-shadow 0.2s,transform 0.2s;"
                         onmouseover="this.style.boxShadow='0 6px 20px rgba(0,0,0,0.1)';this.style.transform='translateY(-2px)'"
                         onmouseout="this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';this.style.transform='none'">

                        {{-- Colored accent top bar --}}
                        <div style="height:5px;background:{{ $isMonthly ? 'linear-gradient(90deg,#4f46e5,#7c3aed)' : 'linear-gradient(90deg,#7c3aed,#db2777)' }};"></div>

                        <div style="padding:20px;">

                            {{-- Name + interval badge --}}
                            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
                                <div style="font-size:16px;font-weight:700;color:#111827;line-height:1.3;">{{ $plan->name }}</div>
                                <span style="display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap;
                                    {{ $isMonthly ? 'background:#eef2ff;color:#4338ca;' : 'background:#fdf4ff;color:#7e22ce;' }}">
                                    <svg style="width:10px;height:10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $isMonthly ? 'Monthly' : 'Yearly' }}
                                </span>
                            </div>

                            {{-- Price --}}
                            <div style="margin-bottom:14px;">
                                <span style="font-size:32px;font-weight:800;color:#111827;line-height:1;">${{ number_format($plan->price, 0) }}</span>
                                <span style="font-size:13px;color:#9ca3af;margin-left:2px;">/ {{ $isMonthly ? 'mo' : 'yr' }}</span>
                            </div>

                            {{-- Divider --}}
                            <div style="border-top:1px solid #f3f4f6;margin-bottom:14px;"></div>

                            {{-- Credits --}}
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
                                <div style="width:28px;height:28px;background:#f0fdf4;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg style="width:14px;height:14px;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span style="font-size:13px;color:#374151;"><strong>{{ $plan->credits }}</strong> {{ Str::plural('credit', $plan->credits) }} — max published properties</span>
                            </div>

                            {{-- Stripe ID --}}
                            @if($plan->stripe_plan_id)
                                <div style="display:flex;align-items:center;gap:6px;margin-bottom:10px;">
                                    <div style="width:28px;height:28px;background:#f5f3ff;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <svg style="width:12px;height:12px;color:#7c3aed;" fill="currentColor" viewBox="0 0 24 24"><path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/></svg>
                                    </div>
                                    <span style="font-size:11px;color:#9ca3af;font-family:monospace;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:180px;" title="{{ $plan->stripe_plan_id }}">{{ $plan->stripe_plan_id }}</span>
                                </div>
                            @endif

                            {{-- Status + Edit + Delete --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px;padding-top:14px;border-top:1px solid #f3f4f6;">
                                @if($plan->active)
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:20px;font-size:11px;font-weight:600;color:#15803d;">
                                        <span style="width:6px;height:6px;background:#22c55e;border-radius:50%;display:inline-block;"></span>
                                        Active
                                    </span>
                                @else
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:20px;font-size:11px;font-weight:600;color:#6b7280;">
                                        <span style="width:6px;height:6px;background:#9ca3af;border-radius:50%;display:inline-block;"></span>
                                        Inactive
                                    </span>
                                @endif

                                <div style="display:flex;gap:8px;">
                                    <button type="button"
                                            wire:click="$dispatch('open-edit-plan', { id: {{ $plan->id }} })"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:white;border:1px solid #c7d2fe;border-radius:7px;color:#4f46e5;font-size:12px;font-weight:500;cursor:pointer;transition:all 0.15s;"
                                            onmouseover="this.style.background='#eef2ff';this.style.borderColor='#a5b4fc'"
                                            onmouseout="this.style.background='white';this.style.borderColor='#c7d2fe'">
                                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button"
                                            @click="confirmId = {{ $plan->id }}; confirmName = '{{ addslashes($plan->name) }}'"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:white;border:1px solid #fecaca;border-radius:7px;color:#dc2626;font-size:12px;font-weight:500;cursor:pointer;transition:all 0.15s;"
                                            onmouseover="this.style.background='#fef2f2';this.style.borderColor='#f87171'"
                                            onmouseout="this.style.background='white';this.style.borderColor='#fecaca'">
                                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ─── Delete Confirmation Overlay ─────────────────────────────── --}}
            <div x-show="confirmId !== null" x-cloak
                 style="position:fixed;inset:0;z-index:9998;"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100">

                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">

                {{-- Backdrop --}}
                <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);"
                     @click="confirmId = null; confirmName = ''"></div>

                {{-- Dialog --}}
                <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:420px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.25);overflow:hidden;"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">

                    {{-- Dialog header --}}
                    <div style="background:linear-gradient(135deg,#b91c1c,#dc2626);padding:18px 20px;display:flex;align-items:center;gap:12px;">
                        <div style="width:36px;height:36px;background:rgba(255,255,255,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg style="width:18px;height:18px;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:15px;font-weight:700;color:white;">Delete Plan</div>
                            <div style="font-size:12px;color:rgba(255,255,255,0.8);">This action cannot be undone</div>
                        </div>
                    </div>

                    {{-- Dialog body --}}
                    <div style="padding:22px 20px;">
                        <p style="font-size:13px;color:#374151;line-height:1.6;margin:0 0 6px;">
                            You are about to delete the plan:
                        </p>
                        <div style="padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;font-weight:700;font-size:14px;color:#b91c1c;margin-bottom:14px;" x-text="confirmName"></div>
                        <p style="font-size:12px;color:#6b7280;line-height:1.6;margin:0;">
                            This will also delete the plan from your <strong>Stripe account</strong>. Agents currently subscribed to this plan will not be immediately affected, but renewals will fail.
                        </p>
                    </div>

                    {{-- Dialog footer --}}
                    <div style="display:flex;gap:10px;justify-content:flex-end;padding:0 20px 20px;">
                        <button type="button" @click="confirmId = null; confirmName = ''"
                                style="padding:9px 18px;border:1px solid #e5e7eb;background:white;border-radius:8px;font-size:13px;font-weight:500;color:#374151;cursor:pointer;"
                                onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                            Cancel
                        </button>
                        <button type="button"
                                @click="$wire.deletePlan(confirmId); confirmId = null; confirmName = ''"
                                style="padding:9px 18px;background:#dc2626;color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:background 0.15s;"
                                onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                            Yes, Delete Plan
                        </button>
                    </div>
                </div>
                </div>{{-- end flex centering wrapper --}}
            </div>

        </div>{{-- end x-data --}}
    @endif

</div>
