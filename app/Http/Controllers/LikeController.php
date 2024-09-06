<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function likePost(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:tblposts,post_id',
            'user_id' => 'required|exists:tblaccounts,user_id',
            'like' => 'required|boolean',
        ]);

        // Check if the user has already liked this post
        $existingLike = Like::where('post_id', $validated['post_id'])
                            ->where('user_id', $validated['user_id'])
                            ->first();

        if ($existingLike) {
            return response()->json(['success' => false, 'message' => 'You have already liked this post.']);
        }

        // Create a new like entry
        $like = new Like();
        $like->post_id = $validated['post_id'];
        $like->user_id = $validated['user_id'];
        $like->like = $validated['like'];
        $like->save();

        return response()->json(['success' => true, 'message' => 'Post liked successfully!']);
    }
}
