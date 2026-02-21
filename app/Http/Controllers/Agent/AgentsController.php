<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent_addresses;
use App\Models\Agents;
use App\Models\Countries;
use App\Models\Plan;
use App\Models\States;
use File;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Mail;
use Validator;

class AgentsController extends Controller
{
    public function __construct()
    {
        session()->forget('property');
    }

    public function agents()
    {
        return redirect('agent/sign-in');
    }

    public function index()
    {
        return view('agent/agents/SignUp');
    }

    public function SignUp(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:agents'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $agent = new Agents;
        $agent->first_name = $request->first_name;
        $agent->last_name = $request->last_name;
        $agent->email = $request->email;
        $agent->password = Hash::make($request->password);
        $agent->save();

        //        $request->session()->put('agent', $agent);

        event(new Registered($agent));

        // Auto login agent
        auth()->login($agent);

        return redirect()->route('agent.welcome')->with('success', 'SignUp Successfully!');
    }

    public function agents_address(Request $request)
    {
        $agent = session('agent');
        $countries = Countries::where('country_id', '=', '230')->first();
        $states = States::all();
        $data = compact('states', 'countries');

        return view('agent.agents/agent_addresses')->with($data);
    }

    public function agents_address_add(Request $request)
    {
        $agent = session('agent');
        $request->validate([
            'phone' => 'required|min:10|numeric',
            'state_id' => 'required',
            'city' => 'required',
            'zip' => 'required|numeric',
            'address' => 'required',
        ]);
        $agent_address = new Agent_addresses;
        $country = Countries::where('name', '=', $request['country_name'])->first();
        if (isset($request['business_name'])) {
            $agent_address->business_name = $request['business_name'];
        }
        $agent_address->agent_id = $agent['id'];
        $agent_address->phone = $request['phone'];
        $agent_address->address = $request['address'];
        $agent_address->city = $request['city'];
        $agent_address->state_id = $request['state_id'];
        $agent_address->country_id = $country->country_id;
        $agent_address->zip = $request['zip'];

        if ($agent_address->save()) {
            return redirect('/agent/dashboard')->with('success', 'Your address has been saved!');
        } else {
            return redirect('/agent/property/address')->with('error', 'Error Saving Data. Please try again.');
        }
    }

    // Agent profile
    public function profile()
    {
        return view('agent.agents.profile');
    }

    // Update Profile Details

