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
    //add account request
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
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
    
            // Redirect with success message
            return redirect()->back()->with('success', 'Account created successfully!');
            
        }
      
    //fetch data in database
    public function index()
    {
        // Fetch all accounts from the database
        $accounts = Account::all();

        // Pass the accounts to the view
        return view('admin.account', ['accounts' => $accounts]);
    }
    //view/edit button account
    public function update(Request $request, $id)
{
    // Find the account by ID
    $account = Account::findOrFail($id);

    // Validate the request data
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'sometimes|nullable|string|min:8|confirmed',
        'firstName' => 'required|string|max:255',
        'middleName' => 'nullable|string|max:255',
        'lastName' => 'required|string|max:255',
        'birthDate' => 'required|date',
        'nationality' => 'required|string|max:255',
        'sex' => 'required|string',
        'contactNumber' => 'required|string|max:20',
        'restrict' => 'nullable|boolean',
        'restrictDays' => 'nullable|integer|min:1',
        'accountType' => 'required|string|max:50',
    ]);
        // Only update the password if a new one is provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->input('password'));
        } else {
            unset($validated['password']);
        }

        // Update the account
        $account->update($validated);

        // Redirect back to the same page with a success message
        return redirect()->route('admin.account')->with('success', 'Account updated successfully');
    }
}

