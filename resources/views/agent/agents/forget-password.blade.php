@include('includes.agents.head')
@include('flash-message')
<div class="h-100 w-100 login-page" style='background-image: url("{{ asset('images/auth-background.jpg') }}");background-size:cover;'>
    <div class="rounded-lg p-8 agentsign" >
        <div class="agnet_logo">
            <img src="{{asset('images/logo-placeholder-small.png')}}" alt="Logo Not Found !">
        </div>
        <div class="text-white" id="forgot-password">
            <div class="input-group-outline input-group my-3">
                <span>EMAIL ADDRESS </span>
                <input type="email" name="email" id="email" maxlength="255" value="{{old('email')}}" required="required" placeholder=""  class="form-control" />
            </div>
            <button type="submit" onclick="forgotAgentPassword();" class="mt-5 button button-blue font-bold text-lg">Forget Password</button>
            <div class="w-100 text-lg">
                <p class="text-center mb-0">Don't have an account?  <a href="{{url('agent/sign-up')}}" class="text-primary" >Sign Up</a> </p>
                <p class="text-center mb-0 ">Have an account?  <a href="{{url('agent/sign-in')}}" class="text-primary" >Sign In now</a></p>
            </div>
        </div>
        <div class="hidden text-white" id="verification-code">
            <form action="{{url('agent/forgot-password-verification')}}" method="post" onsubmit="return resetAgentPasswordValidate();">
                @csrf
                <div class="input-group-outline input-group my-3">
                    <span>Enter Verification Code</span>
                    <input type="text" name="verification_code" id="verification_code" maxlength="255" class="form-control" placeholder=""  required/>
                    <input type="hidden" name="reset_email" id="reset_email" class="form-control" />
                </div>
                <button type="submit" class="mt-5 button button-blue font-bold text-lg">Submit</button>
                <div class="w-100 text-lg">
                    <p class="text-center mb-0">Don't have an account? <a href="{{url('agent/sign-up')}}" >Sign Up</a> </p>
                    <p class="text-center mb-0">Have an account? <a href="{{url('agent/sign-in')}}" >Sign In now</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')