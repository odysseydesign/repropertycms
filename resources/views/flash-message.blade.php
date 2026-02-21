@if ($message = Session::get('success'))
    <div class="alert  alert-green  flash-div" id="alert">
        <button type="button" class="float-right close" id="btn" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-red  flash-div" id="alert">
        <button type="button" class="float-right close" id="btn" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-orange  flash-div" id="alert">
        <button type="button" class="float-right close" id="btn" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-blue  flash-div" id="alert">
        <button type="button" class="float-right" id="btn" data-dismiss="alert">×</button>
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-red  flash-div" id="alert">
        <button type="button" class="float-right" id="btn" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif