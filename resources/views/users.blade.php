<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- All messages -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('message') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="container mt-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">User Dashboard</h3>
            <h2 class="fw-bold my-4" style="font-size: 32px;">
                Welcome, <strong class="text-primary">{{ Auth::user()->name }}</strong>
            </h2>
            <!-- Logout Button -->
            <a href="{{ url('/logout') }}" onclick="return confirm('Are you sure?')">
                <button class="btn btn-danger">Logout</button></a>
            

            <a href="{{ url()->previous() }}" class="btn btn-secondary">  ← Back</a>
              

        </div>

        <!-- User Info Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                Your Profile
            </div>

            <div class="card-body">
                <table class="table table-bordered text-center align-middle mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($data))
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>

                            <td>
                                <!-- Edit -->
                                <a href="{{ url('/user_edit/'. $data->id) }}">
                                    <button class="btn btn-primary btn-sm">Edit</button></a>
                                

                                <!-- Delete -->
                                <a href="{{ url('/user_delete/'. $data->id) }}"
                                    onclick="return confirm('Are you sure to delete?')">
                                    <button class="btn btn-danger btn-sm">Delete</button></a>
                                

                                <!-- enrollment check Course -->
                                <a href="{{ url('/check_enrollment/'.$data->id) }}">
                                    <button class="btn btn-success btn-sm">Courses</button></a>
                                

                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>