<!DOCTYPE html>
<html>
<head>
    <title>Setup - Mail Configuration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Mail Configuration
        </div>
        <div class="card-body">

            <div class="alert alert-danger">
                Mail configuration is required for password reset,
                notifications and system alerts.
                Skipping this step may break these features.
            </div>

            <form method="POST" action="{{ route('setup.mail.save') }}">
                @csrf

                <div class="mb-3">
                    <label>Mailer</label>
                    <input type="text" name="mail_mailer" class="form-control" value="smtp" required>
                </div>

                <div class="mb-3">
                    <label>Host</label>
                    <input type="text" name="mail_host" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Port</label>
                    <input type="text" name="mail_port" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="mail_username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="mail_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>From Address</label>
                    <input type="email" name="mail_from_address" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>From Name</label>
                    <input type="text" name="mail_from_name" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.admin') }}" class="btn btn-secondary">Back</a>

                    <div>
                        <button type="submit" class="btn btn-success">Save & Continue</button>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('setup.mail.skip') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning w-100">Skip Mail Setup</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
