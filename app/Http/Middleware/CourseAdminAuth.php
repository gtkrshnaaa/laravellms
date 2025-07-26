<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseAdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('course_admin')->check()) {
            return redirect()->route('course_admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}