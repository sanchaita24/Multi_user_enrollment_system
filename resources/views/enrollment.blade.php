<!DOCTYPE html>
<html>
<head>
    <title>Enroll in Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container col-md-6 mt-5">

    <h3 class="text-center mb-4">Enroll in a Course</h3>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/enroll_store') }}" method="POST">
        @csrf

        {{-- Hidden student ID --}}
        <input type="hidden" name="student_id" value="{{ $student->id }}">

        <div class="mb-3">
            <label class="form-label">Select Course</label>
            <select name="course_id" class="form-select" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->course_name }} ({{ $course->duration }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Enrollment Date</label>
            <input type="date" name="enrolled_on" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Enroll Now</button>
    </form>

</div>

</body>
</html>
