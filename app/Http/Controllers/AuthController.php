<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserAccount;
use Carbon\Carbon;

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
        if ($user->status !== 'Approved') {
            return redirect()
                ->back()
                ->withErrors(['loginError' => 'Account not yet approved.'])
                ->withInput();
        }

        // Check if the user is restricted and get restriction details
        $restriction = \DB::table('tblrestrict')->where('user_id', $user->user_id)->first();

        if ($restriction) {
            $restrictDays = $restriction->restrict_days;
            $restrictStartTime = $restriction->created_at; // Assuming this is a timestamp
            $restrictEndTime = Carbon::parse($restrictStartTime)->addDays($restrictDays); // Calculate end time
            
            // Calculate remaining hours until restriction ends
            $currentDateTime = Carbon::now();
            if ($currentDateTime->isBefore($restrictEndTime)) {
                // Calculate remaining hours correctly
                $remainingHours = $restrictEndTime->diffInHours($currentDateTime, false);
                
                // Use abs() to ensure it's always positive, then cast to an integer
                $remainingHours = (int) abs($remainingHours);
                
                return redirect()
                    ->back()
                    ->withErrors(['loginError' => "You are restricted for $remainingHours hour(s)."])
                    ->withInput();
            }
        }

        // Verify the password
        if (Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home')->with('username', $user->username);
        } else {
            // Handle legacy MD5 password
            if ($user->password === md5($credentials['password'])) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
                Auth::login($user);
                return redirect()->route('home')->with('username', $user->username);
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
