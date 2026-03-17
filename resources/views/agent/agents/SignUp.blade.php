@include('includes.agents.head')
<div class="w-100 h-100 login-page"
     style='background-image: url("{{ asset('images/auth-background.jpg') }}"); padding:100px 0px;background-size:cover;'>
    <div class="rounded-lg p-8 agentsign" style="width: 35%; margin: 0px auto; background-color:rgba(0, 0, 0, 0.4)">
        <div class="agnet_logo">
            <img src="{{asset('images/logo-placeholder-small.png')}}" alt="Logo Not Found !">
        </div>
        @include('flash-message')
        <form action="{{url('agent/sign-up')}}" method="POST">
            @csrf
            <div class="text-white">
                <div class="outer-row">
                    <div class="input-group input-group-outline form-group mx-2">
                        <span>First Name</span>
                        <input type="text" id="first_name" name="first_name" placeholder="" maxlength="100"
                               class="form-control" value="{{old('first_name')}}"/>
                        <small id="first_namehelp"
                               class="text-red-700 font-bold">@error('first_name'){{$message}}@enderror</small>
                    </div>
                    <div class="input-group input-group-outline form-group mx-2">
                        <span>Last Name</span>
                        <input type="text" id="last_name" name="last_name" placeholder="" class="form-control"
                               maxlength="100" value="{{old('last_name')}}"/>
                        <small id="last_namehelp"
                               class="text-red-700 font-bold">@error('last_name'){{$message}}@enderror</small>
                    </div>
                </div>
                <div class="outer-row">  {{-- Added w-full --}}
                    <div class="input-group input-group-outline form-group w-full mx-2"><span>Email</span>
                        <input type="email" id="email" name="email" placeholder="" class="form-control"
                               maxlength="255"
                               value="{{old('email')}}"/>
                        <small id="emailhelp"
                               class="text-red-700 font-bold">@error('email'){{$message}}@enderror</small>
                    </div>
                </div>
                <div class="outer-row">
                    <div class="input-group input-group-outline form-group mx-2">
                        <span>Password</span>
                        <input type="password" id="password" name="password" placeholder="" class="form-control"
                               maxlength="75"/>
                        <small id="passwordhelp"
                               class="text-red-700 font-bold">@error('password'){{$message}}@enderror</small>
                    </div>
                    <div class="input-group input-group-outline form-group mx-2">
                        <span>Confirm Password</span>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder=""
                               class="form-control"/>
                        <small id="confirm_passwordhelp"
                               class="text-red-700 font-bold">@error('confirm_password'){{$message}}@enderror</small>
                    </div>
                </div>
                <div class="input-group input-group-outline outer-row">
                    <div class="input-group input-group-outline form-group mx-2">
                        <button type="submit" class="button button-blue font-bold text-lg mb-0"
                                data-ripple-light="true">Sign Up
                        </button>
                    </div>
                    <div class="input-group input-group-outline form-group mx-2">
                        <button type="reset" class="w-full button button-grey font-bold text-lg mb-0"
                                data-ripple-light="true">Reset
                        </button>
                    </div>
                </div>
                <div class="w-100 text-lg" style="margin: auto; text-align:center;">
                    <p>Have an account? <a href="{{url('agent/sign-in')}}" style="color: skyblue;">Sign In now</a>
                    </p>
                    <p>Forget Your Password? <a href="{{route('agent.forget_password')}}"
                                                style="color: skyblue;">Reset it here</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
@include('includes.agents.foot')