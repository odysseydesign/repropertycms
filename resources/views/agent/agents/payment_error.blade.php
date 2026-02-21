@extends('layouts.agents.default1')
@section('content')

    <div class="w-full p-28">
        <div class="text-center bg-light p-28 my-5 text-red-700">
            <i class="fa-solid fa-circle-exclamation text-7xl mb-9 "></i>
            <p class="text-7xl uppercase">Transaction Failed!</p>
            <br/>
            <p>Your payment is not received. You can try again by clicking on the below button.</p>
            <br/>
            <a href="{{ route('agent.billing') }}">
                <button class="bg-grey-400 mt-8 hover:bg-red-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase"
                        type="button">Go To Plans Page
                </button>
            </a>
        </div>
    </div>

@stop