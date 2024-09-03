<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Posts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Login
    public function showLoginPage()
    {
        return view('users.login');
    }

    //Signup
    public function showSignupPage()
    {
        return view('users.signup');
    }

    public function createAccount(Request $request){
        // dd($request);
        $data = $request->validate([
            'user_id' => 'nullable',
            'username' => 'required|unique:tblaccounts,username',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'lastName' => 'required',
            'birthDate' => 'required',
            'nationality' => 'required',
            'sex' => 'required',
            'contactNumber' => 'required',
            'accountType' => 'nullable',
            'restrict' => 'nullable',
            'restrictDays' => 'nullable',
        ]);

        $data['password'] = Hash::make($data['password']);

        $newAccount = UserAccount::create($data);

        return view('users.login');
    }


    //UI
    public function showHomePage()
    {
        return view('users.home');
    }
    public function createPost(Request $request)
    {
        $data = $request->validate([
            'concern' => 'required|string|max:255',
            'concernPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Ensure it's an image file
        ]);

        $post = new Posts;

        $post->post_id = uniqid();
        $post->concern = $data['concern'];
        $post->postedBy = Auth::user()->user_id; 
        // $post->concernPhoto = $data['concernPhoto'];

        if ($request->hasFile('concernPhoto')) {
            $photoPath = $request->file('concernPhoto')->store('public/files/posts');
            $post->concernPhoto = $photoPath; // Assign the file path to the model's property
        }

        $post->save();

        return $this->showHomePage();
    }
    public function showProfilePosts()
    {
        $user = Auth::user();

        $posts = Posts::where('postedBy', $user->user_id)->get();

        return view('users.profile', compact('user', 'posts'));
        // return $this->showProfilePage($user, $posts);
    }
    

    public function showArticlePage()
    {
        return view('users.article');
    }

    public function showForumsPage()
    {
        return view('users.forums');
    }

    public function showNotificationPage()
    {
        return view('users.notification');
    }

    public function showSearchPage()
    {
        return view('users.search');
    }

    public function showResourcesPage()
    {
        return view('users.resources');
    }

    public function showProfilePage()
    {
        return view('users.profile');
    }
        public function updateAccountNames(Request $request)
        {
            $request->validate([
                'username' => 'required|string|max:100',
                'firstName' => 'required|string|max:100',
                'middleName' => 'nullable|string|max:100',
                'lastName' => 'required|string|max:100',
            ]);

            $user = Auth::user();

            $user->username = $request->username;
            $user->firstName = $request->firstName;
            $user->middleName = $request->middleName;
            $user->lastName = $request->lastName;
            // dd($user);
            $user->save();

            return redirect()->back()->with('success', 'Your profile has been updated.');
            // return $this->showAccountPage();
        }
        public function changePassword(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();
        
            return redirect()->back()->with('success', 'Password changed successfully!');
            // return $this->showAccountPage();
        }
        public function updateAccountInfo(Request $request)
        {
            $request->validate([
                // 'bio' => 'nullable|string|max:100',
                'birthDate' => 'required|date',
                'sex' => 'required|string',
                'nationality' => 'required|string|max:100',
                'contactNumber' => 'nullable|string|max:11',
                'email' => 'nullable|string|max:100',
            ]);

            $user = Auth::user();

            // $user->bio = $request->bio;
            $user->birthDate = $request->birthDate;
            $user->sex = $request->sex;
            $user->nationality = $request->nationality;
            $user->contactNumber = $request->contactNumber;
            $user->email = $request->email;

            $user->save();

            return redirect()->back()->with('success', 'Your profile has been updated.');
        }

    //for settings
    public function showAboutLawminaryPage()
    {
        return view('settings.about_lawminary');
    }

    public function showAboutPAOPage()
    {
        return view('settings.about_pao');
    }

    public function showAccountPage()
    {
        return view('settings.account_settings');
    }

    public function showActLogsPage()
    {
        return view('settings.activity_logs');
    }

    public function showFeedbackPage()
    {
        return view('settings.provide_feedback');
    }

    public function showTOSPage()
    {
        return view('settings.tos');
    }
}
