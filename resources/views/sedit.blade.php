<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 col-md-6">

        <h3 class="text-center mb-4">Update student detail</h3>
        <a href="{{url('/logout')}}" onclick="return confirm('are you sure')">
            <button class="btn btn-danger">Logout</button>
        </a>

        <div class="text-center">
            Welcome, <strong>{{ Auth::user()->name }}</strong>
        </div>
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
        @if(isset($student_edit_data))
        <form action="{{ url('/studentUpdate') }}" method="POST">
            @csrf


            <div class="mb-3">
                <input type="hidden" name="sid" value="{{$student_edit_data->id}}">
                <label class="form-label">Student Name</label>
                <input type="text" name="sfull_name" class="form-control" value="{{$student_edit_data->full_name}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Duration</label>
                <input type="text" name="sphone" class="form-control" value="{{$student_edit_data->phone}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="sdepartment" class="form-control">{{$student_edit_data->department}}</textarea>
            </div>

            <button class="btn btn-primary w-100">Update</button>
        </form>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>