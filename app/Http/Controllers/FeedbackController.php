<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function createFeedback(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email' => 'required|exists:tblaccounts,email',
            'feedback' => 'required|string|max:255',
        ]);

        $feedback = new Feedback();
        $feedback->email = $request->email;
        $feedback->feedback = $request->feedback;
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback has been sent.');
    }
}
