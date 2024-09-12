<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostpageController;
use App\Http\Controllers\SystemContentController;
use App\Http\Controllers\ForumController;

use App\Http\Controllers\data_general_controller\general_controller;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::get('/admod/login', [AdminController::class, 'showAdModLogin'])->name(
    'admin.showAdModLogin'
);

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name(
    'admin.dashboard'
);

Route::get('/admin/postpage', [AdminController::class, 'showPostPage'])->name(
    'admin.postpage'
);

Route::get('/admin/account', [AdminController::class, 'showAccount'])->name(
    'admin.account'
);

Route::get('/admin/forums', [AdminController::class, 'showForums'])->name(
    'admin.forums'
);

Route::get('/admin/systemcontent', [
    AdminController::class,
    'showSystemContent',
])->name('admin.systemcontent');

// Moderator routes
Route::get('/moderator/dashboard', [
    ModeratorController::class,
    'showMdashboard',
])->name('moderator.dashboard');

Route::get('/moderator/posts', [
    ModeratorController::class,
    'showMposts',
])->name('moderator.posts');

Route::get('/moderator/leaderboards', [
    ModeratorController::class,
    'showMleaderboards',
])->name('moderator.leaderboards');

Route::get('/moderator/resources', [
    ModeratorController::class,
    'showMresources',
])->name('moderator.resources');

Route::get('/moderator/accounts', [
    ModeratorController::class,
    'showMaccounts',
])->name('moderator.accounts');

Route::get('/moderator/forums', [
    ModeratorController::class,
    'showMforums',
])->name('moderator.forums');

Route::get('/moderator/faqs', [ModeratorController::class, 'showMfaqs'])->name(
    'moderator.faqs'
);

//user routes
Route::get('/login', [PageController::class, 'showLoginPage']);
Route::get('/signup', [PageController::class, 'showSignupPage'])->name(
    'signup'
);
Route::get('/home', [PageController::class, 'showHomePage'])
    ->name('home')
    ->middleware('auth');
Route::get('/article', [PageController::class, 'showArticlePage'])->middleware(
    'auth'
);
Route::get('/forums', [PageController::class, 'showForumsPage']);
Route::get('/notifications', [
    PageController::class,
    'showNotificationPage',
])->middleware('auth');
Route::get('/search', [PageController::class, 'showSearchPage'])->middleware(
    'auth'
);

Route::get('/resources', [
    PageController::class,
    'showResourcesPage',
])->middleware('auth');

Route::get('/profile', [PageController::class, 'showProfilePage'])
    ->name('profile')
    ->middleware('auth');

route::get('/profile-{user_id}', [
    PageController::class,
    'showVisitProfilePage',
])->name('visit-profile');

//settings routing
Route::get('/about-lawminary', [
    PageController::class,
    'showAboutLawminaryPage',
])->middleware('auth');
Route::get('/about-pao', [
    PageController::class,
    'showAboutPAOPage',
])->middleware('auth');
Route::get('/account-settings', [
    PageController::class,
    'showAccountPage',
])->middleware('auth');
Route::get('/activitylogs', [
    PageController::class,
    'showActLogsPage',
])->middleware('auth');
Route::get('/provide-feedback', [
    PageController::class,
    'showFeedbackPage',
])->middleware('auth');
Route::get('/terms-of-service', [
    PageController::class,
    'showTOSPage',
])->middleware('auth');

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Admin Backend Routing

// Admin Accounts Page
Route::post('/admin/account', [AccountController::class, 'addAccount'])->name(
    'admin.addAccount'
);
Route::delete('/admin/account/{id}', [
    AccountController::class,
    'destroyAccount',
])->name('admin.destroyAccount');
Route::match(['put', 'patch'], '/admin/account/{id}', [
    AccountController::class,
    'updateAccount',
])->name('admin.updateAccount');
Route::post('admin/account/filter', [
    AccountController::class,
    'filterAccount',
])->name('admin.filterAccount');

// Admin Dashboard Page

Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name(
    'admin.dashboard'
);
Route::get('admin/dashboard/filter', [
    DashboardController::class,
    'dashboard',
])->name('admin.filterDashboard');

Route::get('/admin/dashboard/search', [
    DashboardController::class,
    'search',
])->name('admin.search');

// Admin Post page
Route::get('admin/postpage', [PostpageController::class, 'postpage'])->name(
    'admin.postpage'
);
Route::match(['get', 'post'], '/admin/postpage', [
    PostpageController::class,
    'postpage',
])->name('admin.postpage');

Route::get('/admin/filter-posts', [
    PostpageController::class,
    'filterPosts',
])->name('admin.filterPosts');

