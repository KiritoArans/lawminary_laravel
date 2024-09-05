<?php

namespace App\Http\Controllers;

// use App\Models\Account;

use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function showAdModLogin()
    {
        return view('admin.admod_login');
    }

    public function showAccount()
    {
        $accounts = UserAccount::all();
        return view('admin.account', ['accounts' => $accounts]);
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