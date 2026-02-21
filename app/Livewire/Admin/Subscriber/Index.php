<?php

namespace App\Livewire\Admin\Subscriber;

use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $subscriptions = Subscription::paginate(10);

        return view('livewire.admin.subscriber.index', compact('subscriptions'));
    }
}
