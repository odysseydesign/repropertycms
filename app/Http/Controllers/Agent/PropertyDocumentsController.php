<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\PropertyDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PropertyDocumentsController extends Controller
{
    public function property_documents()
    {
        $property = session('property');
        if (! $property || ! $property->id) {
            return redirect('agent/property/listing')->with('error', 'You cannot access Documents directly!');
        }

        $property = Properties::findOrFail($property->id);

        return view('agent/property-document/property-documents', compact('property'));
    }

    public function saveDocs(Request $request)
    {
        $property = session('property');
        if (! is_null($property)) {
            $data = [];
            $property_id = $property['id'];
            if ($request->file('file')) {

                // Upload image on S3
                $path = uploadS3Image('property_documents', $request->file);
                $originalFileName = $request->file->getClientOriginalName();

                $property_documents = new PropertyDocuments;
                $property_documents->property_id = $property_id;
                $pathArr = explode('property_documents/', $path);
                $property_documents->name = $originalFileName;
                $property_documents->file_name = $path;
                if ($property_documents->save()) {
                    // Response
                    $data['success'] = 1;
                    $data['id'] = $property_documents->id;
                    $data['property_id'] = $property_documents->property_id;
                    $data['filename'] = $property_documents->file_name;
                    $data['message'] = 'Uploaded Successfully!';
                } else {
                    // Response
                    $data['success'] = 0;
                    $data['message'] = 'File not uploaded.';
                }

                return response()->json($data);

                /* $file = $request->file('file');
                $filename =time() . '_' .  $file->getClientOriginalName();

                // File upload location
                $path = public_path() . '/files/property_documents/' . $property_id;

                // Upload file
                if (!File::exists($path)) {
                    File::makeDirectory($path,0777, true, true);
                }
                if ($file->move($path, $filename)) {
                    $property_documents = new PropertyDocuments;
                    $property_documents->property_id = $property_id;
                    $property_documents->name = $filename;
                    $property_documents->file_name = $filename;
                    if($property_documents->save()){
                        // Response
                        $property_document = PropertyDocuments::where('file_name', '=', $filename)->first();
                        $data['success'] = 1;
                        $data['id'] = $property_document->id;
                        $data['property_id'] = $property_document->property_id;
                        $data['filename'] = $property_document->file_name;
                        $data['message'] = 'Uploaded Successfully!';
                    }else{
                        // Response
                        $data['success'] = 0;
                        $data['message'] = 'File not uploaded.';
                    }
                    return response()->json($data);
                }else{
                    $request->session()->flash('error', "Error on file uploading.");
                } */
            }
        } else {
            return back()->with('error', 'Error on Updating Document !');
        }
    }

    // delete property  image
    public function deleteDoc($id)
    {
        if (! is_null($id)) {
            $data = [];
            $property_documents = PropertyDocuments::find($id);
            $property_id = $property_documents['property_id'];

            deleteS3Image($property_documents->file_name);

            $property_documents->delete();
            $data['success'] = 1;
            $data['message'] = 'Document is Deleted !';

            return response()->json($data);
        } else {
            return back()->with('error', 'Error on Deleting Document !');
        }
    }

    public function editDocName(Request $request)
    {
        if (isset($request['id'])) {
            $property_document = PropertyDocuments::where('id', '=', $request['id'])->first();
            $property_document->name = $request['name'];
            if ($property_document->save()) {
                // Response
                $data['success'] = 1;
                $data['message'] = 'File Name Updated Successfully!';
            } else {
                // Response
                $data['success'] = 0;
                $data['message'] = 'File Name not Updated.';
            }

            return response()->json($data);
        }
    }
}
