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

Route::get('/home', [UserController::class, 'showHomePage'])->name('home');

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
Route::post('/admin/account', [AdminController::class, 'addAccount'])->name('admin.addAccount');
Route::delete('/admin/account/{id}', [AdminController::class, 'destroy'])->name('account.destroy');
Route::match(['put', 'patch'], '/admin/account/{id}', [AdminController::class, 'updateAccount'])->name('admin.updateAccount');
//filter accounts
Route::get('admin/account', [AdminController::class, 'filter'])->name('admin.filter');



// User Backend Routing
// Logins
Route::post('/signup', [UserController::class, 'createAccount'])->name('users.createAccount');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name('loginAdMod');

// route::get('/profile', [UserController::class, 'showProfilePage'])->middleware('auth')->name('profile');
// Moderator Routing
// Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');


// Moderator Routing

//Moderator Resource Page
Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');