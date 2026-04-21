@extends('layouts.app')

@section('title', 'Фото ')

@section('content')
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
                    <img src="{{ asset($path) }}" class="d-block w-100" alt="not found...">
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
    @if($access === 'all')
    {{--    Download block--}}
    <div class="row blockDownloadImage">
        <div class="col-12 d-flex">
            <button class="btn downloadImage" id="downloadImage" type="button">
                Скачать фото
            </button>
            <button class="btn downloadImageAll" id="downloadImageAll" type="button">
                Скачать все фото
            </button>
        </div>
    </div>
   @endif
<script src="{{ asset('js/Show.js') }}"></script>
<script>
@if($access === 'all')
    document.getElementById('downloadImageAll').addEventListener('click', ()=>downloadImagesAll(@json($paths)))
    document.getElementById('downloadImage').addEventListener('click', ()=>downloadImage())
@endif
</script>
@endsection
