<div class="w-full py-5">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Create Page</h5>
    </div>

    <div class="mt-4">
        <x-label for="title" value="{{ __('Title') }}"/>
        <x-input id="title" class="block mt-1 w-full" type="text" wire:model.defer="title"/>
        @error('title') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mt-4">
        <x-label for="content" value="{{ __('Content') }}"/>
        <div wire:ignore id="studio-editor" style="height: 100dvh"></div>
        @error('content') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mt-4">
        <x-label for="meta_title" value="{{ __('Meta Title') }}"/>
        <x-input id="meta_title" class="block mt-1 w-full" type="text" wire:model.defer="meta_title"/>
    </div>
    <div class="mt-4">
        <x-label for="meta_description" value="{{ __('Meta Description') }}"/>
        <textarea id="meta_description" wire:model.defer="meta_description"></textarea>
    </div>
    <div class="mt-4">
        <x-label for="meta_keywords" value="{{ __('Meta Keywords') }}"/>
        <x-input id="meta_keywords" class="block mt-1 w-full" type="text" wire:model.defer="meta_keywords"/>
    </div>

    <x-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-button>

    <script src="https://unpkg.com/@grapesjs/studio-sdk/dist/index.umd.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@grapesjs/studio-sdk/dist/style.css"/>
    <script>
        let projectData = null;
        const editor = GrapesJsStudioSDK.createStudioEditor({
            root: '#studio-editor',
            licenseKey: '{{ env('GRAPESJS_API') }}',
            project: {
                type: 'web',
                // TODO: replace with a unique id for your projects. e.g. an uuid
                id: 'UNIQUE_PROJECT_ID'
            },
            identity: {
                // TODO: replace with a unique id for your end users. e.g. an uuid
                id: '{{ auth('admin')->user()->id }}'
            },
            assets: {
                storageType: 'cloud'
            },
            storage: {
                type: 'self',
                autosave: false,
                onSave: ({project}) => {
                    projectData = project; // Update the stored project data
                },
            }
        });
        document.addEventListener('livewire:load', function () {
            console.log('loaded');
            console.log(projectData);
            Livewire.on('save-page', () => {
                if (projectData) {
                    const body = new FormData();
                    body.append('title', @this.title
                )
                    ;
                    body.append('content', JSON.stringify(projectData));
                    @this.
                    store(body); // Call the store method with the data.

                    projectData = null; // Reset to avoid double saving
                }
            });
        });
    </script>
    {{--    {!! json_encode($body) ?? '' !!}--}}
</div>