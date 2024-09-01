<?php

namespace App\Http\Controllers;

// use App\Models\Account;

use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAccount()
    {
        $accounts = UserAccount::all();
        return view('admin.account', ['accounts' => $accounts]);
    }
    public function addAccount(Request $request){
       //dd($request);
       $data = $request->validate([
        'user_id' => 'nullable',
        'username' => 'required|unique:tblaccounts,username',
        'email' => 'required|unique:tblaccounts,email',
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

        return $this->showAccount();
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function showForums()
    {
        return view('admin.forums');
    }

    public function showPostPage()
    {
        return view('admin.postpage');
    }

    public function showSystemContent()
    {
        return view('admin.systemcontent');
    }
    
    //view/edit button account
    public function updateAccount(Request $request, $id)
    {
        $account = UserAccount::findOrFail($id);

        $request->validate([
            // 'user_id' => 'nullable',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // 'password' => 'nullable|string|min:8|confirmed',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'nationality' => 'required|string|max:255',
            'sex' => 'nullable|string',
            'contactNumber' => 'required|string|max:20',
            'restrict' => 'nullable|boolean',
            'restrictDays' => 'nullable|integer|min:1',
            'accountType' => 'required|string|max:50',
        ]);

        // $account->user_id = $request->input('user_id');
        $account->username = $request->input('username');
        $account->email = $request->input('email');
        // $account->password = $request->input('password');
        $account->firstName = $request->input('firstName');
        $account->middleName = $request->input('middleName');
        $account->lastName = $request->input('lastName');
        $account->birthDate = $request->input('birthDate');
        $account->nationality = $request->input('nationality');
        $account->contactNumber = $request->input('contactNumber');
        $account->restrict = $request->input('restrict');
        $account->restrictDays = $request->input('restrictDays');
        $account->accountType = $request->input('accountType');
        // if ($request->filled('password')) {
        //     $validated['password'] = bcrypt($request->input('password'));
        // } else {
        //     unset($validated['password']);
        // }

        $account->save();
        return $this->showAccount();
    }
}