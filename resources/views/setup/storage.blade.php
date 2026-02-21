<!DOCTYPE html>
<html>
<head>
    <title>Setup - Storage Configuration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Storage Configuration
        </div>
        <div class="card-body">

            <div class="alert alert-danger">
                S3 is required if you plan to store files on AWS.
                If skipped, system will use local storage.
            </div>

            <form method="POST" action="{{ route('setup.storage.save') }}">
                @csrf

                <div class="mb-3">
                    <label>Select Storage Driver</label>
                    <select name="driver" class="form-select" required>
                        <option value="local">Local</option>
                        <option value="s3">S3</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>AWS Access Key</label>
                    <input type="text" name="aws_key" class="form-control">
                </div>

                <div class="mb-3">
                    <label>AWS Secret</label>
                    <input type="text" name="aws_secret" class="form-control">
                </div>

                <div class="mb-3">
                    <label>AWS Region</label>
                    <input type="text" name="aws_region" class="form-control">
                </div>

                <div class="mb-4">
                    <label>AWS Bucket</label>
                    <input type="text" name="aws_bucket" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('setup.stripe') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save & Continue</button>
                </div>
            </form>

            <form method="POST" action="{{ route('setup.storage.skip') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning w-100">Skip Storage Setup</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
