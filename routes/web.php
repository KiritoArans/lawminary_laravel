<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\data_general_controller\general_controller;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

//admin routes
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard']);

Route::get('/admin/postpage', [AdminController::class, 'showPostPage']);

Route::get('/admin/account', [AdminController::class, 'showAccount']);

Route::get('/admin/forums', [AdminController::class, 'showForums']);

Route::get('/admin/systemcontent', [AdminController::class, 'showSystemContent']);

//moderator routes
Route::get('/moderator/dashboard', [ModeratorController::class, 'showMdashboard']);

Route::get('/moderator/posts', [ModeratorController::class, 'showMposts']);

Route::get('/moderator/leaderboards', [ModeratorController::class, 'showMleaderboards']);

Route::get('/moderator/resources', [ModeratorController::class, 'showMresources'])->name('moderator.resources');

Route::get('/moderator/accounts', [ModeratorController::class, 'showMaccounts']);

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

//add-account routing (create)
// Route::post('/add-account', [AccountController::class, 'store'])->name('add-account');

Route::post('/admin/account', [AdminController::class, 'addAccount'])->name('admin.addAccount');
// addAccount

//fetch data from db to display to table
Route::get('/admin/account', [AccountController::class, 'index'])->name('admin.account');

// Backend Routing
Route::post('/signup', [UserController::class, 'createAccount'])->name('users.createAccount');

Route::post('/login', [AuthController::class, 'login'])->name('login');

// route::get('/profile', [UserController::class, 'showProfilePage'])->middleware('auth')->name('profile');
// Moderator Routing
// Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');


// Moderator Routing

//Moderator Resource Page
Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');