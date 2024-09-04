<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // Login & Sign up
    public function showLoginPage()
    {
        return view('users.login');
    }

    public function showSignupPage()
    {
        return view('users.signup');
    }


    // User Page
    public function showHomePage()
    {
        $posts = Posts::with('user')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('users.home', compact('posts'));
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

    // Settings
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
