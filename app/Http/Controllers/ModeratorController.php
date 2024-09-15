<?php

namespace App\Http\Controllers;

// use App\Models\Account;

use App\Models\UserAccount;
use App\Models\ResourceFile;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class moderatorController extends Controller
{
    public function showAdModLogin()
    {
        return view('moderator.admod_login');
    }

    public function showaccount()
    {
        $accounts = UserAccount::all();
        return view('moderator.account', ['accounts' => $accounts]);
    }

    public function showdashboard()
    {
        return view('moderator.dashboard');
    }

    public function showpostpage()
    {
        return view('moderator.postpage');
    }

    public function showMleaderboards()
    {
        return view('moderator.mleaderboards');
    }

    public function showMforums()
    {
        return view('moderator.mforums');
    }

    public function showMfaqs()
    {
        return view('moderator.mfaqs');
    }
}
