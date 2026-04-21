@extends('layouts.app')
@section('title', 'Password')

@section('content')
<div class="container-fluid">
    <form action="/link-password/check" method="post">
        @csrf
        <div class="BlockPassword">
            <p class="BlockPasswordTitle text-center">Password</p>
            <hr>
            <input class="BlockPasswordInput" type="password" name="password" id="password">
            <input type="text" name="id" value="{{ $id }}" style="display: none">
            <button type="submit" class="btn BlockPasswordBtn">Отправить</button>
        </div>
    </form>
</div>
@endsection
