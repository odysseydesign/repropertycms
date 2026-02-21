<div class="w-full py-5">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Subscription Plans</h5>
        <button onclick="Livewire.dispatch('modal.open', {component: 'admin.plans.create' })"
                class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Add Plan
        </button>
    </div>
    <div class="credit-plans">
        <form action="{{url('backend/plans/add')}}" method="get">
            @csrf
            <div class="dialog">
                <div class="dialog-overlay" dialog-close="true"></div>
                <div class="modal-dialog dialog-box">
                    <div class="dialog-content">
                        <div class="dialog-header">
                            <h6 class="mb-0">Add New Plan</h6>
                            <button type="button" class="me-0 button-close" dialog-close="true" aria-label="Close">
                                <i class="material-icons">X</i>
                            </button>
                        </div>
                        <div class="dialog-body">
                            <div class="input-group-outline input-group my-3">
                                <span>Plan Name</span>
                                <input type="text" name="plan_name" id="plan_name" class="form-control" maxlength="50"
                                       style="border:2px solid lightgrey;"/>
                            </div>
                            <div class="input-group-outline input-group my-3">
                                <span>Price : </span>
                                <input type="number" name="price" id="price" class="form-control"
                                       style="border:2px solid lightgrey;"/>
                            </div>
                            <div class="input-group-outline input-group my-3">
                                <span>Credits : </span>
                                <input type="number" name="credits" id="credits" class="form-control"
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
    </div>
    <div class="table-responsive w-full">
        <table class="table w-full table-striped table-auto">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Credits</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            @foreach($plans as $plan)
                <tr>
                    <td>{{$plan->name}}</td>
                    <td>{{$plan->price}}</td>
                    <td>{{$plan->credits}}</td>
                    <td>
                        @if($plan->active == 1)
                            ENABLE
                        @else
                            DISABLE
                        @endif
                    </td>
                    <td>
                        {{--                        <a href="#" class="mx-2 float-left" wire:clicl="editPlan('{{ $plan->id }}')"><i--}}
                        {{--                                    class="fas fa-edit"></i> </a>--}}
                        <a href="#" class="mx-2 float-left" wire:click="deletePlan('{{ $plan->id }}')"><i
                                    class="fas fa-trash"></i> </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>