<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link href="{{ asset('/css/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/vendor/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->

    <link href="{{ asset('/css/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    @stack('styles')
</head>
<body>
@include('partials.navbar')

<!-- Begin Page Content -->
<div class="container-fluid">
    @yield('content')
</div>
<!-- End of Page Content -->

@stack('scripts')
</body>
</html>
