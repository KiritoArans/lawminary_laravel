<?php

namespace App\Http\Controllers;

// use App\Models\Account;

use App\Models\UserAccount;
use App\Models\ResourceFile;
use Illuminate\Support\Facades\Hash;
use App\Models\general_database;
use Illuminate\Support\Facades\Validator;
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
            return redirect()->route('moderator.accounts')
                ->withErrors($validator)
                ->withInput();
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
    
        return redirect()->route('moderator.accounts')
            ->with('success', 'Account created successfully');
    }
    
    
      

    public function showMdashboard()
    {
        return view('moderator.mdashboard');
    }

    public function showMposts()
    {
        return view('moderator.mposts');
    }

    public function showMleaderboards()
    {
        return view('moderator.mleaderboards');
    }
    
    public function showMforums()
    {
        return view('moderator.mforums');
    }
    
    public function showMfaqs()
    {
        return view('moderator.mfaqs');
    }
    
    //view/edit button account
    public function updateAccount(Request $request, $id)
    {
    
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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
        //return redirect()->route('moderator.accounts')->with('success', 'Account updated successfully.');
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
    //upload resource file
    public function uploadResource(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'documentTitle' => 'required|string|max:255',
            'documentDesc' => 'required|string',
            'documentFile' => 'required|file|mimes:pdf,doc,docx,jpg,png', // Adjust file types as needed
        ]);

        // Handle file upload
        if ($request->hasFile('documentFile')) {
            $filePath = $request->file('documentFile')->store('resources');
        }

        // Create a new resource record
        ResourceFile::create([
            'documentTitle' => $request->input('documentTitle'),
            'documentDesc' => $request->input('documentDesc'),
            'documentFile' => $filePath, // Assuming the path is stored
        ]);

        return redirect()->route('moderator.resources')->with('success', 'Resource uploaded successfully.');
    }

    //update resource file
    public function updateResource(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'documentTitle' => 'required|string|max:255',
            'documentDesc' => 'required|string',
            'documentFile' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,zip', // Adjust file types as needed
        ]);

        // Find the resource by ID
        $resource = ResourceFile::findOrFail($id);

        // Update the resource data
        $resource->documentTitle = $request->input('documentTitle');
        $resource->documentDesc = $request->input('documentDesc');

        // Handle file upload if a new file is uploaded
        if ($request->hasFile('documentFile')) {
            $filePath = $request->file('documentFile')->store('resources');
            
            $resource->documentFile = $filePath;
        }

        // Save the updated resource
        $resource->save();

        // Redirect back with a success message
        return redirect()->route('moderator.resources')->with('success', 'Resource updated successfully.');
    }

    //delete resource file
    public function destroyResource($id)
    {
        // Find the resource by ID
        $resource = ResourceFile::findOrFail($id);

        // Optionally, delete the file from storage
        if ($resource->documentFile) {
            \Storage::delete($resource->documentFile);
        }

        // Delete the resource record from the database
        $resource->delete();

        // Redirect back with a success message
        return redirect()->route('moderator.resources')->with('success', 'Resource deleted successfully.');
    }

    //filter function resources
    public function showMresources(Request $request)
    {
        // Build the query based on the filters
        $query = ResourceFile::query();
    
        if ($request->filled('filterId')) {
            $query->where('id', $request->input('filterId'));
        }
    
        if ($request->filled('filterTitle')) {
            $query->where('documentTitle', 'LIKE', '%' . $request->input('filterTitle') . '%');
        }
    
        if ($request->filled('filterDesc')) {
            $query->where('documentDesc', 'LIKE', '%' . $request->input('filterDesc') . '%');
        }
    
        if ($request->filled('filterDate')) {
            $query->whereDate('created_at', $request->input('filterDate'));
        }
    
        // Get the filtered results
        $rsrcfiles = $query->get();
    
        // Return the view with the filtered resources
        return view('moderator.mresources', compact('rsrcfiles'));
    }
//search function for resources
    public function searchResources(Request $request)
        {
            $searchTerm = $request->input('query');

            $results = ResourceFile::where('documentTitle', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('documentDesc', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('id', 'LIKE', '%' . $searchTerm . '%')
                ->get();

            return response()->json($results);
        }
    
}