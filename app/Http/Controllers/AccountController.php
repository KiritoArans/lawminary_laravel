<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'addFirstName' => 'required|string|max:255',
            'addMiddleName' => 'nullable|string|max:255',
            'addLastName' => 'required|string|max:255',
            'addBirthDate' => 'required|date',
            'addNationality' => 'required|string|max:255',
            'addSex' => 'required|in:male,female',
            'addEmail' => 'required|email|unique:tblaccounts,email',
            'addContactNumber' => 'required|string|max:15',
            'addUsername' => 'required|string|max:255|unique:tblaccounts,username',
            'addPassword' => 'required|string|min:8|confirmed',
            'addAccountType' => 'required|in:user,moderator,lawyer,admin',
        ]);
    
        // Insert into the database
        $account = Account::create([
            'first_name' => $request->addFirstName,
            'middle_name' => $request->addMiddleName,
            'last_name' => $request->addLastName,
            'birth_date' => $request->addBirthDate,
            'nationality' => $request->addNationality,
            'sex' => $request->addSex,
            'email' => $request->addEmail,
            'contact_number' => $request->addContactNumber,
            'username' => $request->addUsername,
            'password' => bcrypt($request->addPassword),
            'account_type' => $request->addAccountType,
        ]);
    
        // Debugging: Check if the account was successfully created
        dd($account);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Account created successfully!');
    }
    
}
