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

    public function showMaccounts()
    {
        $accounts = UserAccount::all();
        return view('moderator.Maccounts', ['accounts' => $accounts]);
    }

    public function showMdashboard()
    {
        return view('moderator.mdashboard');
    }

    public function showMposts()
    {
        return view('moderator.mposts');
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