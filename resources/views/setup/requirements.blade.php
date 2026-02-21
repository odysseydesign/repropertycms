<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup Wizard - System Requirements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Setup Wizard - System Requirements</h4>
        </div>

        <div class="card-body">

            @php
                $allPassed = true;
            @endphp

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Requirement</th>
                        <th>Current Status</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- PHP Version --}}
                    <tr>
                        <td>PHP Version (Required: {{ $requirements['php_version']['required'] }})</td>
                        <td>{{ $requirements['php_version']['current'] }}</td>
                        <td>
                            @if($requirements['php_version']['status'])
                                <span class="badge bg-success">OK</span>
                            @else
                                @php $allPassed = false; @endphp
                                <span class="badge bg-danger">Fail</span>
                            @endif
                        </td>
                    </tr>

                    {{-- Extensions --}}
                    @foreach(['openssl','pdo','mbstring','curl','fileinfo'] as $extension)
                        <tr>
                            <td>{{ strtoupper($extension) }} Extension</td>
                            <td>{{ $requirements[$extension] ? 'Enabled' : 'Missing' }}</td>
                            <td>
                                @if($requirements[$extension])
                                    <span class="badge bg-success">OK</span>
                                @else
                                    @php $allPassed = false; @endphp
                                    <span class="badge bg-danger">Fail</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    {{-- Writable Checks --}}
                    @foreach(['storage_writable' => 'Storage Folder Writable',
                              'cache_writable' => 'Bootstrap Cache Writable',
                              'env_writable' => '.env File Writable'] as $key => $label)
                        <tr>
                            <td>{{ $label }}</td>
                            <td>{{ $requirements[$key] ? 'Writable' : 'Not Writable' }}</td>
                            <td>
                                @if($requirements[$key])
                                    <span class="badge bg-success">OK</span>
                                @else
                                    @php $allPassed = false; @endphp
                                    <span class="badge bg-danger">Fail</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('setup.requirements') }}" class="btn btn-secondary">
                    Back
                </a>

                @if($allPassed)
                    <a href="{{ route('setup.database') }}" class="btn btn-success">
                        Setup Database
                    </a>
                @else
                    <button class="btn btn-danger" disabled>
                        Fix Issues Before Continuing
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>

</body>
</html>
