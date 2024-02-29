<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>JobPulse</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
<div class="Line-Progress">
    <div class="indeterminate"></div>
</div>
</div>
<header class="bg-gradient-primary py-3">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="{{ url('/') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <span class="fs-4">JobPulse</span>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ url('/') }}" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="{{ url('/about') }}" class="nav-link px-2 text-white">About</a></li>
          <li><a href="{{ url('/jobs') }}" class="nav-link px-2 text-white">Jobs</a></li>
          <li><a href="{{ url('/blogs') }}" class="nav-link px-2 text-white">Blog</a></li>
        </ul>

        <div class="text-end">
          <a type="button" class="btn btn-outline-light me-2" href="{{ url('userLogin') }}">Login</a>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>
<div>
    @yield('content')
</div>
<footer class="footer py-4 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h5 class="text-white">Job Pulse</h5>
          <p class="text-white">A place you find your way</p>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h5 class="text-white">Footer Section 2</h5>
          <ul class="list-unstyled text-white">
            <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
            <li><a href="{{ url('/about') }}" class="text-white text-decoration-none">About</a></li>
            <li><a href="{{ url('/jobs') }}" class="text-white text-decoration-none">Job</a></li>
            <li><a href="{{ url('/blogs') }}" class="text-white text-decoration-none">Blog</a></li>
            <li><a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact</a></li>
          </ul>
        </div>
        <div class="col-lg-4 text-white">
          <h5 class="text-white">Footer Section 3</h5>
          <p>Contact Info:<br> Email: example@example.com<br> Phone: +1234567890</p>
        </div>
      </div>
    </div>
  </footer>
<script>

</script>

<script src="{{asset('js/bootstrap.bundle.js')}}"></script>

</body>
</html>
