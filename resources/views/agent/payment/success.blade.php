@extends('layouts.agents.default1')
@section('content')
    <div class="w-full p-28">
        <div class="text-center bg-light p-28 my-5">
            <i class="fa-solid fa-check text-9xl"></i>
            <p class="text-7xl uppercase">Thank You!</p>
            <br/>
            <p class="text-2xl">Subscription purchase is successful.</p>
            <br/>
            <a href="{{route('agent.dashboard')}}">
                <button class="bg-green-500 mt-8 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase"
                        type="button">Go To Dashboard
                </button>
            </a>
        </div>
    </div>
@stop