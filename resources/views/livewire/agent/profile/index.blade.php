<div class="w-full py-5" x-data="{ confirmAction: null }">
    <div class="pb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap page-heading">
            <h3 class="mb-0">Create your Profile</h3>
        </div>
    </div>
    <div class="flex justify-center profile flex-wrap form-bg w-full">
        <div class="profile-images">
            <div class="column">
                <div>
                    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                        <h5 class="mb-0">Profile image</h5>
                    </div>
                    <div class="text-left inline-block mt-3" id="upload-profile">
                        @if($agent->profile_image)
                            <div class="mt-5" id="delete-profile">
                                <div class="w-full">
                                    <img src="{{ asset_s3($agent->profile_image) }}" class="profile-image"/>
                                    <a href="#"
                                       onclick="Livewire.dispatch('open-add-profile-image')"
                                       style="font-size: 16px; color: #3a3a3a">
                                        <i class="fa fa-pencil mr-1"></i>
                                    </a>
                                    <a href="#" @click.prevent="confirmAction = 'profile'" disable id="addvideos"
                                       class="" style="font-size: 14px;color:red" data-ripple-light="true"><i
                                                class="fa fa-trash mr-2"></i></a>
                                </div>
                            </div>
                        @else
                            <a href="#"
                               onclick="Livewire.dispatch('open-add-profile-image')"
                               class="button button-logo-green">
                                <i class="fa fa-plus mr-1"></i> Add Profile Image
                            </a>
                        @endif
                    </div>
                </div>
                @php
                    if($agent->logo_image == ""){
                        $show_upload_btn='inline block';
                        $delete_btn='hidden';
                    }else{
                        $show_upload_btn='hidden';
                        $delete_btn='inline-block';
                    }
                @endphp
            </div>
            <div class="column">
                <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                    <h5 class="mb-0">Logo Image</h5>
                </div>
                <div class="text-left mt-5" id="upload-logo">
                    @if($agent->logo_image)
                        <div class="mt-5" id="delete-logo">
                            <div class="w-full">
                                <img src="{{ asset_s3($agent->logo_image) }}" class="profile-image mb-2"/>
                                <a href="#"
                                   onclick="Livewire.dispatch('open-add-logo-image')"
                                   style="font-size: 16px; color: #3a3a3a">
                                    <i class="fa fa-pencil mr-1"></i>
                                </a>
                                <a href="#" @click.prevent="confirmAction = 'logo'" disable id="addvideos"
                                   class="" style="font-size: 14px;color:red"  data-ripple-light="true"><i
                                            class="fa fa-trash mr-2"></i></a>
                            </div>
                        </div>
                    @else
                        <a href="#"
                           onclick="Livewire.dispatch('open-add-logo-image')"
                           class="button button-logo-green">
                            <i class="fa fa-plus mr-1"></i> Add Logo Image
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center profile flex-wrap form-bg w-full">
        <div class="profile-content">
            <!-- start code for Basic Details section  -->
            <div class="column">
                <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                    <h5 class="mb-0">Basic Details</h5>
                </div>
                <p style="font-size: large"><b>Name: </b> {{$agent->first_name}} {{$agent->last_name}}</p>
                <p style="font-size: large"><b>Email: </b> {{$agent->email}}</p>
                <div class="text-left inline-block">
                    <a href="#"
                       onclick="Livewire.dispatch('open-edit-details')"
                       class="button button-logo-green  mt-2">
                        <i class="fa fa-pencil mr-1"></i> Edit Details
                    </a>
                </div>
                <div class="mt-5 block">
                    <a onclick="Livewire.dispatch('open-change-password')"
                       class="button button-secondary mb-0" data-ripple-light="true"> <i
                                class="fa fa-pencil mr-2" style="font-size: 14px"></i>Change Password</a>
                </div>
            </div>
            <!-- end code for Basic Details section  -->

            <!-- start code for address section  -->
            <div class="column">
                <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                    <h5 class="mb-0">Address</h5>
                </div>
                @if($agent->agent_address)
                    <p><b>Business Name: </b> {{$agent->agent_address->business_name}}</p>
                    <p>
                        <b>Address: </b> <br/>
                        {{$agent->agent_address->address}}<br/>
                        {{$agent->agent_address->city}}, {{$agent->agent_address->state?->name}}
                        - {{$agent->agent_address->zip}}<br/>
                        {{$agent->agent_address->state?->name}}<br/>
                        {{$agent->agent_address->country?->name}}
                    </p>
                    <p><b>Phone: </b> {{$agent->agent_address->phone}}</p>
                @endif

                <div class="text-left inline-block">
                    <a onclick="Livewire.dispatch('open-edit-address')"
                       class="button button-logo-green mb-0" data-ripple-light="true"><i class="fa fa-pencil mr-2"></i> Edit
                        Address</a>
                </div>

                <!-- start code for social media section  -->
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap page-heading mt-7">
                    <h5 class="mb-0">Social Profiles</h5>
                </div>
                @if(!is_null($agent->facebook_profile))
                    <p>
                        <b>Facebook Profile:</b> {{$agent->facebook_profile}}
                    </p>
                @endif

                @if(!is_null($agent->instagram_profile))
                    <p>
                        <b>Instagram Profile:</b> {{$agent->instagram_profile}}
                    </p>
                @endif

                @if(!is_null($agent->twitter_profile))
                    <p>
                        <b>Twitter Profile: </b> {{$agent->twitter_profile}}
                    </p>
                @endif

                @if(!is_null($agent->linkedin_profile))
                    <p>
                        <b>Linkedin Profile: </b> {{$agent->linkedin_profile}}
                    </p>
                @endif

                <div class="text-left inline-block">
                    <a onclick="Livewire.dispatch('open-edit-social-media')"
                       class="button button-logo-green mb-0" data-ripple-light="true"> <i
                                class="fa fa-pencil mr-2"></i>Edit Social Media</a>
                </div>
                <!-- end code for social media section  -->
            </div>
            <!-- end code for address section  -->
        </div>
    </div>

    {{-- Delete Confirmation Overlay --}}
    <div x-show="confirmAction !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="confirmAction = null"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;" x-text="confirmAction === 'profile' ? 'Delete Profile Image' : 'Delete Logo Image'"></h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to delete this image? This action cannot be undone.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="confirmAction = null" class="button button-grey">Cancel</button>
                    <button type="button"
                            @click="confirmAction === 'profile' ? $wire.doDeleteProfileImage() : $wire.doDeleteLogoImage(); confirmAction = null"
                            class="button button-red">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
