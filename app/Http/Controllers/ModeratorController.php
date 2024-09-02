<?php

namespace App\Http\Controllers;

// use App\Models\Account;

use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;

use Illuminate\Http\Request;


class moderatorController extends Controller
{
    public function showAdModLogin()
    {
        return view('moderator.admod_login');
    }

    public function showMaccounts()
    {
        $accounts = UserAccount::all();
        return view('moderator.Maccounts', ['accounts' => $accounts]);
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
        'sex' => 'nullable',
        'contactNumber' => 'required',
        'accountType' => 'nullable',
        'restrict' => 'nullable',
        'restrictDays' => 'nullable',
    ]);

    $data['password'] = Hash::make($data['password']);

    $newAccount = UserAccount::create($data);

        return $this->showMaccounts();
    }

    public function showDashboard()
    {
        return view('moderator.dashboard');
    }

    public function showForums()
    {
        return view('moderator.forums');
    }

    public function showPostPage()
    {
        return view('moderator.postpage');
    }

    public function showSystemContent()
    {
        return view('moderator.systemcontent');
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
            'restrict' => 'nullable|string',
            'restrictDays' => 'nullable|integer|min:1',
            'accountType' => 'nullable|string',
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
        $account->sex = $request->input('sex');
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
        return $this->showMaccounts();
    }
    //delete account
    public function destroy($id)
    {
        // Find the account by its ID
        $account = UserAccount::findOrFail($id);

        // Delete the account
        $account->delete();

        // Redirect back to the accounts list with a success message
        return $this->showMaccounts();
    }
    public function filter(Request $request)
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
        return view('moderator.Maccounts', compact('accounts'));
    }

    
}