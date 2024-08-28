<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserAccount;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $user = UserAccount::where('username', $credentials['username'])->first();
    
        if ($user) {
            // Check if the password is already using Bcrypt
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                return redirect()->route('home');
            } else {
                // If not, verify with the legacy method and re-hash if valid
                if ($user->password === md5($credentials['password'])) { // Example legacy MD5 check
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                    Auth::login($user);
                    return redirect()->route('home');
                }
            }
        }
        return redirect()->back()->withErrors(['loginError' => 'Invalid username or password.'])->withInput();
    }
}