<div>
    <!-- feature section -->
    <section class="bg-white py-16 md:mt-10">

        <div class="container max-w-screen-xl mx-auto px-4">

            <p class="font-light text-gray-500 text-lg md:text-xl text-center uppercase mb-6">Our features</p>

            <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center leading-normal mb-10">We believe we
                can
                save <br> more life with you</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20">
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 py-6 flex justify-center bg-blue-200 bg-opacity-30 text-blue-700 rounded-xl">
                            <i data-feather="globe"></i>
                        </div>
                    </div>

                    <h4 class="font-semibold text-lg md:text-2xl text-gray-900 mb-6">Transparent</h4>

                    <p class="font-light text-gray-500 text-md md:text-xl mb-6">Donations and distributions can be seen
                        transparently</p>

                    <div class="flex justify-center">
                        <a href="#"
                           class="flex items-center gap-5 px-6 py-4 font-semibold text-info text-lg rounded-xl hover:bg-info hover:text-white transition ease-linear duration-500">
                            Learn more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 py-6 flex justify-center bg-blue-200 bg-opacity-30 text-blue-700 rounded-xl">
                            <i data-feather="arrow-up-right"></i>
                        </div>
                    </div>

                    <h4 class="font-semibold text-lg md:text-2xl text-gray-900 mb-6">Quick Fundraise</h4>

                    <p class="font-light text-gray-500 text-md md:text-xl mb-6">The simple and quickest way to make a
                        donation</p>

                    <div class="flex justify-center">
                        <a href="#"
                           class="flex items-center gap-5 px-6 py-4 font-semibold text-info text-lg rounded-xl hover:bg-info hover:text-white transition ease-linear duration-500">
                            Learn more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 py-6 flex justify-center bg-blue-200 bg-opacity-30 text-blue-700 rounded-xl">
                            <i data-feather="clock"></i>
                        </div>
                    </div>

                    <h4 class="font-semibold text-lg md:text-2xl text-gray-900 mb-6">Real Time</h4>

                    <p class="font-light text-gray-500 text-md md:text-xl mb-6">Reports related to donations and
                        distribution are updated directly</p>

                    <div class="flex justify-center">
                        <a href="#"
                           class="flex items-center gap-5 px-6 py-4 font-semibold text-info text-lg rounded-xl hover:bg-info hover:text-white transition ease-linear duration-500">
                            Learn more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div> <!-- container.// -->

    </section>
    <!-- feature section //end -->

    <!-- donation section -->
    <section class="bg-gray-200 py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center mb-16">Plans</h1>

            <div class="flex flex-wrap justify-center">
                @foreach($plans as $plan)
                    <div class="w-full md:w-1/3 lg:w-1/3 p-6">
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 relative">
                            <div
                                    class="absolute top-0 right-0 -mt-3 -mr-3 bg-blue-500 text-white px-2 py-1 rounded-bl-md text-sm font-bold">
                                {{ $plan->name }}</div>

                            <div class="text-center text-5xl font-bold text-blue-500 mb-4">
                                ${{ $plan->price }}<span
                                        class="text-lg font-normal text-gray-500">/{{ $plan->interval }}</span>
                            </div>

                            <ul class="list-disc list-inside mb-6 text-gray-600">
                                <li class="font-semibold">{{ $plan->credits }} Properties</li>
                                {{-- Add more features here --}}
                            </ul>

                            <div class="text-center">
                                <button wire:click="subscribeNow({{ $plan->id }})"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Subscribe Now
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
