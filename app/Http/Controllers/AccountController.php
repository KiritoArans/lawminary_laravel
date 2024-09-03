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
                'firstName' => 'required|string|max:100',
                'middleName' => 'nullable|string|max:100',
                'lastName' => 'required|string|max:100',
            ]);

            $user = Auth::user();

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

}
