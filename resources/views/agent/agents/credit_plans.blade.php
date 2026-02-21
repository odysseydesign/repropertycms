@extends('layouts.agents.default1')
@section('content')

    <div class="w-full">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Credit Plans</h5>
        </div>
        <p>
            # Here you can buy credits by selecting a Plan below. Credits allow you to publish a property. <br/>
            # <b>1 Credit = 1 published property site.</b><br/>
            # Your credits NEVER EXPIRE. Once purchased you can use your credits anytime you want.<br/>
            # Credits once purchased are NON REFUNDABLE.
        </p>
    </div>
    @if(count($plans) > 0)
        <div class="grid grid-cols-3 price-cards">
            @foreach($plans as $plan)
                <div class="card justify-center">
                    <form action="{{url('agent/stripe-checkout')}}" method="POST" class="w-full text-center">
                        @csrf
                        <div class="w-full" id="{{$plan->id}}">
                            <input type="hidden" value="{{ $plan->id }}" name="id">

                            <p class="font-bold text-3xl mt-6 w-full">{{ $plan->name }}</p>

                            <p class="font-bold mt-2 text-lg w-full">$ {{ $plan->price }} </p>

                            <span class="mt-5 w-full" style="display:block;">{{ $plan->credits }} Credits</span>

                            <button class="bg-purple-300 hover:bg-purple-700 py-2 px-3 mx-auto rounded my-5 text-white font-bold" type="submit">Buy Now</button>

                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <h5 class="text-center my-12 text-4xl">Our Plans comming soon ...!</h5>
    @endif

@stop