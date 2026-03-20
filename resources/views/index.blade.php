<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<nav class="navbar header">
    <div class="container-fluid justify-content-center">
        <p class="navbar-brand text-white" style="margin: 0">
            HostShot
        </p>
    </div>
</nav>

<div class="container mt-4">

    @if($body['title'])
        <div class="titleContext"><p class="title">Title: </p>{{ $body['title'] }}</div>
    @endif

    @if($body['description'])
        <div class="descriptionContext"><p class="description">Description: </p>{{ $body['description'] }}</div>
    @endif

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            @foreach($paths as $path)
                <button type="button" data-bs-target="#carouselExampleIndicators" class="{{ $loop->first ? 'active' : '' }}" data-bs-slide-to="{{ $loop->index }}" {{ $loop->first ? 'aria-current="true"' : '' }} aria-label="Slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($paths as $path)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ url('photo/' . urlencode($path)) }}" class="d-block w-100" alt="not found...">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
