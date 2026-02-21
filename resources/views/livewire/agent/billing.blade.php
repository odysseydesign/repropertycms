<div class="w-full py-5">
    <div class="pb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap page-heading">
            <h3 class="mb-0">Subscription Details</h3>
            @if($agent->hasActiveSubscription())
                <button wire:click="stripePortal"
                        class="button font-bold text-base mb-0" style="background-color: rgb(0, 100, 131);">Subscription Portal
                </button>
            @else
                <button wire:click="subscriptionPlan" class="button font-bold text-base mb-0">
                    <i class="fa fa-plus mr-1"></i> Subscribe to a Plan
                </button>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table w-full table-striped table-auto">
            <thead>
            <tr>
                <th>Plan Name</th>
                <th>Properties / Used</th>
                <th>Status</th>
                <th>Expire Date</th>
                <th>Subscribed Date</th>
            </tr>
            </thead>
            @if (count($subscriptions) > 0)
                @foreach($subscriptions as $subscription)
                    <tr class="my-2">
                        <td>{{ $subscription->plan->name }}</td>
                        <td>{{ $subscription->plan->credits }} / {{ $publishedPropertiesCount }}</td>
                        <td>
                            @if ($subscription->stripe_status === 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif ($subscription->stripe_status === 'trialing')
                                <span class="badge badge-info">Trialing</span>
                            @elseif ($subscription->stripe_status === 'canceled')
                                <span class="badge badge-danger">Canceled</span>
                            @else
                                {{ $subscription->stripe_status }}
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($subscription->current_period_end)->format('d M Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y')}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No Subscription Found.</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="card shadow-lg mt-20" style="background-color:#f3f3f3; border-radius: 0px;">
        <div class="container m-5">
            <h3 class="mb-0">Subscription Plan Details</h3>
            <div class="sqs-block-content">
                <ul class="accordion-items-container" data-should-allow-multiple-open-items="" data-is-divider-enabled="true" data-is-first-divider-visible="true" data-is-last-divider-visible="true" data-accordion-title-alignment="left" data-accordion-description-alignment="left" data-accordion-description-placement="left" data-accordion-icon-placement="right">
                    <li class="accordion-item">
                        <h5 class="accordion-item__title-wrapper mb-3 mt-5" style="font-size: 175%;" role="heading" aria-level="3">
                            <hr style="border-color: #c3c3c4; box-shadow: 0px 4px 4px #c3c3c4;">
                            <button class="accordion-item_click-target mt-3" style="display: flex; justify-content: space-between; width: 100%; text-align: left;" aria-expanded="false" id="button_block_publish" aria-controls="dropdown_block_publish">
                                <span class="accordion-item__title text-black" style="font-size: 20px;">Free until you Publish</span>
                                <span id="plus" style="margin-right: 20px;">+</span>
                            </button>
                        </h5>
                        <div class="accordion-item__dropdown mb-5" role="region" id="dropdown_block_publish">
                            <div class="accordion-item__description">
                                <p style="font-size: 17px; font-family: 'Pontano Sans';">Upon publishing your property website, your subscription will become active and your credit card will be charged on the same day each month or the nearest business day.</p>
                                <br>
                            </div>
                        </div>
                        <hr style="border-color: #c3c3c4; box-shadow: 0px 4px 4px #c3c3c4;">
                        <div class="accordion-divider" aria-hidden="true" style="height: 1px; opacity: 1;"></div>
                    </li>
                    <li class="accordion-item">
                        <h5 class="accordion-item__title-wrapper mb-3 mt-5" style="font-size: 175%;" role="heading" aria-level="3">
                            <button class="accordion-item_click-target" style="display: flex; justify-content: space-between; width: 100%; text-align: left;" aria-expanded="false" id="button_block_subscription_changes" aria-controls="dropdown_block_subscription_changes">
                                <span class="accordion-item__title text-black" style="font-size: 20px;">Subscription Plan Changes</span>
                                <span id="plus" style="margin-right: 20px;">+</span>
                            </button>
                        </h5>
                        <div class="accordion-item__dropdown" role="region" id="dropdown_block_subscription_changes">
                            <div class="accordion-item__description">
                                <p style="font-size: 17px; font-family: 'Pontano Sans';"><strong>Upgrading Your Plan</strong><br>If you make changes to your subscription plan (upgrade or downgrade) during the billing cycle, nothing is billed at that time. Your plan changes will be prorated based on the number of days remaining in the prior billing period.</p>
                                <p style="font-size: 17px; font-family: 'Pontano Sans';"><strong>Downgrading Your Plan</strong><br>When you downgrade your plan, a credit is calculated that reduces your next bill.</p>
                                <br>
                            </div>
                        </div>
                        <hr style="border-color: #c3c3c4; box-shadow: 0px 4px 4px #c3c3c4;">
                        <div class="accordion-divider" aria-hidden="true" style="height: 1px; opacity: 1;"></div>
                    </li>
                    <li class="accordion-item">
                        <h5 class="accordion-item__title-wrapper mb-3 mt-5" style="font-size: 175%;" role="heading" aria-level="3">
                            <button class="accordion-item_click-target" style="display: flex; justify-content: space-between; width: 100%; text-align: left;" aria-expanded="false" id="button_block_cancelling_subscription" aria-controls="dropdown_block_cancelling_subscription">
                                <span class="accordion-item__title text-black" style="font-size: 20px;">Cancelling your Subscription</span>
                                <span id="plus" style="margin-right: 20px;">+</span>
                            </button>
                        </h5>
                        <div class="accordion-item__dropdown" role="region" id="dropdown_block_cancelling_subscription">
                            <div class="accordion-item__description">
                                <p style="font-size: 17px; font-family: 'Pontano Sans';">If you choose to cancel a subscription, we do NOT issue refunds for days remaining in a billing cycle. Cancelling your subscription will permanently delete the property website along with all associated text data and photos.</p>
                                <br>
                            </div>
                        </div>
                        <hr style="border-color: #c3c3c4; box-shadow: 0px 4px 4px #c3c3c4;">
                        <div class="accordion-divider" aria-hidden="true" style="height: 1px; opacity: 1;"></div>
                    </li>
                    <li class="accordion-item">
                        <h5 class="accordion-item__title-wrapper mb-3 mt-5" style="font-size: 175%;" role="heading" aria-level="3">
                            <button class="accordion-item_click-target" style="display: flex; justify-content: space-between; width: 100%; text-align: left;" aria-expanded="false" id="button_block_deleting_property_website" aria-controls="dropdown_block_deleting_property_website">
                                <span class="accordion-item__title text-black" style="font-size: 20px; flex-grow: 1;">Deleting a Property Website</span>
                                <span id="plus" style="margin-right: 20px;">+</span>
                            </button>

                        </h5>
                        <div class="accordion-item__dropdown" role="region" id="dropdown_block_deleting_property_website">
                            <div class="accordion-item__description">
                                <p style="font-size: 17px; font-family: 'Pontano Sans';">Please note: If you delete website(s), it does NOT automatically downgrade your subscription plan. This will permanently delete the property website along with all associated text data and photos.</p>
                                <br>
                            </div>
                        </div>
                        <hr style="border-color: #c3c3c4; box-shadow: 0px 4px 4px #c3c3c4;">
                        <div class="accordion-divider" aria-hidden="true" style="height: 1px; opacity: 1;"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
    </style>
