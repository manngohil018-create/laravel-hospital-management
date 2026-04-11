<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $allowedRoles = [];

        // Define permissions based on role
        $permissions = [
            'manage_doctors' => ['admin'],
            'manage_appointments' => ['admin', 'doctor'],
            'manage_patients' => ['admin'],
            'view_analytics' => ['admin', 'doctor'],
            'export_data' => ['admin', 'doctor'],
        ];

        if (isset($permissions[$permission]) && in_array($user->role, $permissions[$permission])) {
            return $next($request);
        }

        abort(403, 'Unauthorized permission');
    }
}
