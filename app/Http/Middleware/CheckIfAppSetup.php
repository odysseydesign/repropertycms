<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAppSetup
{
    /**
     * Handle an incoming request.
     *
     * This middleware controls access to the application based on
     * the Setup Wizard installation status.
     *
     * Purpose:
     * - If the application is NOT installed:
     *     Only setup routes are accessible.
     * - If the application IS installed:
     *     Setup routes are blocked.
     * - If installation is marked complete but database is broken:
     *     Redirect to repair mode safely.
     *
     * This prevents:
     * - Application crashes on first run
     * - Re-running setup after installation
     * - Access when database is misconfigured
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check installation flag from config (reads from APP_INSTALLED in .env)
        $isInstalled = Config::get('app.installed');

        /*
        |--------------------------------------------------------------------------
        | If Application Is Not Installed
        |--------------------------------------------------------------------------
        |
        | Only allow access to setup routes.
        | Block all other routes and redirect to setup wizard.
        |
        */
        if (!$isInstalled) {

            if (!$request->is('setup*')) {
                return redirect('/setup');
            }

            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | If Application Is Installed
        |--------------------------------------------------------------------------
        |
        | Block access to setup routes.
        |
        */
        if ($isInstalled && $request->is('setup*')) {
            return redirect('/login');
        }

        /*
        |--------------------------------------------------------------------------
        | Verify Database Integrity (Only After Installation)
        |--------------------------------------------------------------------------
        |
        | We only check the database if the app is marked installed.
        | This avoids crashing on first run when DB is not configured.
        |
        */
        try {

            // Ensure database connection works
            DB::connection()->getPdo();

            // Ensure integration_settings table exists
            if (!Schema::hasTable('integration_settings')) {
                return redirect('/setup/database-repair');
            }

            // Ensure installation record exists in database
            $installedInDb = DB::table('integration_settings')
                ->where('integration', 'app')
                ->where(function ($query) {
                    $query->where('is_setup', true)
                          ->orWhere('is_setup', 1);
                })
                ->exists();

            if (!$installedInDb) {
                return redirect('/setup/database-repair');
            }

        } catch (\Exception $e) {

            // If DB connection fails, redirect to repair
            return redirect('/setup/database-repair');
        }

        return $next($request);
    }
}
