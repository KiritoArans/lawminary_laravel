<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostpageController;
use App\Http\Controllers\SystemContentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ResourcepageController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\SearchUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AboutLawController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Middleware\UserMiddleware;

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

Route::get('/admin/systemcontent', [
    AdminController::class,
    'showSystemContent',
])->name('admin.systemcontent');

// Moderator routes
Route::get('/moderator/dashboard', [
    ModeratorController::class,
    'showdashboard',
])->name('moderator.dashboard');

Route::get('/moderator/posts', [
    ModeratorController::class,
    'showMposts',
])->name('moderator.posts');

Route::get('/moderator/leaderboards', [
    ModeratorController::class,
    'showMleaderboards',
])->name('moderator.leaderboards');

Route::get('/moderator/account', [
    ModeratorController::class,
    'showaccount',
])->name('moderator.accounts');

//user routes
Route::get('/login', [PageController::class, 'showLoginPage']);
Route::get('/signup', [PageController::class, 'showSignupPage'])->name(
    'signup'
);
Route::get('/lawyer-signup', [
    PageController::class,
    'showLawyerSignupPage',
])->name('lawyerSignup');
Route::get('/forgot-password', [PageController::class, 'showForgotPassPage']);

Route::get('/forgot-password-otp', [PageController::class, 'showOtpPage']);

Route::get('/view-{post_id}', [
    PageController::class,
    'showViewPostPage',
])->middleware('auth');

Route::get('/forum-view-{post_id}', [
    PageController::class,
    'showForumViewPostPage',
])
    ->middleware('auth')
    ->name('forum-view'); // Add this to name the route

Route::get('/home', [PageController::class, 'showHomePage'])
    ->name('home')
    ->middleware('auth');

Route::get('/home-search', [PageController::class, 'showHomeSearchPage'])
    ->name('home-search')
    ->middleware('auth');

Route::get('/article', [PageController::class, 'showArticlePage'])->middleware(
    'auth'
);
Route::get('/article-searched', [
    PageController::class,
    'showArticlePage',
])->name('search.articles');

Route::get('/leaderboards', [
    PageController::class,
    'showLeaderboardsPage',
])->middleware('auth');

Route::get('/forums', [PageController::class, 'showForumsPage'])->middleware(
    'auth'
);
Route::get('/notifications', [
    PageController::class,
    'showNotificationPage',
])->middleware('auth');

Route::get('/search-law', function () {
    return view('users.search-law');
})
    ->name('searchLaw')
    ->middleware('auth');

Route::post('/search-law', [PageController::class, 'showSearchLawPage'])
    ->name('searchLaw')
    ->middleware('auth');

Route::get('/resources', [
    PageController::class,
    'showResourcesPage',
])->middleware('auth');
Route::get('/resources', [ResourcepageController::class, 'showUserResources'])
    ->name('user.resources')
    ->middleware('auth');

Route::get('/resources/download/{id}', [
    ResourcepageController::class,
    'downloadResource',
])
    ->name('user.downloadResource')
    ->middleware('auth');

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

Route::get('/activitylogs', [PageController::class, 'showActLogsPage'])
    ->middleware('auth')
    ->name('actlogs');

// Show feedback form
Route::get('/provide-feedback', [PageController::class, 'showFeedbackPage'])
    ->middleware('auth')
    ->name('users.showFeedbackPage');

// Handle form submission
Route::post('/provide-feedback', [FeedbackController::class, 'createFeedback'])
    ->middleware('auth')
    ->name('users.createFeedback');

//
Route::get('/terms-of-service', [
    PageController::class,
    'showTOSPage',
])->middleware('auth');

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Admin Backend Routing

// Admin Accounts Page
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('account', [AccountController::class, 'index'])->name(
            'admin.account'
        );
        Route::get('pending-accounts', [
            AccountController::class,
            'pendingAcc',
        ])->name('admin.pendingAcc');

        Route::post('account', [AccountController::class, 'addAccount'])->name(
            'admin.addAccount'
        );
        Route::delete('account/{id}', [
            AccountController::class,
            'destroyAccount',
        ])->name('admin.destroyAccount');
        Route::match(['put', 'patch'], 'account/{id}', [
            AccountController::class,
            'updateAccount',
        ])->name('admin.updateAccount');
        Route::get('account/filter', [
            AccountController::class,
            'filterAccount',
        ])->name('admin.filterAccount');

        Route::get('account/searchAccounts', [
            AccountController::class,
            'searchAccounts',
        ])->name('admin.searchAccounts');

        Route::post('approveAccount/{id}', [
            AccountController::class,
            'approveAccount',
        ])->name('admin.approveAccount');
        Route::delete('/removeRestriction/{user_id}', [
            AccountController::class,
            'removeRestriction',
        ])->name('admin.removeRestriction');
    });

