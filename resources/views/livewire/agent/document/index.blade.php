<div class="document_wrap" x-data="{ confirmId: null }">
    <div class='Content'>
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Upload Documents here</h5>
        </div>
        <!-- Dropzone -->
        <form action="{{route('agent.property_document.save_docs')}}" method="POST" class='dropzone documents_drop'>
            @method('GET')
            <input type="hidden" name="property_id" id="property_id" value="{{ $property['id'] }}">
            <div class="float-right pt-14 mt-1 mr-16 progress-bar">
                <progress id="progressbar" value="0" max="100" class="progressbar hidden"></progress>
                <p class="inline-block pt-10 pl-10 size">0 b</p>
                <p class="inline-block pl-5 percentage">0</p>%
            </div>
        </form>
    </div>
    <div class="d-flex align-items-center justify-content-end flex-wrap mt-5 responsive-btns rs-button-full">
        <a href="{{route('agent.video.3d-tour')}}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-2"><i
                    class="fa fa-arrow-left mr-2"></i> Prev</a>
        <button id="addDocs" class="button button-blue font-bold text-base mb-0 mr-2" data-ripple-light="true">Add
            Documents
        </button>
        <a href="{{route('agent.floorplan.index')}}"
           class="button button-blue font-bold text-base mb-0">Next <i class="fa fa-arrow-right ml-2"></i></a>

    </div>
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Uploaded Property Documents</h5>
    </div>
    <div class="Document-form mt-5">
        @foreach($property_documents as $property_doc)
            <div class="w-full py-8 px-5  inline-block relative gallery-image"
                 wire:key="doc-{{ $property_doc->id }}">
                <div class="float-left">
                    <span><i class="fa-regular fa fa-file fa-2x mr-5"
                             style="float: left;color:#28adc4;"></i></span>
                    <span id="fileName{{ $property_doc->id }}" contenteditable="true"
                          onblur="changeDocumentName({{ $property_doc->id }})" title="Edit Your file name"
                          style="width:80%;">{{ $property_doc->name }}</span>
                    <span>
                        <i class="fa fa-pencil" onclick="DocumentEditName({{ $property_doc->id }})"
                           style="color:#28adc4;margin-left:5px;"></i>
                    </span>
                </div>
                <div class="float-right">
                    <a href="{{ asset_s3($property_doc->file_name)}}" class="button button-green font-bold text-base mb-0 mr-2"
                       data-ripple-light="true"
                       download=""><i class="fa fa-download mr-2"></i>Download</a>
                    <button title="Delete Document"
                            class="button button-red font-bold text-base mb-0 mr-2"
                            type="button"
                            @click="confirmId = {{ $property_doc->id }}"><i class="fa fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Delete Confirmation Overlay --}}
    <div x-show="confirmId !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="confirmId = null"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Delete Document</h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to delete this document? This action cannot be undone.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="confirmId = null" class="button button-grey">Cancel</button>
                    <button type="button" @click="$wire.doDeleteDocument(confirmId); confirmId = null" class="button button-red">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
