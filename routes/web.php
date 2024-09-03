<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\UserController;
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
Route::get('/login', [UserController::class, 'showLoginPage']);

Route::get('/signup', [UserController::class, 'showSignupPage'])->name('signup');

Route::get('/home', [UserController::class, 'showHomePage'])->name('home')->middleware('auth');

Route::get('/article', [UserController::class, 'showArticlePage']);

Route::get('/forums', [UserController::class, 'showForumsPage']);

Route::get('/notifications', [UserController::class, 'showNotificationPage']);

Route::get('/search', [UserController::class, 'showSearchPage']);

Route::get('/resources', [UserController::class, 'showResourcesPage']);

Route::get('/profile', [UserController::class, 'showProfilePage']);

//settings routing
Route::get('/settings/lawminary', [UserController::class, 'showAboutLawminaryPage']);
Route::get('/settings/pao', [UserController::class, 'showAboutPAOPage']);
Route::get('/settings/account', [UserController::class, 'showAccountPage']);
Route::get('/settings/activitylogs', [UserController::class, 'showActLogsPage']);
Route::get('/settings/feedback', [UserController::class, 'showFeedbackPage']);
Route::get('/settings/tos', [UserController::class, 'showTOSPage']);


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

// User Backend Routing
// Logins
Route::post('/signup', [UserController::class, 'createAccount'])->name('users.createAccount');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name('loginAdMod');

// Create Post
Route::post('/home', [UserController::class, 'createPost'])->name('users.createPost');

// Profile Routes
Route::get('/profile', [UserController::class, 'showProfilePosts'])->name('profile.showProfilePosts');

Route::post('/profile/settings/account/changepass', [UserController::class, 'changePassword'])->name('settings.changePassword');
Route::post('/profile/settings/account/changeinfo', [UserController::class, 'updateAccountNames'])->name('settings.updateAccountNames');
Route::post('/profile/settings/account/changeinfo2', [UserController::class, 'updateAccountInfo'])->name('settings.updateAccountInfo');




// Moderator Routing

//Moderator Resource Page
Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');