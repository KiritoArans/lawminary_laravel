<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|string|max:100',
        ]);

        $comment = new Comment();
        $comment->comment_id = uniqid();
        $comment->user_id = Auth::user()->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been posted!');
    }
}

