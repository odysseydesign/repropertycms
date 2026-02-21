<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AgentLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agent.agents.SignIn');
    }

    /**
     * Handle an incoming authentication request.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgentLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Login Successfully !');
    }

    /**
     * Destroy an authenticated session.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('agent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('agent.login');
    }
}
