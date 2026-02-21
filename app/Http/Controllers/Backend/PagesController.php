<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {

        return view('backend.pages.index');
    }

    public function create()
    {

        return view('backend.pages.create');
    }

    public function update($id = null)
    {
        if (! is_null($id)) {
            $page = Pages::find($id);

            return view('backend.pages.add', ['page' => $page]);
        } else {
            return view('backend.pages.add');
        }
    }

    public function add(Request $request, $id = null)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
            ]
        );

        $data = $request->all();

        if ($data['title'] != '') {

            $slug = Str::of($data['title'])->slug('-');

            if (is_null($id)) {
                $page = new Pages;
            } else {
                $page = Pages::find($id);
            }
            $page->title = $data['title'];
            $page->slug = $slug;
            $page->content = $data['content'];

            if ($page->save()) {
                return redirect()->route('backend.pages')->with('success', 'Page saved successfully.');
            } else {
                return redirect()->route('backend.add')->with('error', 'Failed to save Page.');
            }
        } else {
            return redirect('backend.add')->with('error', "Title can't be empty.");
        }
    }

    public function delete(Request $request)
    {
        $data = [];
        if (! is_null($request['Id'])) {
            $page = Pages::find($request['Id']);
            if ($page) {
                if ($page->delete()) {
                    $data['success'] = '1';
                    $data['message'] = 'Page deleted successfully';
                } else {
                    $data['success'] = '0';
                    $data['message'] = 'Page is not deleted';
                }
            } else {
                return redirect()->route('backend.pages')->with('error', "Page doesn't exist.");
            }
        } else {
            return redirect()->route('backend.pages')->with('error', 'Invalid id.');
        }

        return response()->json($data);
    }

    public function status(Request $request)
    {
        $data = [];
        if (! is_null($request['id'])) {
            $page = Pages::find($request['id']);
            if ($page) {
                if ($page->action == 1) {
                    $page->action = 0;
                } else {
                    $page->action = 1;
                }
                $data['status'] = $page->action;
                if ($page->save()) {
                    $data['success'] = '1';
                } else {
                    $data['success'] = '0';
                }
            } else {
                return redirect()->route('backend.pages')->with('error', "Page doesn't exist.");
            }
        } else {
            return redirect()->route('backend.pages')->with('error', 'Invalid id.');
        }

        return response()->json($data);
    }
}
