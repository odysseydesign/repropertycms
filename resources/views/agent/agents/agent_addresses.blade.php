@include('includes.agents.head')
<div class="agentsign" style="width: 60%;
    margin: 0px auto;
    background-color: #0000008a !important;">
    <div class="agnet_logo">
        <img src="{{asset('images/logo-placeholder.png')}}" alt="Logo Not Found !">
    </div>
</div>
<div class="signup-form bg-grey-100 border-2 border-solid border-grey-300 px-8 "
     style="width:60%; margin:0px auto;">
    <div class="my-6" style="text-align: center;font-size:30px;font-weight:600;">
        <h1>Profile Page</h1>
    </div>
    @include('flash-message')
    <form action="{{url('agent/agents-address-add')}}" method="post" class="" onsubmit="return validaAddress(this);">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            @php $business_name=old('business_name') @endphp
            <div class="input-group input-group-outline">
                <span>Business Name :</span>
                <input type="text" id="business_name" placeholder="" style="border: 2px solid lightgrey;"
                       maxlength="100" name="business_name" class="form-control"
                       @if(isset($business_name)) value={{$business_name}} @endif />
                <small class="text-red-700 font-bold">@error('business_name'){{$message}}@enderror</small>
            </div>
            <div class="input-group input-group-outline">
                @php $phone=old('phone') @endphp
                <span>Phone :</span>
                <input type="text" id="phone" name="phone" placeholder="" style="border: 2px solid lightgrey;"
                       maxlength="50" class="form-control" @if(isset($phone)) value={{$phone}} @endif required/>
                <small id="phonehelp" class="text-red-700 font-bold">@error('phone'){{$message}}@enderror</small>
            </div>

            <div class="w-100">
                @php $country=old('countries') @endphp
                <span>Country :</span>
                <input id="country_name" name="country_name" placeholder="" style="border: 2px solid lightgrey;"
                       value="{{isset($countries) ? $countries->name : ''}}" class="form-control px-3" readonly/>
                <small id="countrieshelp" class="text-red-700 font-bold">@error('countries')
                    *{{$message}}@enderror</small>
            </div>
            <div class="input-group input-group-outline is-filled">
                @php $state=old('state') @endphp
                <span>State :</span>
                <select class="form-control" @if(isset($state)) value={{$state}} @endif name="state_id" id="state_id"
                        placeholder="Language" required>
                    <option value="0" selected>Choose State</option>
                    @foreach($states as $state)
                        <option value="{{$state->state_id}}">{{$state->name}}</option>
                    @endforeach
                </select>
                <small id="statehelp" class="text-red-700 font-bold">@error('state'){{$message}}@enderror</small>
            </div>
            <div class="input-group input-group-outline">
                @php $city=old('city') @endphp
                <span>City :</span>
                <input type="text" id="city" maxlength="100" placeholder="" style="border: 2px solid lightgrey;"
                       name="city" class="form-control" @if(isset($city)) value={{$city}} @endif  required/>
                <small id="cityhelp" class="text-red-700 font-bold">@error('state'){{$message}}@enderror</small>
            </div>
            <div class="input-group input-group-outline">
                @php $zip=old('zip') @endphp
                <span>Zip :</span>
                <input type="text" id="zip" maxlength="10" placeholder="" style="border: 2px solid lightgrey;"
                       name="zip" maxlength="6" min="1" class="form-control"
                       @if(isset($zip)) value={{$zip}} @endif required/>
                <small id="ziphelp" class="text-red-700 font-bold">@error('zip')*{{$message}}@enderror</small>
            </div>
        </div>
        <div class="input-group input-group-outline">
            @php $zip=old('address') @endphp
            <span>Address : </span>
            <textarea id="address" name="address" placeholder="" style="border: 2px solid lightgrey;"
                      class="form-control" required>@if(isset($address))
                    value={{$address}}
                @endif</textarea>
            <small id="addresshelp" class="text-red-700 font-bold">@error('address')*{{$message}}@enderror</small>
        </div>
        <button type="submit" class="button button-green w-36 mt-10 mb-10" data-ripple-light="true">Submit</button>
        <button type="reset" class="button  button-orange w-36 ml-10 " data-ripple-light="true">Reset</button>
    </form>
</div>
@include('includes.agents.foot')