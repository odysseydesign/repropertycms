<section class="py-5 bg-white">
    <div class="container">
        <div class="row m-0 p-0">
            <h2 class="px-0 mb-5 text-center property-page-title site-color">Documents</h2>
            <!-- <p class="fs-1 text-uppercase text-center py-5 property-document">DOCUMENTS</p> -->
        </div>
        <div class="row mx-0 justify-content-center">
            @foreach($property_documents as $property_document)
                <a href="{{asset_s3($property_document->file_name)}}"
                   target="_blank"
                   class="text-decoration-none text-dark d-block col-md-4">
                    <div class="propertydocument_section">
                        @php $file_name = explode(".",$property_document->file_name);   @endphp
                        @if(!empty($file_name[1]))
                            @if($file_name[1] == "docx" || $file_name[1] == "doc")
                                <i class="fa-solid fa-file-word fa-2x mr-2"></i>
                            @elseif($file_name[1] == "jpeg" || $file_name[1] == "jpg" || $file_name[1] == "png" || $file_name[1] == "svg")
                                <i class="fa-solid fa-image fa-2x mr-2"></i>
                            @elseif($file_name[1] == "pdf")
                                <i class="fa-solid fa-file-pdf fa-2x mr-2"></i>
                            @elseif($file_name[1] == "xls" || $file_name[1] == "xlsx")
                                <i class="fa-solid fa-file-excel fa-2x mr-2"></i>
                            @else
                                <i class="fa-regular fa-file-lines fa-2x mr-2"></i>
                            @endif
                        @else
                            <i class="fa-regular fa-file-lines fa-2x mr-2"></i>
                        @endif
                        <br>
                        <span>{{ $property_document->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>