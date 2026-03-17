<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
    public function admin()
    {
        return redirect('/admin/sign-in');
    }
}
