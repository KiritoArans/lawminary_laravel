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

        $user = UserAccount::where(
            'username',
            $credentials['username']
        )->first();

        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                return redirect()
                    ->route('home')
                    ->with('username', $user->username);
            } else {
                if ($user->password === md5($credentials['password'])) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                    Auth::login($user);
                    return redirect()
                        ->route('home')
                        ->with('username', $user->username);
                }
            }
        }
        return redirect()
            ->back()
            ->withErrors(['loginError' => 'Invalid username or password.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function loginAdMod(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserAccount::where(
            'username',
            $credentials['username']
        )->first();

        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);

                if ($request->has('is_moderator')) {
                    if ($user->accountType === 'Moderator') {
                        return redirect()->route('moderator.dashboard');
                    } else {
                        Auth::logout();
                        return redirect()
                            ->back()
                            ->withErrors([
                                'loginError' =>
                                    'Unauthorized access as Moderator.',
                            ])
                            ->withInput();
                    }
                } else {
                    if ($user->accountType === 'Admin') {
                        return redirect()->route('admin.dashboard');
                    } else {
                        Auth::logout();
                        return redirect()
                            ->back()
                            ->withErrors([
                                'loginError' => 'Unauthorized access as Admin.',
                            ])
                            ->withInput();
                    }
                }
            } else {
                if ($user->password === md5($credentials['password'])) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                    Auth::login($user);

                    if ($request->has('is_moderator')) {
                        if ($user->accountType === 'Moderator' || 'moderator') {
                            return redirect()->route('moderator.dashboard');
                        } else {
                            Auth::logout();
                            return redirect()
                                ->back()
                                ->withErrors([
                                    'loginError' =>
                                        'Unauthorized access as Moderator.',
                                ])
                                ->withInput();
                        }
                    } else {
                        if ($user->accountType === 'Admin' || 'admin') {
                            return redirect()->route('admin.dashboard');
                        } else {
                            Auth::logout();
                            return redirect()
                                ->back()
                                ->withErrors([
                                    'loginError' =>
                                        'Unauthorized access as Admin.',
                                ])
                                ->withInput();
                        }
                    }
                }
            }
        }
        return redirect()
            ->back()
            ->withErrors(['loginError' => 'Invalid username or password.'])
            ->withInput();
    }

    public function logoutAdMod()
    {
        Auth::logout(); // Log the user out of the application
        return redirect()->route('admin.showAdModLogin'); // Redirect to login page after logout
    }
}
