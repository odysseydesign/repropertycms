<div class="w-full py-5">
    <div class="pb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap page-heading">
            <h3 class="mb-0">Dashboard</h3>
            @if($agent->hasActiveSubscription())
                <button wire:click="stripePortal"
                        class="button font-bold text-base mb-0" style="background-color: rgb(0, 100, 131);">Subscription Portal
                </button>
            @endif
        </div>
    </div>
    @if($subscriptionAlert && isset($subscriptionAlert['alert_message']))
        <div class="alert d-flex align-items-center p-4 mb-4 rounded shadow-sm" 
             style="background-color: {{ $subscriptionAlert['alert_color'] }};
                border-left: 6px solid {{$subscriptionAlert['alert_color']}};
             ">
            <div class="mr-3" style="font-size: 2rem; color: {{ $subscriptionAlert['alert_foreground_color'] }};">
                {!! $subscriptionAlert['alert_icon'] !!}
            </div>
            <div>
                <div class="font-weight-bold mb-1" style="font-size: 1.15rem; color: {{ $subscriptionAlert['alert_foreground_color'] }};">
                   {{ $subscriptionAlert['alert_section'] }}
                </div>
                <div style="font-size: 1rem; color: #333;">
                    {{ $subscriptionAlert['alert_message'] }}
                </div>
            </div>
        </div>
    @endif
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0 font-bold">Published Properties</h5>
        @if($published_properties->count() == 0 || $agent->hasActiveSubscription())
            <a href="{{url('agent/property/address')}}" class="button btn-blue m-0">
                <i class="fa fa-plus mr-1"></i> New Property
            </a>
        @else
            <button wire:click="subscriptionPlan" class="button btn-blue m-0">
                <i class="fa fa-plus mr-1"></i> New Property
            </button>
        @endif
    </div>

    <x-property_list :property="$published_properties"/>
    <br>
    <div class="d-flex align-items-center justify-content-between my-4">
        <h5 class="mb-0 font-bold">Unpublished Properties</h5>
    </div>
    <x-property_list :property="$property_update"/>

</div>