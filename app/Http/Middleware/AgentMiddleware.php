<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = $request->session()->get('agent');
        if (! Auth::guard('agent')->check() && ! $agent) {
            return redirect()->route('login')->with('error', 'You are not authorized to view the requested page. Please login.');
        }

        return $next($request);
    }
}
