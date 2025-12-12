<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        overflow-x: hidden;
    }

    .sidebar {
        height: 100vh;
        background: #343a40;
        padding-top: 20px;
    }

    .sidebar a {
        color: #ffffff;
        padding: 12px 20px;
        display: block;
        text-decoration: none;
        margin-bottom: 3px;
        border-radius: 4px;
    }

    .sidebar a:hover {
        background: #495057;
    }

    .sidebar .active {
        background: #0d6efd;
    }

    .content-area {
        padding: 30px;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center text-white mb-4">Admin Panel</h4>

                <a href="{{url('/dashboard') }}" class="active">Dashboard</a>
                 <a href="{{ url('/user_info/'.Auth::user()->id) }}">User</a>                
                <a href="{{ url('/student_list') }}">Students</a>
                <a href="{{url('/course_list') }}">Courses</a>
                <a href="{{url('/admin/enrollment_info') }}">Enrollments</a>
                <a href="{{url('/admin_profile/'.Auth::user()->id) }}">Admin Profile</a>
                <a href="{{url('/login')}}" onclick="return confirm('are you sure')">
                    <button class="btn btn-danger">Logout</button>
                </a>
            </div>

            <!-- Content Area -->
            <div class="col-md-9 col-lg-10 content-area">
                <h2>Welcome, Admin!</h2>
                <hr>

                <p>This is your admin dashboard. Use the sidebar to navigate to different sections.</p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>