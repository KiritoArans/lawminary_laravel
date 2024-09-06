<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\data_general_controller\general_controller;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::get('/admod/login', [AdminController::class, 'showAdModLogin'])->name('admin.showAdModLogin');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

Route::get('/admin/postpage', [AdminController::class, 'showPostPage'])->name('admin.postpage');

Route::get('/admin/account', [AdminController::class, 'showAccount'])->name('admin.account');

Route::get('/admin/forums', [AdminController::class, 'showForums'])->name('admin.forums');

Route::get('/admin/systemcontent', [AdminController::class, 'showSystemContent'])->name('admin.systemcontent');

// Moderator routes
Route::get('/moderator/dashboard', [ModeratorController::class, 'showMdashboard'])->name('moderator.dashboard');

Route::get('/moderator/posts', [ModeratorController::class, 'showMposts'])->name('moderator.posts');

Route::get('/moderator/leaderboards', [ModeratorController::class, 'showMleaderboards'])->name('moderator.leaderboards');

Route::get('/moderator/resources', [ModeratorController::class, 'showMresources'])->name('moderator.resources');

Route::get('/moderator/accounts', [ModeratorController::class, 'showMaccounts'])->name('moderator.accounts');

Route::get('/moderator/forums', [ModeratorController::class, 'showMforums'])->name('moderator.forums');

Route::get('/moderator/faqs', [ModeratorController::class, 'showMfaqs'])->name('moderator.faqs');

//user routes
Route::get('/login', [PageController::class, 'showLoginPage']);
Route::get('/signup', [PageController::class, 'showSignupPage'])->name('signup');
Route::get('/home', [PageController::class, 'showHomePage'])->name('home')->middleware('auth');
route::get('/article', [PageController::class, 'showArticlePage'])->name('article');
Route::get('/forums', [PageController::class, 'showForumsPage'])->name('forums');
Route::get('/notifications', [PageController::class, 'showNotificationPage']);
Route::get('/search', [PageController::class, 'showSearchPage']);
Route::get('/resources', [PageController::class, 'showResourcesPage']);
Route::get('/profile', [PageController::class, 'showProfilePage']);

//settings routing
Route::get('/about-lawminary', [PageController::class, 'showAboutLawminaryPage']);
Route::get('/about-pao', [PageController::class, 'showAboutPAOPage']);
Route::get('/account-settings', [PageController::class, 'showAccountPage']);
Route::get('/activitylogs', [PageController::class, 'showActLogsPage']);
Route::get('/provide-feedback', [PageController::class, 'showFeedbackPage']);
Route::get('/terms-of-service', [PageController::class, 'showTOSPage']);


// Admin Backend Routing

// Admin Accounts Page
Route::post('/admin/account', [AccountController::class, 'addAccount'])->name('admin.addAccount');
Route::delete('/admin/account/{id}', [AccountController::class, 'destroyAccount'])->name('admin.destroyAccount');
Route::match(['put', 'patch'], '/admin/account/{id}', [AccountController::class, 'updateAccount'])->name('admin.updateAccount');
Route::post('admin/account/filter', [AccountController::class, 'filterAccount'])->name('admin.filterAccount');

// Moderator Accounts Page
Route::post('/moderator/accounts', [AccountController::class, 'addAccount'])->name('moderator.addAccount');
Route::delete('/moderator/accounts/{id}', [AccountController::class, 'destroyAccount'])->name('moderator.destroyAccount');
Route::match(['put', 'patch'], '/moderator/accounts/{id}', [AccountController::class, 'updateAccount'])->name('moderator.updateAccount');
Route::post('/moderator/accounts/filter', [AccountController::class, 'filterAccount'])->name('moderator.filterAccount');


// Moderator Resource Page
Route::post('/moderator/resources/upload', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');
Route::get('/moderator/search-resources', [ModeratorController::class, 'searchResources'])->name('moderator.searchResources');

// User Backend Routing
// Logins
Route::post('/signup', [AccountController::class, 'createAccount'])->name('users.createAccount');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name('loginAdMod');

// Create Post
Route::post('/home', [PostController::class, 'createPost'])->name('users.createPost');

// Create Comment
Route::post('/comment', [CommentController::class, 'createComment'])->name('users.createComment');

//Create Reply
route::post('/reply', [CommentController::class, 'createReply'])->name('users.createReply');

// // Profile Routes// Route for profile posts
// Route::get('/profile/posts', [PostController::class, 'showProfilePosts'])->name('profile.showProfilePosts');
// // Route for profile comments
// Route::get('/profile/comments', [CommentController::class, 'showProfileComments'])->name('profile.showProfileComments');


Route::post('/profile/settings/account/changepass', [AccountController::class, 'changePassword'])->name('settings.changePassword');
Route::post('/profile/settings/account/changeinfo', [AccountController::class, 'updateAccountNames'])->name('settings.updateAccountNames');
Route::post('/profile/settings/account/changeinfo2', [AccountController::class, 'updateAccountInfo'])->name('settings.updateAccountInfo');

// Moderator Routing

//Moderator Resource Page
Route::post('/moderator/resources', [ModeratorController::class, 'uploadResource'])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [ModeratorController::class, 'updateResource'])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [ModeratorController::class, 'destroyResource'])->name('moderator.destroyResource');