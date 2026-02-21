@include('includes.agents.head')
<div class="w-100 h-100 login-page"
     style='background-image: url("{{ asset('images/signup-background.jpg') }}"); padding:100px 0px;background-size:cover;'>
    <div class="rounded-lg p-8 agentsign" style="width: 35%; margin: 0px auto; background-color:rgba(0, 0, 0, 0.4)">
        <div class="agnet_logo">
            <img src="{{asset('images/logo_small.png')}}" alt="Logo Not Found !">
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="outer-row">
                <div class="input-group input-group-outline form-group mx-2">
                    <x-label class="text-white" for="first_name" :value="__('First Name')"/>

                    <x-input id="first_name" class="form-control p-3 block mt-1 w-full" type="text" name="first_name"
                             :value="old('first_name')" required autofocus/>
                </div>

                <div class="input-group input-group-outline form-group mx-2">
                    <x-label class="text-white" for="last_name" :value="__('Last Name')"/>

                    <x-input id="last_name" class="form-control p-3 block mt-1 w-full" type="text" name="last_name"
                             :value="old('last_name')" required autofocus/>
                </div>
            </div>
            <div class="outer-row">
                <!-- Email Address -->
                <div class="input-group input-group-outline form-group mx-2">
                    <x-label class="text-white" for="email" :value="__('Email')"/>

                    <x-input id="email" class="form-control p-3 block mt-1 w-full" type="email" name="email"
                             :value="old('email')" required/>
                </div>
            </div>
            <div class="outer-row">
                <!-- Password -->
                <div class="input-group input-group-outline form-group mx-2">
                    <x-label class="text-white" for="password" :value="__('Password')"/>

                    <x-input id="password" class="form-control p-3 block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="new-password"/>
                </div>

                <!-- Confirm Password -->
                <div class="input-group input-group-outline form-group mx-2">
                    <x-label class="text-white" for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input id="password_confirmation" class="form-control p-3 block mt-1 w-full"
                             type="password"
                             name="password_confirmation" required/>
                </div>
            </div>

            <div class="outer-row">
                <!-- Password -->
                <label for="remember_me" class="inline-flex items-center mx-2">
                    <x-input id="terms_and_conditions" type="checkbox" value="1" class="text-white rounded border-gray-300  shadow-sm focus:ring-opacity-50" name="terms_and_conditions" required/>
                    <span class="ml-2 text-sm text-white">{{ __('By Clicking this box, you are accepting our ') }}
                        <a href="{{ route('termsAndConditions') }}" target="_blank" class="text-primary" id="termsAndConditions">Terms & Conditions</a>
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="mt-5 button button-blue font-bold text-lg">
                    {{ __('Register') }}
                </x-button>
            </div>
            <div class="w-100 text-lg text-white">
                <p class="text-center mb-0">Already have an Account? <a href="{{route('login')}}" class="text-primary">Sign
                        In</a>
                </p>
                @if (Route::has('password.request'))
                    <p class="text-center">Forget Your password? <a href="{{route('password.request')}}"
                                                                    class="text-primary">Forget Password</a></p>
                @endif
            </div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
        </form>
    </div>
</div>
@include('includes.agents.foot')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function (token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>