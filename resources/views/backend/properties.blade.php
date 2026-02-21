@extends('backend.layouts.default')
@section('content')
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">All Properties Listing</h5>
    </div>
    <div class="table-responsive">
        <table class="table w-full table-striped table-auto">
            <thead>
            <tr>
                <th>Agent Name</th>
                <th>Property Address</th>
                <th>Published Date</th>
                <th>Expiry Date</th>
                <th>Views</th>
                <th class="text-center">Status</th>
                <th>Property Preview</th>
            </tr>
            </thead>
            @foreach($agents as $agent)
                @foreach($agent->properties as $propertie)
                    <tr>
                        <td>{{$agent['first_name']}} {{$agent['last_name']}}</td>

                        <td>{{$propertie['name']}}</td>

                        <td>{{$propertie['publish_date']}}</td>

                        <td>
                            <form action="{{url('backend/expiry-due/'.$propertie['id'] )}}" method="get">
                                @csrf
                                <a dialog-trigger="true" data-ripple-light="true" class="cursor-pointer	">
                                    {{$propertie['expiry_date']}}
                                </a>
                                <div class="dialog">
                                    <div class="dialog-overlay" dialog-close="true"></div>
                                    <div class="modal-dialog dialog-box">
                                        <div class="dialog-content">
                                            <div class="dialog-header">
                                                <h6 class="mb-0">Extend Expiry Date</h6>
                                                <button type="button" class="me-0 button-close" dialog-close="true" aria-label="Close">
                                                    <i class="material-icons">X</i>
                                                </button>
                                            </div>
                                            <div class="dialog-body">
                                                <div class="input-group-outline input-group my-3">
                                                    <input type="date" name="new_expiry_date" value="{{$propertie['expiry_date']}}" id="new_expiry_date" class="form-control d-inline" style="border:2px solid lightgrey;"/>
                                                </div>
                                            </div>
                                            <div class="dialog-footer">
                                                <a class="button button-gradient button-dark mr-3 mb-0" dialog-close="true">Close</a>
                                                <button class="button button-gradient button-pink mb-0">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>

                        <td>{{$propertie['reviewed']}}</td>

                        <td class="text-center">
                            @if($propertie['published'] == 1)
                                <a href="#" class="save_publish button button-green button-sm" id="{{ $propertie['id'] }}">ENABLED</a>
                            @else
                                <a href="#" class="save_publish button button-green button-sm" id="{{ $propertie['id'] }}">DISABLED</a>
                            @endif
                        </td>

                        <td class="cursor-pointer">
                            <a href="{{url('/' . $propertie['unique_url'])}}" target="_blank" class="button button-green button-sm">
                                Property Preview
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>


@stop