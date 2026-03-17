@include('includes.agents.head')

<div class="h-100 w-100 login-page"
     style='background-image: url("{{ asset('images/auth-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/logo-placeholder.png')}}" alt="Logo Not Found !">
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="input-group-outline input-group form-group">
                    <x-label class="text-white" for="email" :value="__('Email')"/>

                    <x-input id="email" class="form-control p-3 block mt-1 w-full" type="email" name="email"
                             :value="old('email', $request->email)" required autofocus/>
                </div>

                <!-- Password -->
                <div class="input-group-outline input-group form-group">
                    <x-label class="text-white" for="password" :value="__('Password')"/>

                    <x-input id="password" class="form-control p-3 block mt-1 w-full" type="password" name="password"
                             required/>
                </div>

                <!-- Confirm Password -->
                <div class="input-group-outline input-group form-group">
                    <x-label class="text-white" for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input id="password_confirmation" class="form-control p-3 block mt-1 w-full"
                             type="password"
                             name="password_confirmation" required/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="mt-5 button button-blue font-bold text-lg">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')
