<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Using Auth for login/logout
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserActivityLog;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login.index'); // Ensure you have a login.blade.php in your views folder
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validate incoming request data
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in using Auth
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent fixation
            $request->session()->regenerate();
            
            // Log successful login
            UserActivityLog::logActivity(
                Auth::user()->UserID,
                'login',
                'system',
                'User logged into the system',
                ['username' => $credentials['username']],
                $request->fullUrl(),
                'POST'
            );
            
            return redirect()->intended('dashboard')->with('success', 'Logged in successfully.');
        }

        // Authentication failed: redirect back with error
        return back()->withErrors([
            'Username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        // Log logout before actually logging out
        if ($user) {
            UserActivityLog::logActivity(
                $user->UserID,
                'logout',
                'system',
                'User logged out of the system',
                [],
                $request->fullUrl(),
                'POST'
            );
        }
        
        Auth::logout();
        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
