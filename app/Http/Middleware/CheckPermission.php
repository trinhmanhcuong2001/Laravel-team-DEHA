<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if(auth()->check() && auth()->user()->hasPermission($permission) || Gate::allows('is-super-admin'))
        {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'You do not have enough rights!');
        
    }
}
