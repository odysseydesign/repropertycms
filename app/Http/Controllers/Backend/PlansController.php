<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {

        return view('backend.plans.index');
    }

    public function status(Request $request)
    {
        $data = [];
        $plans = Plan::find($request['id']);
        if ($plans->active == 1) {
            $plans->active = 0;
        } else {
            $plans->active = 1;
        }
        $data['status'] = $plans->active;
        if ($plans->save()) {
            $data['messege'] = '1';
        } else {
            $data['messege'] = '0';
        }

        return response()->json($data);
    }

    // Here Add code for adding New membership plan and edit Existing plans
    public function add(Request $request, $id = null)
    {

        if (is_null($id)) {
            $plan = new Plan;
        } else {
            $plan = Plan::where('id', '=', $id)->first();
        }

        $plan->name = $request['plan_name'];
        $plan->price = $request['price'];
        $plan->credits = $request['credits'];

        if ($plan->save()) {
            return redirect('/backend/plans/index')->with('success', 'Added New Membership Plan successfully.');
        } else {
            return redirect()->back()->with('error', 'Error Saving Data ! ');
        }
    }

    // Here Add code for deleting existing membership plan

    public function delete($id)
    {

        $data = [];
        $plan = Plan::where('id', '=', $id)->first();

        if ($plan->delete()) {
            $data['success'] = 1;
            $data['messege'] = 'Deleted Membership Plan successfully.';
        } else {
            $data['success'] = 0;
            $data['messege'] = 'Error Deleting Data !';
        }

        return response()->json($data);
    }
}
