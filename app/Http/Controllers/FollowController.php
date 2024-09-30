<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function followUser(Request $request)
    {
        $user = Auth::user();
    
        $data = $request->validate([
            'following' => 'required|exists:tblaccounts,user_id',
        ]);
    
        $follow = Follow::where('follower', $user->user_id)
                        ->where('following', $request->following)
                        ->first();
    
        $isFollowed = false; // Track if the user is followed or unfollowed
    
        if ($follow) {
            $follow->delete();
            $isFollowed = false; // User unfollowed
        } else {
            Follow::create([
                'follower' => $user->user_id,
                'following' => $data['following'],
            ]);
            $isFollowed = true; // User followed
        }
    
        // Return a JSON response with the updated follow status
        return response()->json([
            'success' => true,
            'message' => $isFollowed ? 'Followed Successfully' : 'Unfollowed Successfully',
            'is_followed' => $isFollowed,
            'following' => $data['following'],
        ]);
    }
    

}
