    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <body>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <!-- LEFT: Profile Info -->
                    <div class="d-flex align-items-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png"
                            class="rounded-circle border me-3" width="90" height="90">

                        <div>
                            <h3 class="fw-bold mb-1 text-primary">
                                {{ Auth::user()->name }}
                            </h3>

                            <h6 class="text-muted mb-1">
                                Email: <strong>{{ Auth::user()->email }}</strong>
                            </h6>

                            <span class="badge bg-success">Administrator</span>
                        </div>
                    </div>

                    <!-- RIGHT: Logout Button -->
                    <div>
                        <a href="{{ url('/logout') }}" onclick="return confirm('Are you sure you want to logout?')">
                            <button class="btn btn-danger px-4">Logout</button></a>
                        
                        <a href="{{ url('/admin_edit/'.Auth::user()->id) }}">
                            <button class="btn btn-primary px-4">Edit</button></a>
                        

                        <!-- Delete Button -->
                        <a href="{{ url('/admin/delete/'.Auth::user()->id) }}"
                            onclick="return confirm('Are you sure you want to delete this account?')">
                            <button class="btn btn-danger px-4">Delete</button></a>
                        
                    </div>

                </div>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
    </body>

    </html>