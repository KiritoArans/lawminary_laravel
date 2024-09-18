<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Rate;
use App\Models\Points;
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

        if (Auth::user()->accountType === 'Attorney') {
            $addPoints = new Points();
            $addPoints->lawyerUser_id = Auth::user()->user_id;
            $addPoints->points = "20";
            $addPoints->pointsFrom = "Comment";
            $addPoints->save();
        }

        return redirect()
            ->back()
            ->with([
                'success' => 'Your comment has been posted!',
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

        if (Auth::user()->accountType === 'Attorney') {
            $addPoints = new Points();
            $addPoints->lawyerUser_id = Auth::user()->user_id;
            $addPoints->points = "10";
            $addPoints->pointsFrom = "Reply";
            $addPoints->save();
        }

        return redirect()->back()->with('success', 'Replied posted');
        return redirect()->back();
    }

    public function checkIfRated($comment_id)
    {
        $hasRated = Rate::where('comment_id', $comment_id)
                        ->where('user_id', Auth::user()->user_id)
                        ->exists();
    
        return response()->json(['hasRated' => $hasRated]);
    }
    
    public function rateComment(Request $request)
    {
        $request->validate([
            'lawyerUser_id' => 'required|exists:tblcomments,user_id', 
            'comment_id' => 'required|exists:tblcomments,comment_id', 
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rate = new Rate();
        $rate->user_id = Auth::user()->user_id; 
        $rate->comment_id = $request->input('comment_id'); 
        $rate->lawyerUser_id = $request->input('lawyerUser_id');
        $rate->rate = $request->input('rating'); 
        $rate->save();


        $points = $request->input('rating') * 10;

        $addPoints = new Points();
        $addPoints->lawyerUser_id = $request->input('lawyerUser_id');
        $addPoints->points = $points; 
        $addPoints->pointsFrom = "Rate";
        $addPoints->save();

        return redirect()->back()->with('success', 'Your rating has been submitted.');
    }

}
