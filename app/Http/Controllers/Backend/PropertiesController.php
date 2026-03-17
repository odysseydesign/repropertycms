<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function index()
    {
        $agents = Agents::all();

        return view('admin.properties', compact('agents'));
    }

    public function ExpiryDue(Request $request, $id)
    {

        $properties = Properties::find($id);
        $properties->expiry_date = $request['new_expiry_date'];

        if ($properties->save()) {
            return redirect('/admin/properties')->with('success', 'Extend Property Publish Date successfully.');
        } else {
            return redirect()->back()->with('error', 'Error Saving Data ! ');
        }
    }

    public function Property_Status(Request $request)
    {
        $data = [];
        $properties = Properties::find($request['id']);

        if ($properties->published == 1) {
            $properties->published = 0;
        } else {
            $properties->published = 1;
        }

        $data['status'] = $properties->published;

        if ($properties->save()) {
            $data['messege'] = '1';
        } else {
            $data['messege'] = '0';
        }

        return response()->json($data);
    }
}
