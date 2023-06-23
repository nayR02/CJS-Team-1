<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('user') && $request->session()->get('user')->isAdmin()) {
            // User is an admin, deny access to the judge page
            return redirect('add_info'); // Replace with the appropriate URL for the admin dashboard
        }
    
        return $next($request);
    }
    

}
