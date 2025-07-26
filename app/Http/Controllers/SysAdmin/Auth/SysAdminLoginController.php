<?php

namespace App\Http\Controllers\SysAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SysAdminLoginController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('sysadmin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('sysadmin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('sysadmin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    // Logout sysadmin
    public function logout(Request $request)
    {
        Auth::guard('sysadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sysadmin.login');
    }
}
