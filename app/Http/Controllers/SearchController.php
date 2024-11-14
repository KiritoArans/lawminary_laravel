<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\UserAccount;
use Illuminate\Support\Collection;

class SearchController extends Controller
{

    public function searchPostUser(Request $request)
    {
        $query = $request->input('query');
    
        $users = UserAccount::where('accountType', 'User') 
            ->where('status', 'Approved')
            ->withCount([
                'posts' => function ($query) {
                    $query->where('status', 'Approved'); 
                },
                'followers' 
            ])
            ->get()
            ->filter(function ($user) use ($query) {
                $firstNameDistance = levenshtein(strtolower($query), strtolower($user->firstName));
                $lastNameDistance = levenshtein(strtolower($query), strtolower($user->lastName));
                $usernameDistance = levenshtein(strtolower($query), strtolower($user->username));
                
                // Allow close matches (distance less than or equal to 3, adjust as needed)
                return $firstNameDistance <= 3 || $lastNameDistance <= 3 || $usernameDistance <= 3;
            });

        $lawyers = UserAccount::where('accountType', 'Lawyer') 
            ->where('status', 'Approved')
            ->withCount([
                'posts' => function ($query) {
                    $query->where('status', 'Approved'); 
                },
                'followers' 
            ])
            ->get()
            ->filter(function ($lawyer) use ($query) {
                $firstNameDistance = levenshtein(strtolower($query), strtolower($lawyer->firstName));
                $lastNameDistance = levenshtein(strtolower($query), strtolower($lawyer->lastName));
                $usernameDistance = levenshtein(strtolower($query), strtolower($lawyer->username));
                
                // Allow close matches (distance less than or equal to 3, adjust as needed)
                return $firstNameDistance <= 3 || $lastNameDistance <= 3 || $usernameDistance <= 3;
            });
    
        $posts = Posts::where('status', 'Approved')
            ->where('privacy', 'Public')
            ->with('user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
            ->get()
            ->filter(function ($post) use ($query) {
                $concernDistance = levenshtein(strtolower($query), strtolower($post->concern));
                $firstNameDistance = levenshtein(strtolower($query), strtolower($post->user->firstName));
                $lastNameDistance = levenshtein(strtolower($query), strtolower($post->user->lastName));
                $usernameDistance = levenshtein(strtolower($query), strtolower($post->user->username));
                $categoryDistance = levenshtein(strtolower($query), strtolower($post->concernCategory));
        
                // Allow close matches (distance less than or equal to 3, adjust as needed)
                return $concernDistance <= 3 || $firstNameDistance <= 3 || $lastNameDistance <= 3 || $usernameDistance <= 3 || $categoryDistance <= 3;
            });
        
    
        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
        ->where('privacy', 'Public')
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();
    
        // Return the search results to the view
        return view('users.home-search', compact('users', 'lawyers', 'posts', 'query', 'allPosts'));
    }
}