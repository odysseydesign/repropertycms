<div class="w-full py-5">
    <div class="pb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap page-heading">
            <h3 class="mb-0">Your Properties</h3>
            <a href="{{url('agent/property/address')}}" class="button font-bold text-base mb-0" style="background-color: rgb(0, 100, 131);">
                <i class="fa fa-plus mr-1 btn-blue"></i> New Property
            </a>
        </div>
    </div>
    <x-property_list :property="$properties"/>
    <div class="flex items-center justify-between border-t border-gray-200 py-3">
        {{ $properties->links() }}
    </div>
</div>