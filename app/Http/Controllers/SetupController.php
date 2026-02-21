<?php

namespace App\Http\Controllers;

use App\Models\Backend\Admin;
use Illuminate\Http\Request;
use App\Services\EnvService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function requirements()
    {
        $requirements = [
            'php_version' => [
                'required' => '8.1+',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.1.0', '>=')
            ],
            'openssl' => extension_loaded('openssl'),
            'pdo' => extension_loaded('pdo'),
            'mbstring' => extension_loaded('mbstring'),
            'curl' => extension_loaded('curl'),
            'fileinfo' => extension_loaded('fileinfo'),
            'storage_writable' => is_writable(storage_path()),
            'cache_writable' => is_writable(base_path('bootstrap/cache')),
            'env_writable' => is_writable(base_path('.env')),
        ];

        return view('setup.requirements', compact('requirements'));
    }

    public function database()
    {
        return view('setup.database');
    }


    public function saveDatabase(Request $request, EnvService $env)
{
    // $request->validate([
    //     'db_host' => 'required',
    //     'db_port' => 'required',
    //     'db_name' => 'required',
    //     'db_user' => 'required',
    //     'db_pass' => 'nullable',
    // ]);

    // try {

    //     config([
    //         'database.connections.temp' => [
    //             'driver' => 'mysql',
    //             'host' => $request->db_host,
    //             'port' => $request->db_port,
    //             'database' => $request->db_name,
    //             'username' => $request->db_user,
    //             'password' => $request->db_pass,
    //         ]
    //     ]);

    //     DB::connection('temp')->getPdo();

    // } catch (\Exception $e) {
    //     return back()->withErrors(['db_error' => 'Database connection failed.']);
    // }

    // // Save to .env
    // $env->set([
    //     'DB_HOST' => $request->db_host,
    //     'DB_PORT' => $request->db_port,
    //     'DB_DATABASE' => $request->db_name,
    //     'DB_USERNAME' => $request->db_user,
    //     'DB_PASSWORD' => $request->db_pass,
    // ]);

    // // Run migrations
    // Artisan::call('migrate', ['--force' => true]);

    return redirect()->route('setup.admin');
}



public function admin()
{
    return view('setup.create-admin');
}


