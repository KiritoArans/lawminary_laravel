<?php
namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'firstName' => 'required|string|max:255',
        'middleName' => 'nullable|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:tblaccounts',
        'username' => 'required|string|max:255|unique:tblaccounts',
        'password' => 'required|string|min:8',
        'birthDate' => 'required|date',
        'nationality' => 'required|string|max:255',
        'sex' => 'required|string|max:10',
        'contactNumber' => 'required|string|max:20',
        'account_type' => 'required|string|max:50',
    ]);

    // Insert the data into the database
    $account = new Account([
        'firstName' => $request->input('firstName'),
        'middleName' => $request->input('middleName'),
        'lastName' => $request->input('lastName'),
        'email' => $request->input('email'),
        'username' => $request->input('username'),
        'password' => bcrypt($request->input('password')), // Encrypt the password
        'birthDate' => $request->input('birthDate'),
        'nationality' => $request->input('nationality'),
        'sex' => $request->input('sex'),
        'contactNumber' => $request->input('contactNumber'),
        'account_type' => $request->input('account_type'),
    ]);

    // Save the account
    $account->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'Account created successfully!');
}

    
    
}

