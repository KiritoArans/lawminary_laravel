<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAccount()
    {
        $accounts = Account::all();
        return view('moderator.mresources', ['accounts' => $accounts]);

        return view('admin.account');
    }
    public function addAccount(Request $request){
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

    $newAccount = Account::create($data);

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
}

