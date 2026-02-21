<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\States;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Address Map Page Open

    public function addressMap()
    {
        $property = session('property');

        if (! $property || ! $property->id) {
            return $property
                ? view('agent.Property.address')
                : redirect('agent/property/listing')->with('error', 'You cannot access Address directly!');
        }

        $property = Properties::findOrFail($property->id);

        return view('agent/address/address_map', compact('property'));
    }

    // Update the address

    public function updateAddressMap(Request $request)
    {
        $property = session('property');
        if (! is_null($property)) {
            $data = [];
            $state = States::where('name', '=', $request['state'])->first();
            $status = Properties::where('id', '=', $property['id'])
                ->update([
                    'name' => $request['address_line_1'],
                    'address_line_1' => $request['address_line_1'],
                    'address_line_2' => $request['address_line_2'],
                    'city' => $request['city'],
                    'state_id' => (isset($state) ? $state->state_id : ''),
                    'zip' => $request['zip'],
                    'country_id' => '230',
                    'latitude' => $request['latitude'],
                    'longitude' => $request['longitude'],
                ]);

            if ($status) {
                $data['success'] = 1;
                $data['message'] = 'Address is updated !';
            } else {
                $data['success'] = 0;
                $data['error'] = 'Address is Not updated !';
            }

            return response()->json($data);
        } else {
            return redirect('agent/property/listing')->with('error', 'Error on Updating Property Address !');
        }
    }
}
