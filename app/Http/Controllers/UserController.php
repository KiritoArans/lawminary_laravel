<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Login
    public function showLoginPage()
    {
        return view('users.login');
    }
    
    public function showSignupPage()
    {
        return view('users.signup');
    }

    //UI
    public function showHomePage()
    {
        return view('users.home');
    }

    public function showArticlePage()
    {
        return view('users.article');
    }

    public function showForumsPage()
    {
        return view('users.forums');
    }

    public function showNotificationPage()
    {
        return view('users.notification');
    }

    public function showSearchPage()
    {
        return view('users.search');
    }

    public function showResourcesPage()
    {
        return view('users.resources');
    }

    public function showProfilePage()
    {
        return view('users.profile');
    }

    //for settings
    public function showAboutLawminaryPage()
    {
        return view('settings.about_lawminary');
    }

    public function showAboutPAOPage()
    {
        return view('settings.about_pao');
    }

    public function showAccountPage()
    {
        return view('settings.account_settings');
    }

    public function showActLogsPage()
    {
        return view('settings.activity_logs');
    }

    public function showFeedbackPage()
    {
        return view('settings.provide_feedback');
    }

    public function showTOSPage()
    {
        return view('settings.tos');
    }
}
