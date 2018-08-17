<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admin_controller extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';

        return view('admin.admin_index', compact('title'));
    }
}
