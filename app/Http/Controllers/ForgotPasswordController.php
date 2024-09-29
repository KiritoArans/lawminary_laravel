<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Validate user and send OTP
    public function validateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        $user = UserAccount::where('username', $request->username)
                            ->where('email', $request->email)
                            ->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => ['Account not found.<br>Please input valid Username and Email.']
            ], 404);
        }
    
        // Generate OTP and store
        $otpCode = rand(100000, 999999);
        Otp::create([
            'user_id' => $user->user_id,
            'otp' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);
    
        // Send OTP via email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['Failed to send OTP email. Please try again.']
            ], 500);
        }
    
        session(['user_id' => $user->user_id]);
    
        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your email.',
        ], 200);
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        // Get the user ID from session
        $userId = session('user_id');
    
        if (!$userId) {
            return response()->json([
                'success' => false,
                'errors' => ['Session expired or invalid. Please try again.']
            ], 400);
        }
    
        $user = UserAccount::where('user_id', $userId)->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => ['User not found. Please start the process again.']
            ], 404);
        }
    
        // Generate a new OTP
        $otpCode = rand(100000, 999999);
        Otp::create([
            'user_id' => $user->user_id,
            'otp' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);
    
        // Resend OTP via email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['Failed to send OTP email. Please try again.']
            ], 500);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'OTP has been resent to your email.',
        ], 200);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ], 400);
        }
    
        $otp = Otp::where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    
        if (!$otp) {
            return response()->json([
                'success' => false,
                'errors' => ['Invalid or expired OTP.'],
            ], 400);
        }
    
        session(['user_id' => $otp->user_id]);
    
        return response()->json([
            'success' => true,
            'message' => 'OTP verified.',
        ], 200);
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase, lowercase, digit, and special character.'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ], 400);
        }
    
        $userId = session('user_id');
    
        if (!$userId) {
            return response()->json([
                'success' => false,
                'errors' => ['Session expired or invalid. Please try again.']
            ], 400);
        }
    
        $user = UserAccount::where('user_id', $userId)->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => ['User not found.']
            ], 404);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        session()->forget('user_id');
    
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!',
        ], 200);
    }
}
