<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="fw-bold my-4" style="font-size: 32px;">
            Welcome: <strong class="text-primary">{{ Auth::user()->name }}</strong>
        </h2>
        <h2 class="fw-bold text-center mb-4">Enrollment Information</h2>

        <!-- Success & Error Messages -->
        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
            ← Back
        </a>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                All Enrollments
            </div>

            <div class="card-body p-0">
                <table class="table table-bordered text-center mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>SL</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Course Name</th>
                            <th>Enrolled On</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($info as $enroll)
                        <tr>
                            <td>{{ $i++ }}</td>

                            <td>{{ $enroll->student->full_name ?? 'N/A' }}</td>

                            <td>{{ $enroll->student->user->email ?? 'N/A' }}</td>

                            <td>{{ $enroll->course->course_name ?? 'N/A' }}</td>

                            <td>{{ $enroll->enrolled_on }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>