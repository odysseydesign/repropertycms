@include('includes.agents.head')
@include('flash-message')
<div class="h-100 w-100 login-page" style='background-image: url("{{ asset('images/auth-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/logo-placeholder.png')}}" alt="Logo Not Found !">
            </div>
            <form action="{{url('agent/sign-in')}}" class="text-white" method="post">
                @csrf
                <div class="input-group-outline input-group form-group">
                    <span>EMAIL ADDRESS </span>
                    <input type="email" id="email" name="email" maxlength="255" class="form-control" placeholder=""  required/>
                </div>
                <div class="input-group-outline input-group form-group">
                    <span>PASSWORD</span>
                    <input type="password" id="password" name="password" maxlength="75" class="form-control" placeholder=""  required/>
                </div>
                <button type="submit" class="mt-5 button button-blue font-bold text-lg" onclick="AgentLoginForm()">Sign In</button>
                <div class="w-100 text-lg">
                    <p class="text-center mb-0">Don't have an account?
                        <a href="{{url('agent/sign-up')}}" class="text-primary">Sign Up</a>
                    </p>
                    <p class="text-center">Forget Your password?   <a href="{{route('password.request')}}" class="text-primary">Forget Password</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')