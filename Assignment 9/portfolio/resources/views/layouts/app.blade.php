<!DOCTYPE html>
<html lang="en">

<head>
    @yield('head')
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
</head>

<body>
    @include('layouts.header')

    {{-- <div class="container max-w-7xl mx-auto">
        @include('layouts.navbar')
    </div> --}}

    <div class="container max-w-7xl mx-auto">
        @yield('content')
    </div>

    <div class="w-full">
        @include('layouts.footer')
    </div>
</body>

</html>
