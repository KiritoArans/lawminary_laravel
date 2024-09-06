<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
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

        return redirect()->back()->with([
            'post_id' => $request->post_id, 
            'new_comment' => $comment,   
        ]);
    }

    // Reply Function
    public function createReply(Request $request)
    {
        $request->validate([
            'reply' => 'required|string|max:2500',
            'post_id' => 'required|exists:tblposts,post_id',
            'comment_id' => 'required|exists:tblcomments,comment_id',
        ]);

        $reply = new Reply();
        $reply->reply_id = uniqid();
        $reply->comment_id = $request->input('comment_id');
        $reply->post_id = $request->input('post_id');
        $reply->user_id = Auth::user()->user_id;
        $reply->reply = $request->input('reply');
        $reply->save();

        // Redirect back or return a response
        // return redirect()->back()->with('success', 'Replied posted');
        return redirect()->back();
    }
}

