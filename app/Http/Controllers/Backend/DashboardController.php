<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Backend\Admin;
use App\Models\credit_logs;
use App\Models\Properties;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->session()->get('login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $admin = Admin::where('id', '=', $id)->first();
        $request->session()->put('admin', $admin);

        $agent_descending_order = Agents::orderBy('id', 'desc')
            ->limit(7)
            ->get();
        $proeprty_descending_order = Properties::orderBy('updated_at', 'desc')
            ->with('agents')
            ->limit(7)
            ->get();
        $credit_logs_descending_order = credit_logs::orderBy('id', 'desc')
            ->with('agents')
            ->limit(7)
            ->get();

        $subscriptions = Subscription::where('stripe_status', 'active')
            ->limit(7)
            ->get();

        $data = compact('proeprty_descending_order', 'agent_descending_order', 'credit_logs_descending_order', 'subscriptions');

        return view('backend.dashboard')->with($data);
    }
}
