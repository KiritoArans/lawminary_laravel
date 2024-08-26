<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;

Route::get('/', function () {
    return view('welcome');
});

//admin routes

Route::get('/account', [AdminController::class, 'showAccount']);

Route::get('/dashboard', [AdminController::class, 'showDashboard']);

Route::get('/forums', [AdminController::class, 'showForums']);

Route::get('/postpage', [AdminController::class, 'showPostPage']);

Route::get('/systemcontent', [AdminController::class, 'showSystemContent']);

//moderator routes

Route::get('/maccounts', [ModeratorController::class, 'showMaccounts']);

Route::get('/mdashboard', [ModeratorController::class, 'showMdashboard']);

Route::get('/mfaqs', [ModeratorController::class, 'showMfaqs']);

Route::get('/mforums', [ModeratorController::class, 'showMforums']);

Route::get('/mleaderboards', [ModeratorController::class, 'showMleaderboards']);

Route::get('/mposts', [ModeratorController::class, 'showMposts']);

Route::get('/mresources', [ModeratorController::class, 'showMresources']);
