<div>
    <div x-data x-show="$wire.show" x-cloak
         style="position:fixed;inset:0;z-index:9999;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.closeModal()"></div>
            <div style="position:relative;background:white;border-radius:14px;width:100%;max-width:480px;margin:20px;box-shadow:0 20px 60px rgba(0,0,0,0.2);overflow:hidden;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h3 style="color:white;font-size:1.125rem;font-weight:600;margin:0;">Add Video</h3>
                    <button type="button" @click="$wire.closeModal()"
                            style="color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;padding:4px;line-height:1;">
                        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Body --}}
                <form wire:submit.prevent="save">
                    <div style="padding:24px;">
                        <div class="container mx-auto">
                            <div class="input-group input-group-outline ">
                                <label class="text-bold">Select provider:</label>
                            </div>
                            <div class="flex">
                                <div class="w-1/2">
                                    <div wire:click="$set('showUploadOption', 'Youtube')"
                                         class="flex items-center justify-center h-48 bg-gray-200 rounded-lg m-2 video-icons {{ ($showUploadOption === 'Youtube') ? 'selected' : '' }}">
                                        <img src="{{ asset('images/icon-youtube.png') }}" class="max-h-full max-w-full"/>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <div wire:click="$set('showUploadOption', 'Vimeo')"
                                         class="flex items-center justify-center h-48 bg-gray-200 rounded-lg m-2 video-icons {{ ($showUploadOption === 'Vimeo') ? 'selected' : '' }}">
                                        <img src="{{ asset('images/icon-vimeo.png') }}" class="max-h-full max-w-full"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($showUploadOption === 'Youtube')
                            <div class="w-full">
                                <div class="input-group input-group-outline ">
                                    <label>Add Youtube Url:</label>
                                    <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                                           class="form-control" style="border:2px solid lightgrey;" required/>
                                    @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="vid-help youtube-help">
                                    <img src="{{ asset('images/youtube-help.png') }}" class="img-fluid">
                                </div>
                            </div>
                        @endif
                        @if ($showUploadOption === 'Vimeo')
                            <div class="w-full">
                                <div class="input-group input-group-outline ">
                                    <label>Add Vimeo Url:</label>
                                    <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                                           class="form-control" style="border:2px solid lightgrey;" required/>
                                    @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="vid-help vimeo-help">
                                    <img src="{{ asset('images/vimeo-help.png') }}" class="img-fluid">
                                </div>
                            </div>
                        @endif
                        @if ($showUploadOption === 'Wistia')
                            <div class="w-full">
                                <div class="input-group input-group-outline ">
                                    <label>Add Wistia Url:</label>
                                    <input type="text" id="video_url" placeholder="" wire:model="video_url" maxlength="255"
                                           class="form-control" style="border:2px solid lightgrey;" required/>
                                    @error('video_url') <p class="text-red-500 italic mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="vid-help wistia-help">
                                    <img src="{{ asset('images/wistia-help.png') }}" class="img-fluid">
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Footer --}}
                    <div style="padding:0 24px 24px;display:flex;gap:8px;">
                        <button type="submit" class="button button-green font-bold w-40 mx-1">Add Video</button>
                        <button type="button" class="button button-grey font-bold w-40 mx-1" @click="$wire.closeModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
