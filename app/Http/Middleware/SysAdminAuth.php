<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SysAdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sysadmin sudah login pakai guard 'sysadmin'
        if (!Auth::guard('sysadmin')->check()) {
            return redirect()->route('sysadmin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
