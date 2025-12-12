<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Enroll Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-4">

        <!-- Page Title -->
        <h2 class="text-center fw-bold mb-4 text-primary">Enroll Student</h2>

        <!-- Welcome Box -->
        <div class="alert alert-info text-center fw-bold">
            Welcome, <span class="text-dark">{{ Auth::user()->name }}</span>
        </div>

        <!-- Success Message -->
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(isset($student))
        <div class="card shadow-lg p-4">

            <h4 class="mb-3 text-secondary fw-bold">Student Details</h4>

            <form action="{{ url('/admin/enroll_student') }}" method="POST">
                @csrf

                <!-- Student Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Student Name</label>
                    <input type="text" class="form-control" 
                           value="{{ $student->full_name }}" readonly>
                </div>

                <!-- Hidden Student ID -->
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <!-- Course Dropdown -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Select Course --</option>

                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100">
                    Enroll Student
                </button>
            </form>

        </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
