<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agent_addresses;
use App\Models\Agents;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AgentListingController extends Controller
{
    public function index(Request $request)
    {
        $agents = Agents::all();

        return view('admin.agent-listing', compact('agents'));
    }

    public function status(Request $request)
    {
        $data = [];
        $agents = Agents::find($request['id']);
        if ($agents->active == 1) {
            $agents->active = 0;
        } else {
            $agents->active = 1;
        }
        $data['status'] = $agents->active;
        if ($agents->save()) {
            $data['messege'] = '1';
        } else {
            $data['messege'] = '0';
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data = [];
        $agents = Agents::find($request['Id']);
        $agent_address = Agent_addresses::where('agent_id', '=', $request['Id'])->first();
        if ($agent_address) {
            $agent_address->delete();
        }
        $property = Properties::where('agent_id', '=', $request['Id'])->get();
        $agents->delete();
        if (count($property) > 0) {
            $property->each->delete();
            $data['success'] = 1;
            $data['message'] = 'Agent and all of their Properties are Deleted!';
        } else {
            $data['success'] = 1;
            $data['message'] = 'Agent is Deleted!';
        }

        return response()->json($data);
    }

    public function resetPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'newpassword' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors());
        } else {
            $agents = Agents::find($id);
            if ($request->get('newpassword') === $request->get('confirm_password')) {
                $agents->password = Hash::make($request->get('newpassword'));

                if ($agents->save()) {
                    $agent = Agents::find($id);
                    $firstname = $agent['first_name'];
                    $lastname = $agent['last_name'];
                    $name = $firstname.' '.$lastname;
                    $email = $agent['email'];
                    $password = $request['newpassword'];
                    $data = ['name' => $name, 'email' => $email, 'password' => $password];
                    $user['to'] = $email;
                    Mail::send('mail.reset-password', $data, function ($message) use ($user) {
                        $message->to($user['to']);
                        $message->subject('Password Reset');
                    });

                    return redirect('/admin/agent-listing')->with('success', 'Password successfully updated.');
                } else {
                    return redirect()->back()->with('error', 'Error Saving Data ! ');
                }
            } else {
                return redirect()->back()->with('error', 'New Password and Confirm password are not same. Please try again.');
            }
        }
    }
}
