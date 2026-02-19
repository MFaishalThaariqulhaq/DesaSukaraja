<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(['admin', 'super_admin'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'super_admin'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        // Keep current session role/name up to date if editing self.
        if ((int) session('admin_user_id') === $user->id) {
            session([
                'admin_name' => $user->name,
                'admin_email' => $user->email,
                'admin_role' => $user->role,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ((int) session('admin_user_id') === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        if ($user->role === 'super_admin') {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return redirect()->route('admin.users.index')->with('error', 'Super admin terakhir tidak dapat dihapus.');
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus.');
    }
}
