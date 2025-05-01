<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="auth.css" rel="stylesheet">
    <link href = "{{asset('images/kasir.jpg')}}" rel="icon" type="image/jpg">
</head>
<body>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

      <div class="px-4 px-md-5 ms-xl-4 d-flex align-items-center">
        <div class="row">
          <img src="https://s10011.cdn.ncms.io/wp-content/uploads/2023/04/logo-epson.png" 
              alt="Epson Logo" 
              class="img-fluid me-3" 
              style="max-height: 100px; width: auto;">
          <h5 class="mb-0 text-dark fw-bold">PT EPSON AUTHORIZED SERVICE</h5>
        </div>
      </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>


                <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form2Example18" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
                <label class="form-label" for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form2Example28" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required />
                <label class="form-label" for="password">Password</label>
                @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pt-1 mb-4">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                </div>

                <p>Don't have an account? <a href="{{ route('register.show') }}" class="link-info">Register here</a></p>

            </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="https://cdn1-production-images-kly.akamaized.net/BWWiYbGsVCiYmbkdkI1togjkkWI=/1200x1200/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4625469/original/064247900_1698333191-freya_body_lipt6.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
