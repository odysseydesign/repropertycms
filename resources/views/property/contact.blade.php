<div class="row m-0 p-0 text-white d-sm-block" style="position: relative">
    <div class="col-md-12 p-0">
        <div class="footer-icon">
                    <span class="footer-label">
                        <label class="text-uppercase px-4">Share This Property</label>
                    </span>

            <span class="footer-icon-logo">
                        <a href="https://www.instagram.com/share?url={{url('/')}}/{{ $property->unique_url }}"
                           class="border-end" target="_blank">
                            <i class="fa-brands fa-instagram text-white"></i>
                        </a>

                        <a href="https://www.facebook.com/sharer.php?u={{url('/')}}/{{ $property->unique_url }}"
                           class="border-end" target="_blank">
                            <i class="fa-brands fa-facebook-f text-white"></i>
                        </a>

                        <a href="mailto:?Subject=TEST&body= {{url('/')}}/{{ $property->unique_url }}" class="border-end"
                           target="_blank">
                            <i class="fa-solid fa-envelope text-white"></i>
                        </a>

                        <a href="https://twitter.com/share?url= {{url('/')}}/{{ $property->unique_url }}"
                           target="_blank">
                            <i class="fa-brands fa-twitter text-white"></i>
                        </a>
                    </span>
        </div>
    </div>
    <div class="col-md-12 p-0" style="@if($property_Random_Img)
                background-image:url('{{asset_s3($property_Random_Img->file_name)}}'); height:100%; background-repeat:no-repeat;background-size:cover;
                @endif">
        <div class="row m-0 p-0 py-5">
            <!-- Contact form -->
            <div class="col-md-6 d-sm-block mx-auto contact-form-block">
                <div class="text-white p-5 footer-contact-form">  {{-- Removed ID --}}
                    <p class="fw-bold fs-1 property-page-title"> Request Info</p>

                    <form wire:submit.prevent="submitContactForm">  {{-- Livewire form --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control bg-transparent text-white" id="name"
                                   wire:model="name"
                                   placeholder="Enter Your Name">
                            @error('name') <p
                                    class="small text-danger">{{ $message }}</p> @enderror {{-- Error handling --}}
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail*</label>
                            <input type="email" class="form-control bg-transparent text-white" id="email"
                                   wire:model="email"
                                   placeholder="Enter Your Email">
                            @error('email') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="tel" class="form-control bg-transparent text-white" id="phone"
                                   wire:model="phone"
                                   placeholder="Enter your Phone Number">
                            @error('phone') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>


                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control bg-transparent text-white"
                                      placeholder="Leave a comment here" id="comments" wire:model="comments"
                                      style="height: 300px"></textarea>
                            @error('comments') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>


                        <button type="submit" class="btn btn-outline-light px-5">Submit</button>

                        <div wire:loading wire:target="submitContactForm"> {{-- Loading state--}}
                            <button class="btn btn-primary bg-transparent border border-white px-5" type="button"
                                    disabled>
                                <span class="spinner-border spinner-border-sm mx-3" role="status"
                                      aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                        @if (session()->has('success_message'))
                            <div class="alert alert-success mt-3">
                                {{ session('success_message') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>