<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h3 class="text-center">Student Info</h3>
    <div class="container bordered">
        <a href="{{url('/login')}}" onclick="return confirm('are you sure')">
            <button class="btn btn-danger">Logout</button>
        </a>

        <!-- add coursebutton -->
        <div class="text-end mb-3">
            <a href="{{url('/student')}}">
                <button class="btn btn-primary" id="student">Add Student</button></a>
        </div>
        <div class="text-center">
            Welcome, <strong>{{ Auth::user()->name }}</strong>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Slno</th>
                    <th>Student Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if(isset($student))
                @php $i=1; @endphp
                @foreach($student as $data)

                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->full_name }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->department }}</< /td>
                    <td><a href="{{url('/sedit')}}{{$data->id}}"><button class="btn btn-primary">Edit</button></a>
                        <a href="{{url('/sdelete')}}{{$data->id}}"><button class="btn btn-danger">Delete</button></a>
                        <a href="{{url('admin/senrollment/'.$data->id)}}">
                            <button class="btn btn-primary" id="enrollment">Enrollment</button></a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>