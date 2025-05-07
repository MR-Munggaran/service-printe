<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .auth-card {
      max-width: 500px;
      margin: 50px auto;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card auth-card shadow-sm">
    <div class="card-body">
      <!-- Pills navs -->
      <ul class="nav nav-pills nav-justified mb-3" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
            aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
            aria-controls="pills-register" aria-selected="false">Register</a>
        </li>
      </ul>
      <!-- Pills navs -->

      <!-- Pills content -->
      <div class="tab-content">
        <!-- Login Tab -->
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
          <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign in</button>
          </form>
        </div>

        <!-- Register Tab -->
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
          <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="form-outline mb-4">
              <label class="form-label" for="name">Name</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="password_confirmation">Repeat Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
        </div>
      </div>
      <!-- Pills content -->
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
