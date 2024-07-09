<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('partials.upload-navbar')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @yield('content')
    </div>
    <!-- End of Page Content -->

    @stack('scripts')
</body>
</html>
