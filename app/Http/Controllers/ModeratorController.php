<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function showMaccounts()
    {
        return view('moderator.maccounts');
    }

    public function showMdashboard()
    {
        return view('moderator.mdashboard');
    }

    public function showMfaqs()
    {
        return view('moderator.mfaqs');
    }

    public function showMforums()
    {
        return view('moderator.mforums');
    }

    public function showMleaderboards()
    {
        return view('moderator.mleaderboards');
    }

    public function showMposts()
    {
        return view('moderator.mposts');
    }

    public function showMresources()
    {
        return view('moderator.mresources');
    }
}