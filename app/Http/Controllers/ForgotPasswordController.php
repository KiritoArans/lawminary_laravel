<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    // Validate User and Send OTP
    public function validateUser(Request $request)
    {
        // Log the request data for debugging purposes
        Log::info('Forgot password: Validating user with', $request->all());

        // Validate the request input
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
        ]);

        // Try to find the user in the database
        $user = UserAccount::where('username', $request->username)
                            ->where('email', $request->email)
                            ->first();

        if (!$user) {
            // Return an error response if the user is not found
            return response()->json([
                'success' => false,
                'message' => 'No account found with the provided username and email.',
            ], 404);
        }

        // Generate OTP and save it
        $otpCode = rand(100000, 999999);
        Otp::create([
            'user_id' => $user->user_id,
            'otp' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(10), // OTP expiry in 10 minutes
        ]);

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode));
        } catch (\Exception $e) {
            // Log and return error if email fails to send
            Log::error('Forgot password: OTP email failed to send', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again.',
            ], 500);
        }

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your email.',
        ], 200);
    }


    // Verify the OTP
    public function verifyOtp(Request $request)
    {
        // Validate the OTP input
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Find the OTP in the database and check if it is valid and not expired
        $otp = Otp::where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otp) {
            // Return error if OTP is invalid or expired
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.',
            ], 400);
        }

        // OTP is valid, store user ID in session for the next step
        session(['user_id' => $otp->user_id]);

        return response()->json(['success' => true, 'message' => 'OTP verified.'], 200);
    }


    // Update Password after OTP is Verified
    public function updatePassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // Check if the user_id is in session
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->back()->with('error', 'Session expired or invalid.');
        }

        // Find the user based on the stored user_id
        $user = UserAccount::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the session after successful password update
        session()->forget('user_id');

        return redirect()->route('login')->with('success', 'Password updated successfully');
    }
}
