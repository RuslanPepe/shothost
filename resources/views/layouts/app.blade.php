<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

{{--<nav class="navbar header">--}}
{{--    <div class="container-fluid justify-content-center">--}}
{{--        <a class="navbar-brand text-white" href="/" style="margin: 0;">--}}
{{--            HostShot--}}
{{--        </a>--}}
{{--        <div class="blockBtnAuth">--}}
{{--            <div class="btn btn-sdecondary">Login</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="navbar header">
    <div class="container-fluid position-relative d-flex align-items-center">
        <!-- Левая часть (пусто, чтобы центр был реально центр) -->
        <div style="flex:1"></div>

        <!-- Центр -->
        <a class="navbar-brand text-white mx-auto" href="/" style="margin: 0;">
            HostShot
        </a>

        <!-- Правая часть -->
        <div class="blockBtnAuth" style="flex:1; display:flex; justify-content:flex-end">
            @if(!auth()->check())
                <div class="btn btn-outline-light textBtnAuth" style="margin: 0 12px 0 0">
                    <a class="text-decoration-none text-white btnAuth" href="{{ route('register') }}">Register</a>
                </div>
                <div class="btn btn-outline-light textBtnAuth">
                    <a class="text-decoration-none text-white btnAuth" href="{{ route('login') }}">Login</a>
                </div>
            @endif
        </div>
    </div>
</nav>


<div class="container mt-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>

