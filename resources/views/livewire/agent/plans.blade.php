<x-form-modal on-submit="save">
    <x-slot name="title">Subscribe to a Plan</x-slot>
    <div class="container max-w-screen-xl mx-auto px-4">
        <div class="flex flex-wrap justify-center">

        @foreach($plans as $plan)
                <div class="md:w-1/3 lg:w-1/3 p-6">
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 relative">
                        <div class="absolute top-0 right-0 -mt-3 -mr-3 bg-blue-500 text-white px-2 py-1 rounded-bl-md text-sm font-bold">{{ $plan->name }} </div>
                        

                        @if($plan->name == 'Pilot')
                        <div class="text-center text-5xl font-bold text-blue-500 mb-4 relative">
                            <!-- Discount Badge (inside flow) -->
                            <div class="inline-block bg-blue-500 text-white px-3 py-1 rounded-bl-md text-sm font-bold ml-5">
                                50% off <span class="line-through text-white text-xs ml-1">was ${{ $plan->price }}</span>
                            </div>
                        
                            <!-- Discounted Price -->
                            <div>
                                ${{ $plan->price / 2 }}
                                <span class="text-lg font-normal text-gray-500">/{{ $plan->interval }}</span>
                            </div>
                        </div>
                        
                        @endif

                        @if($plan->name != 'Pilot')
                        <div class="text-center text-5xl font-bold text-blue-500 mb-4">
                            ${{ $plan->price }}<span class="text-lg font-normal text-gray-500">/{{ $plan->interval }}</span>
                        </div>
                        @endif
                        <ul class="list-disc list-inside mb-6 text-gray-600">
                            <li class="font-semibold">{{ $plan->credits }} Properties</li>
                            {{-- Add more features here --}}
                        </ul>

                        <div class="text-center">
                            <button wire:click="subscribeNow({{ $plan->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Subscribe Now
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-form-modal>
