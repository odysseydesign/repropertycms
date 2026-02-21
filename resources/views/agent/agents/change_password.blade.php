@extends('layouts.agents.default1')
@section('content')
    <div class="flex justify-center change-password">
        <div class="w-1/2 mt-10 bg-grey-100 border-2 border-solid border-grey-300 p-8 form-bg">
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <form action="{{url('agent/change-password')}}" method="post" onsubmit="return checkPassword();">
                @csrf
                <div class="input-group input-group-outline mt-5">
                    <span>Old Password :</span>
                    <input type="password" name="oldpassword" style="border:2px solid lightgrey;" placeholder="" maxlength="75" id="oldpassword" class="form-control" />
                </div>
                <div class="input-group input-group-outline mt-5">
                    <span>New Password :</span>
                    <input type="password" name="newpassword" placeholder="" maxlength="75" style="border:2px solid lightgrey;" id="newpassword" class="form-control" />
                </div>
                <div class="input-group input-group-outline mt-5">
                    <span>Confirm Password :</span>
                    <input type="password" name="confirm_password" placeholder="" maxlength="75" style="border:2px solid lightgrey;" id="confirm_password" class="form-control" />
                </div>
                <button class="button button-green mt-5" data-ripple-light="true">
                    Save
                </button>
            </form>
        </div>

    </div>
@stop