// dashboard controller
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('dashboard', [
            DashboardController::class,
            'dashboard',
        ])->name('admin.dashboard');

        Route::get('dashboard/filter', [
            DashboardController::class,
            'dashboard',
        ])->name('admin.filterDashboard');

        Route::get('dashboard/search', [
            DashboardController::class,
            'search',
        ])->name('admin.search');
        Route::get('/dashboard/data', [
            DashboardController::class,
            'getDashboardData',
        ]);

        Route::get('/dashboard/post-engagement-data', [
            DashboardController::class,
            'getPostEngagementData',
        ])->name('admin.postEngagementData');

        Route::get('dashboard/lawyer-response-data', [
            DashboardController::class,
            'getLawyerResponseData',
        ])->name('admin.lawyerResponseData');

        Route::get('/dashboard/user-rating-data', [
            DashboardController::class,
            'getUserRatingData',
        ])->name('admin.userRatingData');

        Route::get('/generate-daily-report', [
            DashboardController::class,
            'generateDailyReport',
        ])->name('admin.generate.dailyReport');
    });

Route::get('/api/chart-data', [DashboardController::class, 'getDataForChart']);

// Admin Post page
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        // Admin Post Page
        Route::get('postpage', [PostpageController::class, 'postpage'])->name(
            'admin.postpage'
        );
        Route::match(['get', 'post'], 'postpage', [
            PostpageController::class,
            'postpage',
        ])->name('admin.postpage');

        // Filtering and Searching Posts
        Route::get('filter-posts', [
            PostpageController::class,
            'filterPosts',
        ])->name('admin.filterPosts');
        Route::get('postpage/search', [
            PostpageController::class,
            'searchPosts',
        ])->name('admin.searchPosts');

        Route::get('includes_postpage/post_edit_inc/{id}', [
            PostpageController::class,
            'post_edit_inc',
        ])->name('post_edit_inc');

        // Edit and Update Post
        Route::post('/update', [PostpageController::class, 'update'])->name(
            'admin.update'
        );

        // View reported posts
        Route::get('/reported-posts', [
            PostpageController::class,
            'viewReportedPosts',
        ])->name('admin.viewReportedPosts');

        // View reports attached to a post
        Route::get('/post-reports/{postId}', [
            PostpageController::class,
            'viewPostReports',
        ])->name('admin.viewPostReports');

        // Update post status to 'Disregarded'
        Route::post('/disregard-post/{postId}', [
            PostpageController::class,
            'disregardPost',
        ])->name('admin.disregardPost');

        // Deleting a Post
        Route::delete('posts/{id}', [
            PostpageController::class,
            'destroy',
        ])->name('posts.destroy');
    });

//admin system content route
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {
        Route::get('systemcontent', [
            SystemContentController::class,
            'index',
        ])->name('admin.systemcontent');
        Route::post('systemcontent/store', [
            SystemContentController::class,
            'store',
        ])->name('admin.systemcontent.store');
        Route::put('systemcontent/update/{id}', [
            SystemContentController::class,
            'update',
        ])->name('admin.systemcontent.update');
    });

//admin forums route
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('forums', [ForumController::class, 'showMforums'])->name(
            'admin.forums'
        );

        Route::post('/createForum', [
            ForumController::class,
            'createForum',
        ])->name('admin.createForum');

        Route::get('forums/search', [
            ForumController::class,
            'searchMforums',
        ])->name('admin.searchForums');

        Route::get('forums/filter', [
            ForumController::class,
            'filterMforums',
        ])->name('admin.filterForums');

        Route::post('forums/{forum_id}/edit', [
            ForumController::class,
            'updateForum',
        ])->name('admin.updateForum');

        Route::delete('forums/{forum_id}/delete', [
            ForumController::class,
            'deleteForum',
        ])->name('admin.deleteForum');
    });

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//moderator Dashboard Page
Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('dashboard', [
            DashboardController::class,
            'dashboard',
        ])->name('moderator.dashboard');

        Route::get('dashboard/filter', [
            DashboardController::class,
            'dashboard',
        ])->name('moderator.filterDashboard');

        Route::get('dashboard/search', [
            DashboardController::class,
            'search',
        ])->name('moderator.search');
        Route::get('/dashboard/data', [
            DashboardController::class,
            'getDashboardData',
        ]);

        Route::get('/dashboard/post-engagement-data', [
            DashboardController::class,
            'getPostEngagementData',
        ])->name('moderator.postEngagementData');

        Route::get('dashboard/lawyer-response-data', [
            DashboardController::class,
            'getLawyerResponseData',
        ])->name('moderator.lawyerResponseData');

        Route::get('/dashboard/user-rating-data', [
            DashboardController::class,
            'getUserRatingData',
        ])->name('moderator.userRatingData');

        Route::get('/generate-daily-report', [
            DashboardController::class,
            'generateDailyReport',
        ])->name('moderator.generate.dailyReport');
    });

