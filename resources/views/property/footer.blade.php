<section class="bg-black">
    <div class="container">
        <div class="row m-0">
            <div class="footer-block text-center">
                <p>{{$agent?->first_name}} {{ $agent?->last_name}} @if($agent?->agent_address?->business_name) -  {{ $agent?->agent_address?->business_name }} @endif</p>
                <p><a>Privacy . Cookie & Web Accessibility Policy</a></p>
                <p>Website Created With</p>
                <img width="100px" class="img-responsive" src="{{ asset('images/logo-placeholder-small.png') }}">
            </div>
        </div>
    </div>
</section>