    public function editProfileDetails(Request $request)
    {
        $agent = session('agent');
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors()->first());
        } else {
            $status = Agents::where('id', '=', $agent->id)
                ->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                ]);
            if ($status) {
                $agent = Agents::where('id', '=', $agent['id'])->first();
                $request->session()->put('agent', $agent);
                $request->session()->flash('success', 'Profile details is updated');
            } else {
                $request->session()->flash('error', 'Profile details is Not updated');
            }
        }

        return redirect('/agent/profile');
    }

    // Update Profile Address

    public function editProfileAddress(Request $request)
    {
        $agent = session('agent');
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:10|numeric',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required|numeric',
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors()->first());
        } else {
            $country = Countries::where('name', '=', $request['country'])->first();
            $status = Agent_addresses::where('agent_id', '=', $agent->id)
                ->update([
                    'business_name' => $request['business_name'],
                    'address' => $request['address'],
                    'city' => $request['city'],
                    'state_id' => $request['state_id'],
                    'zip' => $request['zip'],
                    'country_id' => $country->country_id,
                    'phone' => $request['phone'],
                ]);
            if ($status) {
                $request->session()->flash('success', 'Profile address is updated');
            } else {
                $request->session()->flash('error', 'Profile address is Not updated');
            }
        }

        return redirect('/agent/profile');
    }

    // Update Social Media

    public function AddSociaMediaProfile(Request $request)
    {

        $agents = session('agent');
        $status = Agents::where('id', '=', $agents->id)->update([
            'facebook_profile' => $request['facebook_profile'],
            'instagram_profile' => $request['instagram_profile'],
            'twitter_profile' => $request['twitter_profile'],
            'linkedin_profile' => $request['linkedin_profile'],
        ]);
        if ($status) {
            $request->session()->flash('success', 'Profile social media is updated');
        } else {
            $request->session()->flash('error', 'Profile social media is Not updated');
        }

        return redirect('/agent/profile');
    }

    // Update Profile Image

    public function editProfileImage(Request $request)
    {
        $agent = session('agent');
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors()->first('profile_image'));
        } else {
            // Upload image on S3
            $path = uploadS3Image('agents', $request->profile_image);
            $status = Agents::where('id', '=', $agent->id)->update(['profile_image' => $path]);
            if ($status) {
                $request->session()->flash('success', 'Profile Image Uploaded Successfully!');
            } else {
                $request->session()->flash('error', 'Error saving data.');
            }
            /* $profile_image = $request->file('profile_image');
            $profile_image_name = time() . '_' . $profile_image->getClientOriginalName();

            // profile image upload location
            $path = public_path() . '/files/agents/' . $agent->id;
            // Upload profile image
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            if ($profile_image->move($path, $profile_image_name)) {
                $status = Agents::where('id', '=', $agent->id)
                ->update(['profile_image' => $profile_image_name]);
                if ($status) {
                    $request->session()->flash('success', "Profile Image Uploaded Successfully!");
                } else {
                    $request->session()->flash('error', "Error saving data.");
                }
            } else {
                $request->session()->flash('error', "Profile image not uploaded.");
            } */
        }

        return redirect('/agent/profile');
    }

    // Delete delete Profile Image

    public function deleteProfileImage()
    {
        $agent = session('agent');
        $agents = Agents::find($agent->id);

        deleteS3Image('agents/'.$agents->profile_image);

        $status = Agents::where('id', '=', $agent->id)->update(['profile_image' => '']);
        if ($status) {
            $data['success'] = 1;
            $data['message'] = 'Profile Image is deleted !';
        } else {
            $data['success'] = 0;
            $data['error'] = 'Profile Image is Not deleted !';
        }

        return response()->json($data);
    }

    // Edit Logo Image

    public function editLogoImage(Request $request)
    {
        $agent = session('agent');
        $validator = Validator::make($request->all(), [
            'logo_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors()->first('logo_image'));
        } else {
            // Upload image on S3
            $path = uploadS3Image('agents', $request->logo_image);
            $status = Agents::where('id', '=', $agent->id)->update(['logo_image' => $path]);
            if ($status) {
                $request->session()->flash('success', 'Logo Image Uploaded Successfully!');
            } else {
                $request->session()->flash('error', 'Error saving data.');
            }
            /* $logo_image = $request->file('logo_image');
            $logo_image_name = time() . '_' . $logo_image->getClientOriginalName();

            // profile image upload location
            $path = public_path() . '/files/agents/' . $agent->id;
            // Upload profile image
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            if ($logo_image->move($path, $logo_image_name)) {
                $status = Agents::where('id', '=', $agent->id)
                ->update(['logo_image' => $logo_image_name]);
                if ($status) {
                    $request->session()->flash('success', "Logo Image Uploaded Successfully!");
                } else {
                    $request->session()->flash('error', "Error saving data.");
                }
            } else {
                $request->session()->flash('error', "Logo image not uploaded.");
            } */
        }

        return redirect('/agent/profile');
    }

    // Delete delete Profile Image

    public function deleteLogoImage()
    {
        $agent = session('agent');
        $agents = Agents::find($agent->id);

        deleteS3Image('agents/'.$agents->logo_image);

        // Delete image from S3
        $status = Agents::where('id', '=', $agent->id)->update(['logo_image' => '']);
        if ($status) {
            $data['success'] = 1;
            $data['message'] = 'Logo Image is deleted !';
        } else {
            $data['success'] = 0;
            $data['error'] = 'Logo Image is Not deleted !';
        }

        return response()->json($data);
    }

    // Change Password

    public function changePassword()
    {
        return view('agent.agents.change_password');
    }

    // Save Password
    public function savePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors());
        } else {
            $agent = session('agent');
            $agents = Agents::find($agent->id);
            if (Hash::check($request['oldpassword'], $agents->password)) {
                if ($request->get('newpassword') === $request->get('confirm_password')) {
                    // Current password and new password same
                    $agents->password = Hash::make($request->get('newpassword'));
                    if ($agents->save()) {
                        return redirect('/agent/profile')->with('success', 'Password successfully updated.');
                    } else {
                        return redirect()->back()->with('error', 'Error Saving Data ! ');
                    }
                } else {
                    return redirect()->back()->with('error', 'New Password and Confirm password are not same. Please try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Your current password is not correct. Please try again.');
            }
        }
    }

    public function credit_plans()
    {
        $plans = Plan::all();
        $data = compact('plans');

        return view('agent.agents.credit_plans')->with($data);
    }

    public function ForgetPasswordView()
    {
        return view('agent.agents.forget-password');
    }

    public function ForgetAgentPassword(Request $request)
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('email'); // Error response
        } else {
            $email = $request['email'];
            $agent = Agents::where('email', '=', $email)->first();
            if ($agent) {
                $data = rand(100000, 999999);
                $agent->verification_code = $data;
                $status = $agent->save();
                if ($status) {
                    $data = ['name' => 'Use this code to forgot the password', 'data' => $data];
                    $user['to'] = $email;
                    Mail::send('Agent.agents.mail', $data, function ($message) use ($user) {
                        $message->to($user['to']);
                        $message->subject('Forgot Password');
                    });
                    $data['success'] = 1;
                    $data['email'] = $email;
                    $data['message'] = 'We have sent you an email with a code. Please check your email and enter the code to forget password.';
                } else {
                    $data['success'] = 0;
                    $data['error'] = 'Error Saving data !';
                }
            } else {
                $data['success'] = 0;
                $data['error'] = 'Email is Not Found !';
            }
        }

        return response()->json($data);
    }

    public function forgotPasswordVerification(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'verification_code' => 'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors());
        } else {
            $verification_code = $request['verification_code'];
            $email = $request['reset_email'];
            $agent = Agents::where('email', '=', $email)->first();

            if ($verification_code === $agent->verification_code) {
                $request->session()->flash('success', 'Enter Your New Password !');

                return view('agent.agents.reset-password')->with(compact('email'));
            } else {
                return redirect()->back()->with('error', 'Invalid Verification Code !. Please try again.');
            }
        }

    }

    public function ResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', $validator->errors());
        } else {
            $email = $request['email'];
            $agent = Agents::where('email', '=', $email)->first();
            $agent->password = Hash::make($request->get('newpassword'));
            if ($agent->save()) {
                $request->session()->flash('success', 'Password is updated');
            } else {
                $request->session()->flash('error', 'Password  is Not updated');
            }
        }

        return redirect('agent/sign-in');
    }

    // agent Billing section
    public function billing()
    {
        return view('agent.agents.billing');
    }
}
