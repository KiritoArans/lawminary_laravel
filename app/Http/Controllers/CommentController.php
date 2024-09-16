<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Rate;
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

        return redirect()
            ->back()
            ->with([
                // 'success' => 'Your comment has been posted!',
                'post_id' => $request->post_id, // Pass the post ID to keep the modal open
                'new_comment' => $comment, // Pass the new comment
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


    public function rateComment(Request $request)
    {

        \Log::info('Comment ID: ' . $request->comment_id);
        // Validate comment_id and rating
        $request->validate([
            'comment_id' => 'required|exists:tblcomments,comment_id', // Validates if comment_id exists
            'rating' => 'required|integer|min:1|max:5', // Ensures rating is between 1 and 5
        ]);

        // Create a new rate record
        $rate = new Rate();
        $rate->comment_id = $request->input('comment_id'); // Use 'comment_id' from the request
        $rate->user_id = Auth::user()->user_id; // Store the ID of the logged-in user
        $rate->rate = $request->input('rating'); // Store the rating
        $rate->save();

        return redirect()->back()->with('success', 'Your rating has been submitted.');
    }



}
