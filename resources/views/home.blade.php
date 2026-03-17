<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
{{--<p>1213</p>--}}
{{--<nav class="navbar navbar-expand-lg" style="background: #1E4736;">--}}
{{--    <div class="container-fluid">--}}
{{--        --}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="navbar header">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand text-white" href="#">
            HostShot
        </a>
    </div>
</nav>

<div class="container mt-4">

    <div class="upload-area" onclick="input.click()">
        Нажми или перетащи фото 📷
    </div>

    <input id="formFileMultiple" type="file" accept="image/*" multiple hidden>

    <div class="carousel-container">
        <button class="arrow left" id="scrollLeft">‹</button>
        <div id="preview" class="preview"></div>
        <button class="arrow right" id="scrollRight">›</button>
    </div>

    <div id="photoContainer"></div>

    <button class="btn  createLinks" type="button">
        <p class="createLinksText">Создать ссылку</p>
    </button>

</div>

<script src="{{ asset('Photo.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
