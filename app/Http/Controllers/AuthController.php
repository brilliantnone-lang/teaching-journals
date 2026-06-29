<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\RateLimiterTrait;
use App\Traits\LogActivityTrait;

class AuthController extends Controller
{
    use RateLimiterTrait, LogActivityTrait;

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = $this->getLoginKey();

        if ($this->hasTooManyLoginAttempts($key, 5)) {
            $seconds = $this->getLoginLockoutSeconds($key);

            $this->logActivity('login_failed_rate_limit', 'Terlalu banyak percobaan login dari IP ' . $request->ip(), 'failed');

            return back()
                ->withInput($request->only('email'))
                ->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.");
        }

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) { 
            $request->session()->regenerate();

            $this->clearLoginAttempts($key);

            $user = Auth::user();

            $this->logActivity('login_success', 'Login berhasil untuk user: ' . $user->email);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        $this->incrementLoginAttempts($key, 60);

        $this->logActivity('login_failed', 'Login gagal untuk email: ' . $request->email, 'failed');

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nip' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guru',
            'nip' => $validated['nip'] ?? null,
        ]);

        Auth::login($user);

        $this->logActivity('register_success', 'Registrasi berhasil untuk user: ' . $user->email);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $this->logActivity('logout', 'Logout untuk user: ' . ($user ? $user->email : 'unknown'));
              
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('splash');
    }
}