Route::get('/admin/search-posts', [
    PostpageController::class,
    'searchPosts',
])->name('admin.searchPosts');

// edit and update buttons
Route::get('includes_postpage/post_edit_inc/{id}', [
    PostpageController::class,
    'post_edit_inc',
])->name('post_edit_inc');

// Route for updating a post
Route::post('admin/update', [PostpageController::class, 'update'])->name(
    'update'
);

//route for delete a post

Route::delete('/posts/{id}', [PostpageController::class, 'destroy'])->name(
    'posts.destroy'
);

//admin system content route

Route::get('admin/systemcontent', [
    SystemContentController::class,
    'index',
])->name('admin.systemcontent');

Route::match(['put', 'post'], '/admin/systemcontent/update/{id}', [
    SystemContentController::class,
    'update',
])->name('admin.systemcontent.update');

Route::get('admin/systemcontent/search', [
    SystemContentController::class,
    'search',
])->name('admin.systemcontent.search');

//admin forums route

Route::get('/admin/forums', [ForumController::class, 'index'])->name(
    'admin.forums'
);
Route::post('/admin/forums/add', [ForumController::class, 'store'])->name(
    'admin.forums.add'
);
Route::post('/admin/forums/update/{id}', [
    ForumController::class,
    'update',
])->name('admin.forums.update');
Route::delete('/admin/forums/delete/{id}', [
    ForumController::class,
    'destroy',
])->name('admin.forums.delete');

Route::get('/admin/forums', [ForumController::class, 'search'])->name(
    'admin.forums'
);

Route::get('/admin/forums/filter', [ForumController::class, 'filter'])->name(
    'admin.forums.filter'
);

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Moderator Accounts Page
Route::post('/moderator/accounts', [
    AccountController::class,
    'addAccount',
])->name('moderator.addAccount');
Route::delete('/moderator/accounts/{id}', [
    AccountController::class,
    'destroyAccount',
])->name('moderator.destroyAccount');
Route::match(['put', 'patch'], '/moderator/accounts/{id}', [
    AccountController::class,
    'updateAccount',
])->name('moderator.updateAccount');
Route::post('/moderator/accounts/filter', [
    AccountController::class,
    'filterAccount',
])->name('moderator.filterAccount');

//moderator Dashboard Page
Route::get('moderator/dashboard', [
    DashboardController::class,
    'dashboard',
])->name('moderator.dashboard');

Route::post('moderator/dashboard/filter', [
    DashboardController::class,
    'dashboard',
])->name('moderator.filterDashboard');

// Moderator Resource Page
Route::post('/moderator/resources/upload', [
    ModeratorController::class,
    'uploadResource',
])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [
    ModeratorController::class,
    'updateResource',
])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [
    ModeratorController::class,
    'destroyResource',
])->name('moderator.destroyResource');
Route::get('/moderator/search-resources', [
    ModeratorController::class,
    'searchResources',
])->name('moderator.searchResources');

//Moderator Resource Page
Route::post('/moderator/resources', [
    ModeratorController::class,
    'uploadResource',
])->name('moderator.uploadResource');
Route::match(['put', 'patch'], '/moderator/resources/{id}', [
    ModeratorController::class,
    'updateResource',
])->name('moderator.updateResource');
Route::delete('/moderator/{rsrcfile}/destroy', [
    ModeratorController::class,
    'destroyResource',
])->name('moderator.destroyResource');

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// User Backend Routing
// Logins
Route::post('/signup', [AccountController::class, 'createAccount'])->name(
    'users.createAccount'
);

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name(
    'loginAdMod'
);

// Create Post
Route::post('/home', [PostController::class, 'createPost'])->name(
    'users.createPost'
);
// Like Post
Route::post('/home-liked', [PostController::class, 'likePost'])->name(
    'post.like'
);
// Bookmark Post
Route::post('/home-bookmarked', [PostController::class, 'bookmarkPost'])->name(
    'post.bookmark'
);

// Create Comment
Route::post('/comment', [CommentController::class, 'createComment'])->name(
    'users.createComment'
);

// Create Reply
route::post('/reply', [CommentController::class, 'createReply'])->name(
    'users.createReply'
);

Route::post('/profile/settings/account/changepass', [
    AccountController::class,
    'changePassword',
])->name('settings.changePassword');
Route::post('/profile/settings/account/changeinfo', [
    AccountController::class,
    'updateAccountNames',
])->name('settings.updateAccountNames');
Route::post('/profile/settings/account/changeinfo2', [
    AccountController::class,
    'updateAccountInfo',
])->name('settings.updateAccountInfo');

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
