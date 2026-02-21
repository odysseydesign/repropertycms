<!DOCTYPE html>
<html>
<head>
    <title>Setup - Final Step</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            Final Review
        </div>
        <div class="card-body">

            <h5>Configuration Summary</h5>

            <ul>
                <li>Mail: {{ isset($setup['mail_skipped']) && $setup['mail_skipped'] ? 'Skipped' : 'Configured' }}</li>
                <li>Stripe: {{ isset($setup['stripe_skipped']) && $setup['stripe_skipped'] ? 'Skipped' : 'Configured' }}</li>
                <li>Storage: {{ isset($setup['storage_skipped']) && $setup['storage_skipped'] ? 'Skipped' : 'Configured' }}</li>
                <li>Captcha: {{ isset($setup['captcha_skipped']) && $setup['captcha_skipped'] ? 'Skipped' : 'Configured' }}</li>
            </ul>

            <form method="POST" action="{{ route('setup.finish') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100">
                    Complete Installation
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