//moderator post page

Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('postpage', [PostpageController::class, 'postpage'])->name(
            'moderator.postpage'
        );
        Route::post('postspage/{id}/disregard', [
            PostpageController::class,
            'postDisregard', // This should point to the correct method
        ])->name('posts.disregard');

        Route::match(['get', 'post'], 'postpage', [
            PostpageController::class,
            'postpage',
        ])->name('moderator.postpage');

        Route::get('filter-posts', [
            PostpageController::class,
            'filterPosts',
        ])->name('moderator.filterPosts');

        Route::get('postpage', [
            PostpageController::class,
            'searchPosts',
        ])->name('moderator.searchPosts');

        Route::post('/update', [PostpageController::class, 'update'])->name(
            'moderator.update'
        );
        // View reported posts
        Route::get('/reported-posts', [
            PostpageController::class,
            'viewReportedPosts',
        ])->name('moderator.viewReportedPosts');

        // View reports attached to a post
        Route::get('/post-reports/{postId}', [
            PostpageController::class,
            'viewPostReports',
        ])->name('moderator.viewPostReports');
        // Update post status to 'Disregarded'
        Route::post('/disregard-post/{postId}', [
            PostpageController::class,
            'disregardPost',
        ])->name('moderator.disregardPost');
        Route::delete('/posts/{Id}', [
            PostpageController::class,
            'destroy',
        ])->name('moderator.destroy');
    });

//leaderboards page
Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('leaderboards', [
            LeaderboardController::class,
            'leaderboards',
        ])->name('moderator.leaderboards');

        Route::get('search-leaderboards', [
            leaderboardController::class,
            'search',
        ])->name('moderator.searchLeaderboards');

        Route::get('leaderboards/filter', [
            LeaderboardController::class,
            'filter',
        ])->name('moderator.filterLeaderboards');
    });

// Moderator Resource Page

Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::post('resources/upload', [
            ResourcepageController::class,
            'uploadResource',
        ])->name('moderator.uploadResource');
        Route::get('resources/download/{id}', [
            ResourcepageController::class,
            'downloadResource',
        ])->name('moderator.downloadResource');

        Route::get('search-resources', [
            ResourcepageController::class,
            'search',
        ])->name('moderator.searchResources');

        Route::get('resources', [
            ResourcepageController::class,
            'resources',
        ])->name('moderator.resources');

        Route::get('resources/filter', [
            ResourcepageController::class,
            'filterResources',
        ])->name('moderator.filterResources');
        Route::post('moderator/resources/update', [
            ResourcepageController::class,
            'updateResource',
        ])->name('moderator.updateResource');

        Route::delete('moderator/resources/delete/{id}', [
            ResourcepageController::class,
            'destroy',
        ])->name('moderator.deleteResource');
    });

// Moderator Accounts Page
Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('account', [AccountController::class, 'index'])->name(
            'moderator.account'
        );
        Route::get('pending-accounts', [
            AccountController::class,
            'pendingAcc',
        ])->name('moderator.pendingAcc');

        Route::post('account', [AccountController::class, 'addAccount'])->name(
            'moderator.addAccount'
        );
        Route::delete('account/{id}', [
            AccountController::class,
            'destroyAccount',
        ])->name('moderator.destroyAccount');

        Route::match(['put', 'patch'], 'account/{id}', [
            AccountController::class,
            'updateAccount',
        ])->name('moderator.updateAccount');

        Route::get('account/filter', [
            AccountController::class,
            'filterAccount',
        ])->name('moderator.filterAccount');

        Route::get('account/searchAccounts', [
            AccountController::class,
            'searchAccounts',
        ])->name('moderator.searchAccounts');

        Route::post('approveAccount/{id}', [
            AccountController::class,
            'approveAccount',
        ])->name('moderator.approveAccount');
        Route::delete('/removeRestriction/{user_id}', [
            AccountController::class,
            'removeRestriction',
        ])->name('moderator.removeRestriction');
    });

// Moderator Forums
Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('forums', [ForumController::class, 'showMforums'])->name(
            'moderator.forums'
        );

        Route::post('/createForum', [
            ForumController::class,
            'createForum',
        ])->name('moderator.createForum');

        Route::get('forums/search', [
            ForumController::class,
            'searchMforums',
        ])->name('moderator.searchForums');

        Route::get('forums/filter', [
            ForumController::class,
            'filterMforums',
        ])->name('moderator.filterForums');

        Route::post('forums/{forum_id}/edit', [
            ForumController::class,
            'updateForum',
        ])->name('moderator.updateForum');

        Route::delete('forums/{forum_id}/delete', [
            ForumController::class,
            'deleteForum',
        ])->name('moderator.deleteForum');
    });

