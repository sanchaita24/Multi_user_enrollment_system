<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 col-md-6">

        <h3 class="text-center mb-4">Add Student Information</h3>
        <div class="text-end mb-3">
            <a href="{{ url('/login') }}" onclick="return confirm('Are you sure?')">
                <button class="btn btn-danger">Logout</button>
            </a>
        </div>
        <div class="text-enter">
            <strong>Welcome:{{ Auth::user()->name }}</strong>
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

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
            ← Back
        </a>

        <form action="{{ url('/student_data') }}" method="POST">
            @csrf

            @if(isset($user))
            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{$user->name}}">
            </div>
           @endif
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required placeholder="Enter phone number">
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" required placeholder="Enter department">
            </div>

            <button class="btn btn-primary w-100">Add Student</button>
        </form>
 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>