<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount; // Make sure to import UserAccount model
use App\Notifications\UserFollowed;

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

        $isFollowed = false; 

        if ($follow) {
            $follow->delete();
            $isFollowed = false; 
        } else {
            Follow::create([
                'follower' => $user->user_id,
                'following' => $data['following'],
            ]);
            $isFollowed = true;

            $followedUser = UserAccount::where('user_id', $data['following'])->first();

            if ($followedUser && $followedUser->id !== $user->id) {
                $followedUser->notify(new UserFollowed($user));
            }
        }

        return response()->json([
            'success' => true,
            'message' => $isFollowed ? 'Followed Successfully' : 'Unfollowed Successfully',
            'is_followed' => $isFollowed,
            'following' => $data['following'],
        ]);
    }
}
