<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\FundType;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('user.index', compact('users'));
    } 

    public function create(Request $request) {
        $employee = null;
        $fundtypes = FundType::all();

        if ($request->filled('EmpID')) {
            $employee = Employee::find($request->EmpID);
        }
    
        return view('user.create', compact('employee', 'fundtypes'));
    }
    
 
    public function store(Request $request) {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Username' => 'required|string|max:100|unique:users,Username',
            'Password' => 'required|string|min:6',
            'UserRole' => 'required|in:Admin,SystemController,Employee',
            'EmpID' => 'nullable|exists:employees,EmpID', // EmpID is optional
            'fund_type' => 'required|exists:fundtypes,id', // ✅ use fund_type       
            ]);
    
        // Check if EmpID is provided
        if ($request->filled('EmpID')) {
            $employee = Employee::find($request->EmpID);
            if ($employee) {
                $firstName = $employee->FirstName;
                $lastName = $employee->LastName;
    
                // Update employee's Username field
                $employee->update(['Username' => $request->Username]);
            } else {
                return redirect()->back()->with('error', 'Employee not found.');
            }
        } else {
            // If no EmpID, use the input fields for FirstName and LastName
            $firstName = $request->FirstName;
            $lastName = $request->LastName;
        }
    
        // Create user with correct FirstName and LastName
        User::create([
            'FirstName' => $firstName, // Use the dynamically assigned variable
            'LastName' => $lastName,   // Use the dynamically assigned variable
            'Username' => $request->Username,
            'Password' => Hash::make($request->Password),
            'UserRole' => $request->UserRole,
            'fund_type' => $request->fund_type,
        ]);
    
        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }
    
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $fundtypes = FundType::all();
        return view('User.edit', compact('user', 'fundtypes'));
    }

    public function update(Request $request, $id)
    {
    $user = User::findOrFail($id);

    $request->validate([
        'FirstName' => 'required|string|max:100',
        'LastName'  => 'required|string|max:100',
        // Exclude the current user from the unique username check
        'Username'  => 'required|string|max:100|unique:users,Username,'.$user->UserID.',UserID',
        'Password'  => 'nullable|string|min:6', // Optional password field
        'UserRole'  => 'required|in:Admin,SystemController,Employee'
    ]);

    // Update fields
    $user->FirstName = $request->FirstName;
    $user->LastName  = $request->LastName;
    $user->Username  = $request->Username;
    
    // Only update password if a new one is provided
    if ($request->filled('Password')) {
        $user->Password = Hash::make($request->Password);
    }

    $user->UserRole  = $request->UserRole;
    $user->save();

    return redirect()->route('user.index')->with('success', 'User updated successfully!');
}

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }


    public function login(Request $request) {
        $request->validate([
            'Username' => 'required|string',
            'Password' => 'required|string'
        ]);

        // Find user by username
        $user = User::where('Username', $request->Username)->first();

        // Check if user exists and verify the password
        if ($user && Hash::check($request->Password, $user->Password)) {
            session(['LoggedUser' => $user->EmpID]); // Store session for login
            return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout() {
        session()->forget('LoggedUser');
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
    
    public function makeAccount(Request $request, $id)
    {
        // Find the employee
        $employee = Employee::findOrFail($id);

        // Validate the request
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'Username' => 'required|string|max:100|unique:users,Username',
            'Password' => 'required|string|min:6',
            'UserRole' => 'required|in:Admin,SystemController,Employee'
        ]);
        User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Username' => $request->Username,
            'Password' => Hash::make($request->Password),
            'UserRole' => $request->UserRole,
        ]);

        // Update the employee's Username
        $employee->update([
            'Username' => $request->Username,
        ]);

        return redirect()->back()->with('success', 'User account created successfully.');
    }

    public function editFundType($id)
    {
        $user = User::findOrFail($id);
        $fundtypes = FundType::all();

        return view('user.change-fundtype', compact('user', 'fundtypes'));
    }

    public function updateFundType(Request $request, $id)
    {
        $request->validate([
            'fundtype' => 'required|exists:fundtypes,id',
        ]);

        $user = User::findOrFail($id);
        $user->fundtype = $request->fundtype;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Fund type updated successfully!');
    }

}



