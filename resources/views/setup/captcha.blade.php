<!DOCTYPE html>
<html>
<head>
    <title>Setup - Captcha Configuration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            reCAPTCHA Configuration
        </div>
        <div class="card-body">

            <div class="alert alert-danger">
                reCAPTCHA is required to prevent spam and abuse.
                Skipping may expose forms to bots.
            </div>

            <form method="POST" action="{{ route('setup.captcha.save') }}">
                @csrf

                <div class="mb-3">
                    <label>Site Key</label>
                    <input type="text" name="site_key" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>Secret Key</label>
                    <input type="text" name="secret_key" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.storage') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save & Continue</button>
                </div>
            </form>

            <form method="POST" action="{{ route('setup.captcha.skip') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning w-100">Skip Captcha Setup</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
