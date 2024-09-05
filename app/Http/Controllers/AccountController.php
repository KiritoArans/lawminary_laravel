<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function createAccount(Request $request){
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


    public function updateAccountNames(Request $request)
        {
            $request->validate([
                'username' => 'required|string|max:100',
                'userPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'firstName' => 'required|string|max:100',
                'middleName' => 'nullable|string|max:100',
                'lastName' => 'required|string|max:100',
            ]);

            $user = Auth::user();

            if ($request->hasFile('userPhoto')) {
                $userPhotoPath = $request->file('userPhoto')->store('public/files/profile_pics');
                $user->userPhoto = $userPhotoPath;
            }

            $user->username = $request->username;
            $user->firstName = $request->firstName;
            $user->middleName = $request->middleName;
            $user->lastName = $request->lastName;
            $user->save();

            return redirect()->back()->with('success', 'Your profile has been updated.');
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

        public function showAdModLogin()
        {
            return view('moderator.admod_login');
        }

        public function showMaccounts()
        {
            $accounts = UserAccount::all();
            return view('moderator.Maccounts', ['accounts' => $accounts]);
        }
        
        public function addAccount(Request $request) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable',
                'username' => 'required|unique:tblaccounts,username',
                'email' => 'required|unique:tblaccounts,email',
                'password' => 'required|min:8|confirmed',
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'birthDate' => 'required',
                'nationality' => 'required',
                'sex' => 'nullable',
                'contactNumber' => 'required',
                'accountType' => 'nullable',
                'restrict' => 'nullable',
                'restrictDays' => 'nullable',
            ]);
        
            if ($validator->fails()) {
                // Check if the current route is for admin or moderator
                if (request()->is('admin*')) {
                    return redirect()->route('admin.account') // Redirect sa admin route
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect()->route('moderator.accounts') // Redirect sa moderator route
                        ->withErrors($validator)
                        ->withInput();
                }
            }
            
            // Collect all data from the request except for password
            $data = $request->only([
                'user_id',
                'username',
                'email',
                'firstName',
                'middleName',
                'lastName',
                'birthDate',
                'nationality',
                'sex',
                'contactNumber',
                'accountType',
                'restrict',
                'restrictDays',
            ]);
        
            // Hash the password and include it in the data
            $data['password'] = Hash::make($request->password);
        
            // Create the user account
            UserAccount::create($data);
        
            if (request()->is('admin*')) {
                return redirect()->route('admin.account')->with('success', 'Account updated successfully');
            } else {
                return redirect()->route('moderator.accounts')->with('success', 'Account updated successfully');
            }
        }

        //view/edit button account
        public function updateAccount(Request $request, $id)
        {
        
            // Validate the incoming request data
            $request->validate([
                'username' => 'required|string|max:255|unique:tblaccounts,username,' . $id,
                'email' => 'required|string|email|max:255|unique:tblaccounts,email,' . $id,
                'firstName' => 'required|string|max:255',
                'middleName' => 'nullable|string|max:255',
                'lastName' => 'required|string|max:255',
                'birthDate' => 'required|date',
                'nationality' => 'required|string|max:255',
                'sex' => 'nullable|string',
                'contactNumber' => 'required|string|max:20',
                'restrict' => 'nullable|string',
                'restrictDays' => 'nullable|integer|min:1',
                'accountType' => 'nullable|string',
            ]);

            $account = UserAccount::findOrFail($id);
        
            // Update the account details
            $account->username = $request->input('username');
            $account->email = $request->input('email');
            $account->firstName = $request->input('firstName');
            $account->middleName = $request->input('middleName');
            $account->lastName = $request->input('lastName');
            $account->birthDate = $request->input('birthDate');
            $account->nationality = $request->input('nationality');
            $account->sex = $request->input('sex');
            $account->contactNumber = $request->input('contactNumber');
            $account->restrict = $request->input('restrict');
            $account->restrictDays = $request->input('restrictDays');
            $account->accountType = $request->input('accountType');
        
            // Save the updated account
            $account->save();
            // Redirect back to the accounts list WITHOUT the ID in the URL
            if (request()->is('admin*')) {
                return redirect()->route('admin.account')->with('success', 'Account updated successfully');
            } else {
                return redirect()->route('moderator.accounts')->with('success', 'Account updated successfully');
            }
        }

        //delete account
        public function destroyAccount($id)
        {
            // Find the account by its ID
            $account = UserAccount::findOrFail($id);

            // Delete the account
            $account->delete();

            // Redirect back to the accounts list with a success message
            if (request()->is('admin*')) {
                return redirect()->route('admin.account')->with('success', 'Account deleted successfully');
            } else {
                return redirect()->route('moderator.accounts')->with('success', 'Account deleted successfully');
            }
        }

        //filter
        public function filterAccount(Request $request)
        {
            // Start with a query builder
            $query = UserAccount::query();

            // Apply filters based on the request inputs
            if ($request->filled('filterId')) {
                $query->where('id', $request->input('filterId'));
            }

            if ($request->filled('filterUsername')) {
                $query->where('username', 'like', '%' . $request->input('filterUsername') . '%');
            }

            if ($request->filled('filterEmail')) {
                $query->where('email', 'like', '%' . $request->input('filterEmail') . '%');
            }

            if ($request->filled('accountType') && $request->input('accountType') !== 'all') {
                $query->where('accountType', $request->input('accountType'));
            }

            // Get the filtered results
            $accounts = $query->get();

            // Return the view with the filtered accounts
            if (request()->is('admin*')) {
                return view('admin.account', compact('accounts'));
            } else {
                return view('moderator.maccounts', compact('accounts'));
            }
        }

}

