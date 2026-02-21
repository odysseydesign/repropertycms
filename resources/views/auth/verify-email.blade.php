@include('includes.agents.head')

<div class="h-100 w-100 login-page"
     style='background-image: url("{{ asset('images/signup-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/realtyinterface_logo.png')}}" alt="Logo Not Found !">
            </div>

            <div class="mb-4 text-lg text-white" style="line-height: 2">
                Thanks for signing up! <br>
                Before getting started, could you verify your email address by clicking on the link we just emailed to you? <br>
                If you didn't receive the email, we will gladly send you another.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-button class="mt-5 button button-blue font-bold text-lg">
                            {{ __('Resend Verification Email') }}
                        </x-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-white hover:text-gray-900" style="font-size: 16px">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.agents.foot')

