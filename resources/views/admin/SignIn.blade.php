@include('includes.agents.head')
@include('flash-message')

<div class="h-100 w-100 login-page" style='background-image: url("{{ asset('images/auth-background.jpg') }}"); padding:130px 0px;background-size:cover;'>
    <div class="rounded-lg p-8">
        <div class="agentsign rounded-lg">
            <div class="agnet_logo">
                <img src="{{asset('images/logo-placeholder-small.png')}}" alt="Logo Not Found !">
            </div>
            <form action="{{url('admin/sign-in')}}" method="post" class="text-white is-filled">
                @csrf
                <div class="input-group-outline input-group my-3">
                    <span>Email : </span>
                    <input type="text" id="email" name="email" maxlength="255" class="form-control" style="border:2px solid lightgrey;"/>
                </div>
                <div class="input-group-outline input-group my-3">
                    <span>Password</span>
                    <input type="password" id="password" name="password" maxlength="255" class="form-control" style="border:2px solid lightgrey;"/>
                </div>
                <button type="submit" class="mt-5 button button-blue font-bold text-lg">Sign In</button>
            </form>
        </div>
    </div>
</div>
@include('includes.agents.foot')