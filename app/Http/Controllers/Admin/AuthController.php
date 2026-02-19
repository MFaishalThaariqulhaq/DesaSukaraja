<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        if (!in_array($user->role, ['admin', 'super_admin'], true)) {
            return back()->withErrors(['email' => 'Akun ini tidak memiliki akses admin.'])->withInput();
        }

        $request->session()->regenerate();
        session([
            'admin_logged_in' => true,
            'admin_user_id' => $user->id,
            'admin_name' => $user->name,
            'admin_email' => $user->email,
            'admin_role' => $user->role,
            'admin_avatar' => $user->avatar,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user_id', 'admin_name', 'admin_email', 'admin_role', 'admin_avatar']);
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
