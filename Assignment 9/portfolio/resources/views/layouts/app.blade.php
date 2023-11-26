<!DOCTYPE html>
<html lang="en">
<head>
    @yield('head')
</head>
<body>
    @include('layouts.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>
</html>