@endpush

@push('scripts')
    <script>
        // JavaScript to handle the accordion behavior
        document.addEventListener('DOMContentLoaded', function () {
            console.log('loaded js');

            const buttons = document.querySelectorAll('.accordion-item_click-target');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    console.log('button clicked');

                    const dropdownId = button.getAttribute('aria-controls');
                    const dropdown = document.getElementById(dropdownId);
                    const icon = button.querySelector('span:last-child'); // Select the last span inside the button (icon)

                    if (!dropdown) return;

                    const isExpanded = button.getAttribute('aria-expanded') === 'true';

                    // Close all other dropdowns and reset icons
                    buttons.forEach(btn => {
                        const target = document.getElementById(btn.getAttribute('aria-controls'));
                        const btnIcon = btn.querySelector('span:last-child');
                        if (target && target !== dropdown) {
                            target.style.display = 'none';
                            btn.setAttribute('aria-expanded', 'false');
                            if (btnIcon) btnIcon.textContent = '+'; // Reset other icons
                        }
                    });

                    // Toggle the clicked dropdown
                    if (!isExpanded) {
                        dropdown.style.display = 'block';
                        button.setAttribute('aria-expanded', 'true');
                        if (icon) icon.textContent = '−'; // Change to minus
                    } else {
                        dropdown.style.display = 'none';
                        button.setAttribute('aria-expanded', 'false');
                        if (icon) icon.textContent = '+'; // Change back to plus
                    }
                });
            });

            // Hide all sections by default
            document.querySelectorAll('.accordion-item__dropdown').forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        });
    </script>
@endpush
