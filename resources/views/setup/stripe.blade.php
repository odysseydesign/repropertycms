<!DOCTYPE html>
<html>
<head>
    <title>Setup - Stripe Configuration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Stripe Configuration
        </div>
        <div class="card-body">

            <div class="alert alert-danger">
                Stripe is required for subscription and payment features.
                Skipping this step will disable payment functionality.
            </div>

            <form method="POST" action="{{ route('setup.stripe.save') }}">
                @csrf

                <div class="mb-3">
                    <label>Stripe Public Key</label>
                    <input type="text" name="stripe_key" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Stripe Secret Key</label>
                    <input type="text" name="stripe_secret" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>Stripe Webhook Secret</label>
                    <input type="text" name="stripe_webhook" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.mail') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save & Continue</button>
                </div>
            </form>

            <form method="POST" action="{{ route('setup.stripe.skip') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning w-100">Skip Stripe Setup</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
