<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup Wizard - Create Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create Administrator Account</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('setup.admin.save') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.database') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <button type="submit" class="btn btn-success">
                        Save & Continue
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
