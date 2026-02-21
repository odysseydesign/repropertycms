@extends('layouts.agents.default1')

@section('title', '3D Tours')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">3D Tours</h5>
    </div>
    <div class="w-full my-2">
        <div class="w-full bg-grey-100 border-1 p-5 form-bg">
            <div class="input-group input-group-outline ">
                <span class="mb-1">Add Urls :</span>
                <input type="text" id="matterport_url" name="matterport_url" maxlength="500" class="form-control"
                       placeholder="" style="border: 2px solid lightgrey;"/>
            </div>
            <div class="mt-5 d-flex align-items-center justify-content-start flex-wrap responsive-btns rs-button-full">
                <a href="{{ url('agent/property-topbar/image')}}"
                   class="button button-blue button-outlined font-bold text-base   mb-0 mr-2"><i
                            class="fa fa-arrow-left mr-2"></i> Prev</a>
                <a href="#" class="button button-blue font-bold text-base   mb-0 mr-2 " onclick="save3D_Url();">add URl
                    for model</a>
                <a href="{{route('agent.property_document.index')}}"
                   class="button button-blue font-bold text-base   mb-0 ">Next <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        <div class="w-full bg-grey-100 border-1 p-5 form-bg">
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">3D Matterport Videos</h5>
            </div>
            <div class="row table_3durl">
                @foreach($property_matterports as $property_matterport)
                    <div class="col-md-4" id="{{$property_matterport->id}}">
                        <div class="card">
                            <div>
                                <iframe width="300" height="200" src="{{$property_matterport->matterport_url}}"
                                        frameborder="0" allowfullscreen allow="xr-spatial-tracking"></iframe>
                            </div>
                            <div class="card-body">
                                <h6>{{$property_matterport->matterport_url}}</h6>
                                <div><a href="#" onclick="delete3D_Url('{{$property_matterport->id}}');"
                                        class="button button-red mb-0 delete"><i class="fa fa-trash mr-2"></i>
                                        Delete</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{--            <!-- <div class="table-responsive">--}}
            {{--                <table class="table table-striped table_3durl">--}}
            {{--                    @foreach($property_matterports as $property_matterport)--}}
            {{--                <tr id="{{$property_matterport->id}}">--}}
            {{--                            <td><iframe width="300" height="200"  src="{{$property_matterport->matterport_url}}" frameborder="0" allowfullscreen allow="xr-spatial-tracking"></iframe></td>--}}
            {{--                            <td>{{$property_matterport->matterport_url}}</td>--}}
            {{--                            <td> <a href="#" onclick="delete3D_Url('{{$property_matterport->id}}');" class="button button-red ml-5 delete">Delete</a></td>--}}
            {{--                        </tr>--}}
            {{--                    @endforeach--}}
            {{--            </table>--}}
            {{--        </div> -->--}}
        </div>
    </div>
@stop