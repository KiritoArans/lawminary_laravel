<?php

namespace App\Http\Controllers;
use App\Models\general_database;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAccount()
    {
        return view('admin.account');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function showForums()
    {
        return view('admin.forums');
    }

    public function showPostPage()
    {
        return view('admin.postpage');
    }

    public function showSystemContent()
    {
        return view('admin.systemcontent');
    }
}

