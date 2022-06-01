<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard layouts based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, layouts, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="csrf-token" data-token="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>60 Day Dashboard</title>

    @include('includes.style')

    @stack('style')

</head>

<body>
    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main">

            @include('layouts.navbar')

            @yield('content')

            @include('layouts.footer')
        </div>

    </div>

    @include('includes.script')

    @stack('script')

</body>

</html>
