<?php

namespace App\Livewire\Agent\Properties;

use App\Models\Backend\Admin;
use App\Models\Plan;
use App\Models\Properties;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

class Index extends Component
{
    use InteractsWithConfirmationModal;
    use WithPagination;
    use LivewireAlert;

    public $agent;

    public function publishProperty($id)
    {
        $property = Properties::find($id);
        $activeSubscription = $this->agent->hasActiveSubscription();

        if ($activeSubscription) {
            $plan = Plan::where('stripe_plan_id', $this->agent->activeSubscription->stripe_price)->first();
            if ($plan) {
                $publishedPropertiesCount = Properties::where('agent_id', $this->agent->id)->where('published', 1)->count();
                if ($plan->credits > $publishedPropertiesCount) {
                    $this->askForConfirmation(
                        callback: function () use ($property) {
                            $property->update([
                                'published' => true,
                                'publish_date' => Carbon::now(),
                            ]);

                            $this->alert('success', 'Property published successfully!', [
                                'toast' => true,
                            ]);

                            // send notification to agent
                            //                            $this->agent->notify(new AgentPropertyPublished($property));

                            // send notification to all admins
                            $admins = Admin::get();
                            //							Notification::send($admins, new AdminPropertyPublished($property));

                            $this->dispatch('refresh');
                        },
                        prompt: [
                            'title' => __('Publish Property'),
                            'message' => __('Do you really want to Publish this property?'),
                            'confirm' => __('Publish'),
                            'cancel' => __('Stop'),
                        ],
                        modalAttributes: [
                            'size' => '2xl',
                        ]
                    );
                } else {
                    $this->alert('error', 'You already have used full credit. To Publish more property, please Upgrade your plan.', [
                        'toast' => true,
                    ]);
                    //                return $this->dispatch('modal.open', component: 'agent.upgrade');
                }

                return;

            } else {
                $this->alert('error', 'No Plan Found!', [
                    'toast' => true,
                ]);
            }
        }

        return $this->dispatch('modal.open', component: 'agent.plans');
    }

    public function deleteProperty($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
                $property = Properties::find($id);
                $property->delete();
                $this->alert('success', 'Property deleted successfully!', [
                    'toast' => true,
                ]);
                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Property'),
                'message' => __('Do you really want to delete this property?'),
                'confirm' => __('Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        $properties = $this->agent->properties()
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.agent.properties.index', compact('properties'));
    }
}
