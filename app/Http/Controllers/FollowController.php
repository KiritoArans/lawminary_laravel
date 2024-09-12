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

        if ($follow) {
            $follow->delete();
            return redirect()->back()->with('success', 'Unfollowed Successfully');
        }

        Follow::create([
            'follower' => $user->user_id,
            'following' => $data['following'],
        ]);

        return redirect()->back()->with('success', 'Followed Successfully');
    }

}
