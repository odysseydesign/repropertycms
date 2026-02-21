<div class="">
    <div class="w-full">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Subscribers</h5>
        </div>
        <table class="table w-full table-striped table-auto">
            <thead>
            <tr>
                <th>Agent Name</th>
                <th>Plan Name</th>
                <th>Properties / Used</th>
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
                        <td>{{ $subscription->plan->name }}</td>
                        <td>{{ $subscription->plan->credits }}
                            / {{ $subscription->agent->TotalPublishedPropertiesCount }}</td>
                        <td>
                            @if ($subscription->stripe_status === 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif ($subscription->stripe_status === 'trialing')
                                <span class="badge badge-info">Trialing</span>
                            @elseif ($subscription->stripe_status === 'canceled')
                                <span class="badge badge-danger">Canceled</span>
                            @else
                                {{ $subscription->stripe_status }}
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($subscription->current_period_end)->format('d M Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y')}}</td>
                    </tr>
                @endforeach
                {{ $subscriptions->links() }}
            @else
                <tr>
                    <td colspan="4">No Subscription Found.</td>
                </tr>
            @endif
        </table>
    </div>
</div>