<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AccountController extends Controller
{

    public function createAccount(Request $request)
    {
        try {
            // Validate the form data with custom error message for password regex
            $data = $request->validate([
                'username' => 'required|unique:tblaccounts,username',
                'email' => 'required|email',
                'password' => [
                    'required',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'birthDate' => [
                    'required',
                    'date',
                    'before_or_equal:' . now()->subYears(13)->format('Y-m-d') // Ensure the user is at least 13 years old
                ],
                'nationality' => 'required',
                'sex' => 'required',
                'contactNumber' => 'required',
            ], [
                'password.regex' => 'Password must contain at least one uppercase, lowercase, digit, and special character.',
                'birthDate.before_or_equal' => 'You must be 13 years old or above to create an account.'
            ]);

            // Generate a random 6-digit OTP
            $otp = rand(100000, 999999);

            // Store the OTP in the session
            session(['otp' => $otp]);

            // Send OTP to user's email
            \Mail::to($data['email'])->send(new \App\Mail\SendOtpMail($otp));

            // Temporarily save the form data to the session until OTP is verified
            session(['user_data' => $data]);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent to your email.',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Catch validation errors and return them as a JSON response
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(), // Return all validation errors
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            // Handle other errors (e.g., mail sending failure)
            return response()->json([
                'success' => false,
                'errors' => ['Error sending OTP. Please try again.'],
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        // Get the OTP from the request
        $otp = $request->input('otp');

        // Check if OTP matches the one sent to the email
        if ($otp != session('otp')) {
            return response()->json(['success' => false, 'errors' => ['Invalid OTP.']], 400);
        }

        try {
            // OTP is correct, create the account using the stored form data
            $data = session('user_data');
            $data['password'] = Hash::make($data['password']);
            $data['accountType'] = 'User';  // Assign default account type

            // Create the user account
            $newAccount = UserAccount::create($data);

            \Mail::raw("Hello " . $data['firstName'] . ",\n\nYour account has been created successfully.", function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject('Account Creation');
            });

            // Clear the session data
            session()->forget(['otp', 'user_data']);

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['Error creating account. Please try again.'],
            ], 500);
        }
    }

    // New method for resending OTP
    public function resendOtp(Request $request)
    {
        try {
            // Check if we have user data in session
            if (!session()->has('user_data')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Session expired. Please start the registration process again.']
                ], 400);
            }

            // Generate a new 6-digit OTP
            $otp = rand(100000, 999999);

            // Get the stored email from session
            $userData = session('user_data');
            $email = $userData['email'];

            // Store the new OTP in the session
            session(['otp' => $otp]);

            // Resend OTP to user's email
            \Mail::to($email)->send(new \App\Mail\SendOtpMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'OTP has been resent to your email.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['Error resending OTP. Please try again.'],
            ], 500);
        }
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
            $userPhotoPath = $request
                ->file('userPhoto')
                ->store('public/files/profile_pics');
            $user->userPhoto = $userPhotoPath;
        }

        $user->username = $request->username;
        $user->firstName = $request->firstName;
        $user->middleName = $request->middleName;
        $user->lastName = $request->lastName;
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Your profile has been updated.');
    }
    
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'new_password.regex' => 'Password must contain at least one uppercase, lowercase, digit, and special character.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()
                ->back()
                ->with('error', 'Current password is incorrect.');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Password changed successfully!');
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

        return redirect()
            ->back()
            ->with('success', 'Your profile has been updated.');
    }

    public function showAdModLogin()
    {
        return view('moderator.admod_login');
    }

    public function showaccounts()
    {
        $accounts = UserAccount::all();
        return view('moderator.account', ['accounts' => $accounts]);
    }

    public function addAccount(Request $request)
    {
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
                return redirect()
                    ->route('admin.account') // Redirect sa admin route
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return redirect()
                    ->route('moderator.account') // Redirect sa moderator route
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

        $data['status'] = 'Pending';
        // Create the user account
        UserAccount::create($data);

        if (request()->is('admin*')) {
            return redirect()
                ->route('admin.account')
                ->with('success', 'Account created successfully');
        } else {
            return redirect()
                ->route('moderator.account')
                ->with('success', 'Account created successfully');
        }
    }

    //view/edit button account
    public function updateAccount(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'userPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|min:1',
            'username' =>
                'required|string|max:255|unique:tblaccounts,username,' . $id,
            'email' =>
                'required|string|email|max:255|unique:tblaccounts,email,' . $id,
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

        if ($request->hasFile('userPhoto')) {
            $file = $request->file('userPhoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs(
                'uploads/profile_pictures',
                $filename,
                'public'
            );
            $account->userPhoto = $filePath; // Save the file path to the 'userPhoto' field
        }

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
        return redirect()
            ->back()
            ->with('success', 'Account updated successfully!');
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
            return redirect()
                ->route('admin.account')
                ->with('success', 'Account deleted successfully');
        } else {
            return redirect()
                ->route('moderator.account')
                ->with('success', 'Account deleted successfully');
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
            $query->where(
                'username',
                'like',
                '%' . $request->input('filterUsername') . '%'
            );
        }

        if ($request->filled('filterEmail')) {
            $query->where(
                'email',
                'like',
                '%' . $request->input('filterEmail') . '%'
            );
        }

        if (
            $request->filled('accountType') &&
            $request->input('accountType') !== 'all'
        ) {
            $query->where('accountType', $request->input('accountType'));
        }

        // Get the filtered results

        $accounts = $query->paginate(10);

        $pendingAcc = UserAccount::where('status', 'Pending')->paginate(10);

        // Return the view with the filtered accounts
        if (request()->is('admin*')) {
            return view('admin.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc, // Pass the pending accounts too
            ]);
        } else {
            return view('moderator.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc, // Pass the pending accounts too
            ]);
        }
    }

    public function searchAccounts(Request $request)
    {
        // Start a query for the Posts model
        $query = UserAccount::query();

        // Check if there's a search term in the request
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            // Search in multiple fields: concern, postedBy, tags, status
            $query
                ->where('user_id', 'like', '%' . $searchTerm . '%')
                ->orWhere('username', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('firstName', 'like', '%' . $searchTerm . '%')
                ->orWhere('middleName', 'like', '%' . $searchTerm . '%')
                ->orWhere('lastName', 'like', '%' . $searchTerm . '%');
        }

        // Execute the query and get the results
        $query->orderBy('created_at', 'desc');

        $accounts = $query->paginate(10);

        $pendingAcc = UserAccount::where('status', 'Pending')->paginate(10);

        // Return the view with the search results
        if (request()->is('admin*')) {
            return view('admin.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc, // Pass the results to the view
            ]);
        } elseif (request()->is('moderator*')) {
            return view('moderator.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc, // Pass the results to the view
            ]);
        }
    }

    public function index(Request $request)
    {
        // Query to get all accounts (pending and approved)
        $accounts = UserAccount::orderBy('created_at', 'desc')->paginate(10); // Paginate with 10 results per page

        // Query to get only pending accounts
        $pendingAcc = UserAccount::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the view with both paginated accounts and pending accounts
        if (request()->is('admin*')) {
            return view('admin.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc, // Pass both all accounts and pending accounts
            ]);
        } elseif (request()->is('moderator*')) {
            return view('moderator.account', [
                'accounts' => $accounts,
                'pendingAcc' => $pendingAcc,
            ]);
        }
    }

    public function approveAccount($id)
    {
        $account = UserAccount::find($id);

        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        $account->status = 'Approved';
        $account->save();

        return redirect()
            ->back()
            ->with('success', 'Account approved successfully.');
    }
}
