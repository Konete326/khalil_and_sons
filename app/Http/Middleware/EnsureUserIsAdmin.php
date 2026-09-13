<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->guest(route('admin.login'))->with('status', 'Please authenticate to access the master administrative terminal.');
        }

        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Administrative privileges required.');
        }

        return $next($request);
    }
}
