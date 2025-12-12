  <!doctype html>
  <html lang="en">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin Edit</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <body>



      <div class="card shadow-sm border-0 mx-auto mt-5" style="max-width: 800px;">
          <div class="card-header bg-primary text-white fw-bold">
              Edit Admin Details
          </div>

          <div class="card-body">

              <form action="{{ url('/admin/update/'.$user->id) }}" method="POST">
                  @csrf

                  <!-- Name -->
                  <div class="mb-3">
                      <label class="form-label fw-bold">Name</label>
                      <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                  </div>

                  <!-- Email -->
                  <div class="mb-3">
                      <label class="form-label fw-bold">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                  </div>

                  <!-- Update Button -->
                  <button class="btn btn-success px-4">Update</button>

                  <!-- Back Button -->
                  <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary px-4 ms-2">
                      Back
                  </a>

              </form>

          </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
      </script>
  </body>

  </html>