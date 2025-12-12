<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 col-md-6">
<a href="{{url('/login')}}" onclick="return confirm('are you sure')">
            <button class="btn btn-danger">Logout</button>
        </a>
    <h3 class="text-center mb-4">Add New Course</h3>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/course_data') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="course_name" class="form-control" required placeholder="Enter course name">
        </div>

        <div class="mb-3">
            <label class="form-label">Duration</label>
            <input type="text" name="duration" class="form-control" required placeholder="e.g. 3 months">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required placeholder="Enter course description"></textarea>
        </div>

        <button  class="btn btn-primary w-100">Add Course</button>
    </form>

</div>

</body>
</html>
