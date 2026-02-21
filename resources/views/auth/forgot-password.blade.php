@include('includes.agents.head')

<div class="h-100 w-100 login-page"
     style='background-image: url("{{ asset('images/signup-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/realtyinterface_logo.png')}}" alt="Logo Not Found !">
            </div>

            <div class="flex items-center justify-center">
                <div class="text-white w-[50%] p-4"> <!-- Adjust width as needed -->
{{--                    <p class="text-xl">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>--}}
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" class="text-white" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group-outline input-group form-group">
                    <span><x-label class="text-white" for="email" :value="__('Email')"/></span>
                    <input type="email" id="email" value="{{ old('email') }}" name="email" maxlength="255"
                           class="form-control" placeholder="" required autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="mt-5 button button-blue font-bold text-lg">
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')