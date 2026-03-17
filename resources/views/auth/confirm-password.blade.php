@include('includes.agents.head')
<div class="w-100 h-100 login-page"
     style='background-image: url("{{ asset('images/auth-background.jpg') }}"); padding:100px 0px;background-size:cover;'>
    <div class="rounded-lg p-8 agentsign" style="width: 35%; margin: 0px auto; background-color:rgba(0, 0, 0, 0.4)">
        <div class="agnet_logo">
            <img src="{{asset('images/logo-placeholder-small.png')}}" alt="">
        </div>

        {{--        <div class="mb-4 text-sm text-gray-600">--}}
        {{--            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}--}}
        {{--        </div>--}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mt-4">
                <x-label class="text-white" for="password" :value="__('Password')"/>

                <x-input id="password" class="form-control p-3 block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password"/>
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="mt-5 button button-blue font-bold text-lg">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@include('includes.agents.foot')
