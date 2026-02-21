<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Properties;
use App\Models\States;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        session()->forget('property');
    }

    public function index(Request $request)
    {
        $request->session()->forget('property');
        $agent = auth()->user();
        $request->session()->put('agent', $agent);

        return view('agent.agents.dashboard');
    }

    public function welcome()
    {
        $agent = auth()->user();

        return view('agent.welcome');
    }

    public function notifications()
    {

        return view('agent.notifications');
    }

    // old code
    /*
    public function index_old(Request $request)
    {
        //Remove old property data from Session if any
        $request->session()->forget('property');

        $agent = session('agent');
        $id = $request->session()->get('login_agent_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        if (is_null($id)) {
            $id = $agent->id;
        }

        $agent = Agents::find($id);
        $request->session()->put('agent', $agent);
        $property_descending_order = Properties::where('agent_id', $agent->id)->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $published_properties = Properties::where('agent_id', $agent->id)->where('published', 1)->count();

        if ($property_descending_order->count() > 0) {
            foreach ($property_descending_order as $propertie) {
                $state_name = States::where('state_id', $propertie->state_id)->first();
            }
        } else {
            $state_name = '';
        }
        $property_update = Properties::where('agent_id', $agent->id)->orderBy('updated_at', 'desc')->limit(5)->get();
        $subscription = Subscription::where('agent_id', $agent->id)->where('status', 'active')->count('quantity');

        $data = compact('agent', 'property_descending_order', 'property_update', 'state_name', 'subscription', 'published_properties');

        return view('agent.agents.dashboard')->with($data);
    }
    */
}