public function saveAdmin(Request $request)
{
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|email|unique:users,email',
    //     'password' => 'required|min:8|confirmed',
    // ]);

    // Admin::create([
    //     'email' => $request->email,
    //     'password' => Hash::make($request->password),
    // ]);

    return redirect()->route('setup.mail');
}




 /*
    |--------------------------------------------------------------------------
    | MAIL
    |--------------------------------------------------------------------------
    */

    public function mail()
    {
        return view('setup.mail');
    }

    public function saveMail(Request $request)
    {
        // $request->validate([
        //     'mail_mailer' => 'required',
        //     'mail_host' => 'required',
        //     'mail_port' => 'required',
        //     'mail_username' => 'required',
        //     'mail_password' => 'required',
        //     'mail_from_address' => 'required|email',
        //     'mail_from_name' => 'required',
        // ]);

        // $setup = session('setup', []);

        // $setup['mail'] = [
        //     'MAIL_MAILER' => $request->mail_mailer,
        //     'MAIL_HOST' => $request->mail_host,
        //     'MAIL_PORT' => $request->mail_port,
        //     'MAIL_USERNAME' => $request->mail_username,
        //     'MAIL_PASSWORD' => $request->mail_password,
        //     'MAIL_FROM_ADDRESS' => $request->mail_from_address,
        //     'MAIL_FROM_NAME' => $request->mail_from_name,
        // ];

        // $setup['mail_skipped'] = false;

        // session(['setup' => $setup]);

        return redirect()->route('setup.stripe');
    }

    public function skipMail()
    {
        // $setup = session('setup', []);
        // $setup['mail_skipped'] = true;
        // session(['setup' => $setup]);

        return redirect()->route('setup.stripe');
    }

    /*
    |--------------------------------------------------------------------------
    | STRIPE
    |--------------------------------------------------------------------------
    */

    public function stripe()
    {
        return view('setup.stripe');
    }

    public function saveStripe(Request $request)
    {
        // $request->validate([
        //     'stripe_key' => 'required',
        //     'stripe_secret' => 'required',
        //     'stripe_webhook' => 'required',
        // ]);

        // $setup = session('setup', []);

        // $setup['stripe'] = [
        //     'STRIPE_PUBLIC_KEY' => $request->stripe_key,
        //     'STRIPE_SECRET_KEY' => $request->stripe_secret,
        //     'STRIPE_WEBHOOK_SECRET' => $request->stripe_webhook,
        // ];

        // $setup['stripe_skipped'] = false;

        // session(['setup' => $setup]);

        return redirect()->route('setup.storage');
    }

    public function skipStripe()
    {
        // $setup = session('setup', []);
        // $setup['stripe_skipped'] = true;
        // session(['setup' => $setup]);

        return redirect()->route('setup.storage');
    }

    /*
    |--------------------------------------------------------------------------
    | STORAGE
    |--------------------------------------------------------------------------
    */

    public function storage()
    {
        return view('setup.storage');
    }

    public function saveStorage(Request $request)
    {
        // $request->validate([
        //     'driver' => 'required'
        // ]);

        // $setup = session('setup', []);

        // if ($request->driver === 's3') {
        //     $request->validate([
        //         'aws_key' => 'required',
        //         'aws_secret' => 'required',
        //         'aws_region' => 'required',
        //         'aws_bucket' => 'required',
        //     ]);

        //     $setup['storage'] = [
        //         'FILESYSTEM_DISK' => 's3',
        //         'AWS_ACCESS_KEY_ID' => $request->aws_key,
        //         'AWS_SECRET_ACCESS_KEY' => $request->aws_secret,
        //         'AWS_DEFAULT_REGION' => $request->aws_region,
        //         'AWS_BUCKET' => $request->aws_bucket,
        //     ];
        // } else {
        //     $setup['storage'] = [
        //         'FILESYSTEM_DISK' => 'local'
        //     ];
        // }

        // $setup['storage_skipped'] = false;

        // session(['setup' => $setup]);

        return redirect()->route('setup.captcha');
    }

    public function skipStorage()
    {
        // $setup = session('setup', []);
        // $setup['storage_skipped'] = true;
        // session(['setup' => $setup]);

        return redirect()->route('setup.captcha');
    }

    /*
    |--------------------------------------------------------------------------
    | CAPTCHA
    |--------------------------------------------------------------------------
    */

    public function captcha()
    {
        return view('setup.captcha');
    }

    public function saveCaptcha(Request $request)
    {
        // $request->validate([
        //     'site_key' => 'required',
        //     'secret_key' => 'required',
        // ]);

        // $setup = session('setup', []);

        // $setup['captcha'] = [
        //     'RECAPTCHA_SITE_KEY' => $request->site_key,
        //     'RECAPTCHA_SECRET_KEY' => $request->secret_key,
        // ];

        // $setup['captcha_skipped'] = false;

        // session(['setup' => $setup]);

        return redirect()->route('setup.final');
    }

    public function skipCaptcha()
    {
        // $setup = session('setup', []);
        // $setup['captcha_skipped'] = true;
        // session(['setup' => $setup]);

        return redirect()->route('setup.final');
    }

    /*
    |--------------------------------------------------------------------------
    | FINAL STEP
    |--------------------------------------------------------------------------
    */

    public function final()
    {
        return view('setup.final', [
            'setup' => session('setup')
        ]);
    }

    public function finish(EnvService $env)
    {
        $setup = session('setup');

        /*
        | Write all env values at once
        */
        // $envData = [];

        // foreach ($setup as $section) {
        //     if (is_array($section)) {
        //         $envData = array_merge($envData, $section);
        //     }
        // }

        // $env->set($envData);

        // /*
        // | Run migrations
        // */
        // Artisan::call('migrate', ['--force' => true]);

        // /*
        // | Create Admin
        // */
        // User::create([
        //     'name' => $setup['admin']['name'],
        //     'email' => $setup['admin']['email'],
        //     'password' => Hash::make($setup['admin']['password']),
        // ]);

        // /*
        // | Store flags
        // */
        // DB::table('settings')->insert([
        //     ['key' => 'is_installed', 'value' => true],
        //     ['key' => 'mail_configured', 'value' => !($setup['mail_skipped'] ?? false)],
        //     ['key' => 'stripe_configured', 'value' => !($setup['stripe_skipped'] ?? false)],
        //     ['key' => 'storage_configured', 'value' => !($setup['storage_skipped'] ?? false)],
        //     ['key' => 'captcha_configured', 'value' => !($setup['captcha_skipped'] ?? false)],
        // ]);

        // $env->set(['APP_INSTALLED' => 'true']);

        session()->flush();
        $env->set(['APP_INSTALLED' => 'true']);
        return redirect('/login');
    }

}
