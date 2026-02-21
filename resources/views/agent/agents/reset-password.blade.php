@include('includes.agents.head')
@include('flash-message')

<div class="resetPassword">
    <div class="card m-20 lg:ml-52 lg:mr-52">
        <div class="card-header mx-4 -mt-6">
            <div class="shadow-pink pe-1 rounded-lg ri-bg-blue py-3">
                <h4 class="mt-2 mb-0 font-bold text-white text-center">Reset Password</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="forgot-password">
                <form action="{{url('agent/reset-password')}}" method="post" onsubmit="return resetValidate();">
                    @csrf
                    <div class="input-group-outline input-group my-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="newpassword" id="newpassword"  maxlength="75" required="required" class="form-control" required/>
                        <small id="newpassword_help" class="form-text text-danger">@error('newpassword'){{$message}}@enderror</small>
                    </div>
                    <div class="input-group-outline input-group my-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" maxlength="75" required="required" class="form-control" required/>
                        <small id="confirm_password_help" class="form-text text-danger">@error('newpassword'){{$message}}@enderror</small>
                    </div>
                    <input type="hidden" name="email" value="{{$email}}" id="email" class="form-control" required="required" />
                    <button type="submit" class="button button-blue">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('includes.agents.foot')