// Moderator FAQs

Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        // Route for displaying FAQs
        Route::get('/faqs', [FaqsController::class, 'getFAQs'])->name(
            'moderator.faqs'
        );

        // Route for searching FAQs with a search query
        Route::get('/faqs/search', [FaqsController::class, 'searchFAQs'])->name(
            'faqs.search'
        );

        Route::get('/faqs/fetch-related', [
            FaqsController::class,
            'fetchRelatedQuestions',
        ])->name('faqs.related');
    });

//about law page

Route::prefix('moderator')
    ->middleware(['auth', ModeratorMiddleware::class]) // Use the default auth middleware
    ->group(function () {
        Route::get('/about-law', [
            AboutLawController::class,
            'showArticlePage',
        ])->name('moderator.about-law');
        Route::get('/article-searched', [
            AboutLawController::class,
            'searchArticlePageMod',
        ])->name('search.articlesMod');
        Route::post('/add-law', [AboutLawController::class, 'addLaw'])->name(
            'add.law'
        );
        Route::put('/laws/{id}', [
            AboutLawController::class,
            'updateLaw',
        ])->name('update.law');

        // Route to delete a law
        Route::delete('/laws/{id}', [
            AboutLawController::class,
            'deleteLaw',
        ])->name('delete.law');
    });

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// User Backend Routing
// Logins
Route::post('/signup', [AccountController::class, 'createAccount'])->name(
    'users.createAccount'
);
Route::post('/delete-account', [
    AccountController::class,
    'deleteAccount',
])->name('deleteAccount');

Route::post('/lawyer-signup', [
    AccountController::class,
    'createLawyerAccount',
])->name('lawyers.createAccount');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/loginAdMod', [AuthController::class, 'loginAdMod'])->name(
    'loginAdMod'
);

Route::post('/logoutAdMod', [AuthController::class, 'logoutAdMod'])->name(
    'logoutAdMod'
);

// Forgot Password

Route::middleware(['web'])->group(function () {
    Route::post('/validate-user', [
        ForgotPasswordController::class,
        'validateUser',
    ]);
    Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
    Route::post('/resend-otp', [ForgotPasswordController::class, 'resendOtp']);
    Route::post('/update-password', [
        ForgotPasswordController::class,
        'updatePassword',
    ]);
});

// OTP-related Routes
Route::post('/account-verify-otp', [
    AccountController::class,
    'verifyOtp',
])->name('verify.otp');
Route::post('/account-resend-otp', [
    AccountController::class,
    'resendOtp',
])->name('resend.otp');

// Create Post
Route::post('/home', [PostController::class, 'createPost'])->name(
    'users.createPost'
);
// Delete Post
Route::delete('/home-{post}', [PostController::class, 'deletePost'])->name(
    'post.delete'
);
Route::post('update-privacy-{post_id}', [
    PostController::class,
    'updatePrivacy',
])->name('post.updatePrivacy');

Route::delete('/forum-{post}', [
    PostController::class,
    'deleteForumPost',
])->name('forumPost.delete');

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
// Rate Comment
route::get('/check-rating/{comment_id}', [
    CommentController::class,
    'checkIfRated',
]);
route::post('/rate-comment', [CommentController::class, 'rateComment'])->name(
    'rateComment'
);

// Create Reply
route::post('/reply', [CommentController::class, 'createReply'])->name(
    'users.createReply'
);

// Report Post
Route::post('/report', [ReportController::class, 'submitReport'])->name(
    'report.submit'
);

// Follow User
Route::post('/home-followed', [FollowController::class, 'followUser'])->name(
    'followUser'
);

// Settings Update Functions
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

// Forum Routes
route::get('/forum-{forum_id}', [
    PageController::class,
    'showVisitForum',
])->name('visit.forum');

Route::post('/forum', [PostController::class, 'createForumPost'])->name(
    'createForumPost'
);
// Join Forum
Route::post('/forum-join', [ForumController::class, 'joinForum'])->name(
    'forum.join'
);

// Search Post and User
Route::get('/home-search', [SearchController::class, 'searchPostUser'])->name(
    'search.results'
);

// Delete Notification
Route::delete('/notification-{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);

    if ($notification) {
        $notification->delete();
    }

    return back()->with('success', 'Notification deleted successfully.');
})->name('notification.delete');

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//search user function routing

Route::post('/search', [
    SearchUserController::class,
    'findPossibleCharges',
])->name('find.charges');
