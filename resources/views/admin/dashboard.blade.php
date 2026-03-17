@extends('admin.layouts.default')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="">
        <div class="w-full">
            <!-- display recently 7 added agents -->
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">Recently Added Agents</h5>
            </div>
            <table class="table w-full table-striped table-auto">
                <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Agent Email</th>
                    <th>SignUp Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Reset Password</th>
                </tr>
                </thead>
                @if (count($agent_descending_order) > 0)
                    @foreach($agent_descending_order as $row)
                        <tr id="agent_data{{ $row->id }}">
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->created_at->format('d M Y')}}</td>
                            <td class="text-center">
                                @if($row->active == 1)
                                    <a href="#" class="save_status button button-green button-sm" id="{{ $row->id }}">ENABLE</a>
                                @else
                                    <a href="#" class="save_status button button-green button-sm" id="{{ $row->id }}">DISABLE</a>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{url('admin/reset-password/'.$row->id )}}" method="get">
                                    @csrf
                                    <a class="button button-green button-sm reset_password" dialog-trigger="true"
                                       data-ripple-light="true" id="{{ $row->id }}">
                                        Reset Password
                                    </a>
                                    <div class="dialog">
                                        <div class="dialog-overlay" dialog-close="true"></div>
                                        <div class="modal-dialog dialog-box">
                                            <div class="dialog-content">
                                                <div class="dialog-header">
                                                    <h6 class="mb-0">Reset Agent Password</h6>
                                                    <button type="button" class="me-0 button-close" dialog-close="true"
                                                            aria-label="Close">
                                                        <i class="material-icons">X</i>
                                                    </button>
                                                </div>
                                                <div class="dialog-body">
                                                    <div class="input-group-outline input-group my-3">
                                                        <span>New Password : </span>
                                                        <input type="password" name="newpassword" id="newpassword"
                                                               maxlength="75" class="form-control"
                                                               style="border:2px solid lightgrey;"/>
                                                    </div>
                                                    <div class="input-group-outline input-group my-3">
                                                        <span>Confirm Password : </span>
                                                        <input type="password" name="confirm_password"
                                                               id="confirm_password" maxlength="75" class="form-control"
                                                               style="border:2px solid lightgrey;"/>
                                                    </div>
                                                </div>
                                                <div class="dialog-footer">
                                                    <a class="button button-green button-sm mr-3" dialog-close="true">Close</a>
                                                    <button class="button button-green button-sm">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No Properties Found.</td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="w-full">
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">Recently Purchased Subscription</h5>
            </div>
            <table class="table w-full table-striped table-auto">
                <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Status</th>
                    <th>Expire Date</th>
                    <th>Subscribed Date</th>
                </tr>
                </thead>
                @if (count($subscriptions) > 0)
                    @foreach($subscriptions as $subscription)
                        <tr class="my-2">
                            <td class="pt-3 pb-2">
                                {{@$subscription->agent->first_name}} {{@$subscription->agent->last_name}}
                            </td>
                            <td>{{$subscription->stripe_status}}</td>
                            <td>{{ \Carbon\Carbon::parse($subscription->current_period_end)->format('d M Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y')}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No Subscription Found.</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <!-- Recently Added 7 Properties -->
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Recently Added Properties </h5>
    </div>
    <table class="table w-full table-striped table-auto">
        <thead>
        <tr>
            <th>Agent Name</th>
            <th>Property Address</th>
            <th>Published Date</th>
            <th>Expiry Date</th>
            <th>Views</th>
            <th class="text-center">Status</th>
            <th class="text-center">Property Preview</th>
        </tr>
        </thead>
        @foreach($proeprty_descending_order as $property)
            <tr>
                <td>{{$property->agents->first_name}} {{$property->agents->last_name}}</td>
                <td>{{$property['name']}}</td>
                <td>{{$property['publish_date']}}</td>
                <td>
                    <form action="{{url('admin/expiry-due/'.$property['id'] )}}" method="get">
                        @csrf
                        <a dialog-trigger="true" data-ripple-light="true" class="cursor-pointer	">
                            {{$property['expiry_date']}}
                        </a>
                        <div class="dialog">
                            <div class="dialog-overlay" dialog-close="true"></div>
                            <div class="modal-dialog dialog-box">
                                <div class="dialog-content">
                                    <div class="dialog-header">
                                        <h6 class="mb-0">Extend Expiry Date</h6>
                                        <button type="button" class="me-0 button-close" dialog-close="true"
                                                aria-label="Close">
                                            <i class="material-icons">X</i>
                                        </button>
                                    </div>
                                    <div class="dialog-body">
                                        <div class="input-group-outline input-group my-3">
                                            <input type="date" name="new_expiry_date"
                                                   value="{{$property['expiry_date']}}" id="new_expiry_date"
                                                   class="form-control d-inline" style="border:2px solid lightgrey;"/>
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
                <td>{{$property['reviewed']}}</td>
                <td class="text-center">
                    @if($property['published'] == 1)
                        <a href="#" class="save_publish button button-green button-sm" id="{{ $property['id'] }}">ENABLED</a>
                    @else
                        <a href="#" class="save_publish button button-green button-sm" id="{{ $property['id'] }}">DISABLED</a>
                    @endif
                </td>

                <td class="cursor-pointer text-center">
                    <a href="{{url('/' . $property['unique_url'])}}" target="_blank"
                       class="button button-green button-sm">
                        Property Preview
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop