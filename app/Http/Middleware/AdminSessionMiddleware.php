<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_logged_in') || !session('admin_user_id')) {
            return redirect()->route('admin.login');
        }

        $adminUser = User::find(session('admin_user_id'));
        if (!$adminUser || !in_array($adminUser->role, ['admin', 'super_admin'], true)) {
            session()->forget(['admin_logged_in', 'admin_user_id', 'admin_name', 'admin_email', 'admin_role']);
            return redirect()->route('admin.login');
        }

        // Sync session name/role in case user data changed.
        session([
            'admin_name' => $adminUser->name,
            'admin_email' => $adminUser->email,
            'admin_role' => $adminUser->role,
        ]);

        return $next($request);
    }
}
