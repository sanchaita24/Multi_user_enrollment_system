<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>course list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>


    <h3 class="text-center">course Info</h3>
    <div class="container bordered">

        <!-- add coursebutton -->
        @if(Auth::user()->role==1)
        <div class="text-end mb-3">
            <a href="{{url('/course')}}">
                <button class="btn btn-primary" id="addCourse">Add course</button></a>
        </div>
        @endif
        <div class="text-center">
            <p class="d-none">admin id id always 2 
                 user_id:{{request()->route('id')}},  Welcome, <strong>{{ Auth::user()->name }} and id is  : {{Auth::id()}}</strong>
            </p>
          Welcome, <strong>{{ Auth::user()->name }}</strong>
        </div>
        <a href="{{url('/logout')}}" onclick="return confirm('are you sure')">
            <button class="btn btn-danger mb-2">Logout</button></a>
        
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-2">   ← Back
        </a>
         
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
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Slno</th>
                    <th>Couser Name</th>
                    <th>Duration</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if(isset($course))
                @php $i=1; @endphp
                @foreach($course as $data)

                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->course_name }}</td>
                    <td>{{ $data->duration }}</td>
                    <td>{{ $data->description }}</td>
                    <td><a href="{{url('/cedit')}}{{$data->id}}"><button class="btn btn-primary">Edit</button></a>
                        <a href="{{url('/cdelete')}}{{$data->id}}"><button class="btn btn-danger">Delete</button></a>
                        <a href="{{url('/enrollment_data/'.request()->route('id').'/'.$data->id)}}">
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