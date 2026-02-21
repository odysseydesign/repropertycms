@include('includes.agents.head')
@include('flash-message')
<div class="h-100 w-100 login-page"
     style='background-image: url("{{ asset('images/signup-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/realtyinterface_logo.png')}}" alt="Logo Not Found !">
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label class="text-white" for="email" :value="__('Email')"/>

                    <x-input id="email" class="form-control block mt-1 w-full p-3" type="email" name="email"
                             :value="old('email')"
                             required autofocus/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label class="text-white" for="password" :value="__('Password')"/>

                    <x-input id="password" class="form-control block mt-1 w-full p-3"
                             type="password"
                             name="password"
                             required autocomplete="current-password"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="text-white rounded border-gray-300  shadow-sm focus:ring-opacity-50"
                               name="remember">
                        <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="mt-5 button button-blue font-bold text-lg">
                        {{ __('Sign in') }}
                    </x-button>
                </div>
                <div class="w-100 text-lg text-white">
                    <p class="text-center mb-0">Don't have an account?
                        <a href="{{route('register')}}" class="text-primary">Sign Up</a>
                    </p>
                    @if (Route::has('password.request'))
                        <p class="text-center">Forget Your password? <a href="{{route('password.request')}}"
                                                                        class="text-primary">Forget Password</a></p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')
