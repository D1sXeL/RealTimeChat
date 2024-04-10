@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <form action="{{ route('auth.name') }}" method="post">
            @csrf
            <p>Введите уникальный никнейм</p>
            <input name="name" type="text" class="form-input">
            <button class="form-button">Авторизоваться</button>
        </form>    

        @if(isset($error))
            <p style="color: red; font-size: 20px">{{$error}}</p>
        @endif
    </section>
@endsection
