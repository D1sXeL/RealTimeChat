<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
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
</body>
</html>