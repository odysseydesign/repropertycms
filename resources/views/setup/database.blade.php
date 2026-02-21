<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup Wizard - Database Configuration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Setup Wizard - Database Configuration</h4>
        </div>

        <div class="card-body">

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Database Connection Error --}}
            @if(session('db_error'))
                <div class="alert alert-danger">
                    {{ session('db_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('setup.database.save') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Database Host</label>
                    <input type="text"
                           name="db_host"
                           class="form-control"
                           value="{{ old('db_host', '127.0.0.1') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Database Port</label>
                    <input type="text"
                           name="db_port"
                           class="form-control"
                           value="{{ old('db_port', '3306') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Database Name</label>
                    <input type="text"
                           name="db_name"
                           class="form-control"
                           value="{{ old('db_name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Database Username</label>
                    <input type="text"
                           name="db_user"
                           class="form-control"
                           value="{{ old('db_user') }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Database Password</label>
                    <input type="password"
                           name="db_pass"
                           class="form-control"
                           value="{{ old('db_pass') }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.requirements') }}" class="btn btn-secondary">
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
