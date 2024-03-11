<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
            'role' => 'required|in:job_seeker,employer',
        ]);
        $credentials = request(['email','password','role']);
        
        $user = Auth::user();

        $userExists = User::where('email', $credentials['email'])->exists();

        if (!$userExists) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Not Registered']);
        }

        if(Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->withInput()->withErrors(['email' => 'An error occurred. Please try again.']);
            }

            if ($user->role === 'job_seeker') {
                return redirect()->route('job_seeker.dashboard');
            } elseif ($user->role === 'employer') {
                return redirect()->route('employer.dashboard');
            } else {
                abort(401, 'Unauthorized');
            }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'email belongs to another user.']);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
