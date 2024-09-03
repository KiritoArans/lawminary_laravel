<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\data_general_controller\general_controller;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::get('/admod/login', [AdminController::class, 'showAdModLogin']);

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

Route::get('/admin/postpage', [AdminController::class, 'showPostPage']);

Route::get('/admin/account', [AdminController::class, 'showAccount']);

Route::get('/admin/forums', [AdminController::class, 'showForums']);

Route::get('/admin/systemcontent', [AdminController::class, 'showSystemContent']);

// Moderator routes
Route::get('/moderator/dashboard', [ModeratorController::class, 'showMdashboard'])->name('moderator.dashboard');

Route::get('/moderator/posts', [ModeratorController::class, 'showMposts']);

Route::get('/moderator/leaderboards', [ModeratorController::class, 'showMleaderboards']);

Route::get('/moderator/resources', [ModeratorController::class, 'showMresources'])->name('moderator.resources');

Route::get('/moderator/accounts', [ModeratorController::class, 'showMaccounts'])->name('moderator.accounts');

Route::get('/moderator/forums', [ModeratorController::class, 'showMforums']);

Route::get('/moderator/faqs', [ModeratorController::class, 'showMfaqs']);

//user routes
Route::get('/login', [PageController::class, 'showLoginPage']);
Route::get('/signup', [PageController::class, 'showSignupPage'])->name('signup');
Route::get('/home', [PageController::class, 'showHomePage'])->name('home')->middleware('auth');
Route::get('/article', [PageController::class, 'showArticlePage']);
Route::get('/forums', [PageController::class, 'showForumsPage']);
Route::get('/notifications', [PageController::class, 'showNotificationPage']);
Route::get('/search', [PageController::class, 'showSearchPage']);
Route::get('/resources', [PageController::class, 'showResourcesPage']);
Route::get('/profile', [PageController::class, 'showProfilePage']);

//settings routing
Route::get('/settings/lawminary', [PageController::class, 'showAboutLawminaryPage']);
Route::get('/settings/pao', [PageController::class, 'showAboutPAOPage']);
Route::get('/settings/account', [PageController::class, 'showAccountPage']);
Route::get('/settings/activitylogs', [PageController::class, 'showActLogsPage']);
Route::get('/settings/feedback', [PageController::class, 'showFeedbackPage']);
Route::get('/settings/tos', [PageController::class, 'showTOSPage']);


// Admin Backend Routing

// Admin Accounts Page
Route::post('/admin/accounts', [AdminController::class, 'addAccount'])->name('admin.addAccount');
Route::delete('/admin/account/{id}', [AdminController::class, 'destroy'])->name('account.destroy');
Route::match(['put', 'patch'], '/admin/account/{id}', [AdminController::class, 'updateAccount'])->name('admin.updateAccount');
Route::get('admin/account', [AdminController::class, 'filter'])->name('admin.filter');

// Moderator Accounts Page
Route::post('/moderator/accounts', [ModeratorController::class, 'addAccount'])->name('moderator.addAccount');
Route::delete('/moderator/accounts/{id}', [ModeratorController::class, 'destroy'])->name('maccounts.destroy');
Route::match(['put', 'patch'], '/moderator/accounts/{id}', [ModeratorController::class, 'updateAccount'])->name('moderator.updateAccount');
Route::get('moderator/accounts', [ModeratorController::class, 'filter'])->name('moderator.filter');
// Moderator Resource Page
Route::post('/moderator/mresources/upload', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');
// User Backend Routing
// Logins
Route::post('/signup', [AccountController::class, 'createAccount'])->name('users.createAccount');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name('loginAdMod');

// Create Post
Route::post('/home', [PostController::class, 'createPost'])->name('users.createPost');

// Profile Routes
Route::get('/profile', [PostController::class, 'showProfilePosts'])->name('profile.showProfilePosts');

Route::post('/profile/settings/account/changepass', [AccountController::class, 'changePassword'])->name('settings.changePassword');
Route::post('/profile/settings/account/changeinfo', [AccountController::class, 'updateAccountNames'])->name('settings.updateAccountNames');
Route::post('/profile/settings/account/changeinfo2', [AccountController::class, 'updateAccountInfo'])->name('settings.updateAccountInfo');





// Moderator Routing

//Moderator Resource Page
Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');