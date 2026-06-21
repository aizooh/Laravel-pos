<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PinLoginController extends Controller
{
    /**
     * Show the login screen with all active users.
     */
    public function showLogin()
    {
        // If already logged in, redirect to the correct dashboard
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        $users = User::where('is_active', true)
            ->select('id', 'name', 'role')
            ->orderBy('role', 'asc') // admin first
            ->get();

        return view('auth.login', compact('users'));
    }

    /**
     * Authenticate using user ID + PIN.
     */
    public function login(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'pin'     => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
        ]);

        $user = User::where('id', $request->user_id)
            ->where('is_active', true)
            ->first();

        // User not found or PIN incorrect
        if (! $user || ! Hash::check($request->pin, $user->pin)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong PIN. Try again.',
            ], 401);
        }

        // Log in and regenerate session
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'success'  => true,
            'redirect' => $this->redirectByRole($user, returnUrl: true),
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Return redirect URL or response based on user role.
     */
    private function redirectByRole(User $user, bool $returnUrl = false)
    {
        $url = match ($user->role) {
            'admin'     => route('admin.dashboard'),
            default     => route('pos.index'),
        };

        return $returnUrl ? $url : redirect($url);
    }
}
