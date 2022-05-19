<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>Вход</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

</head>
<body class="text-center">

<main class="form-auth">
    <a href="/"><img class="mb-2" src="{{ asset('assets/brand/logo.png') }}" alt="" width="90"></a>
    <h1 class="h3 mb-4 fw-normal">Вход</h1>

    <form action="/sing_in" method="post">
        @csrf
        <div class="form-floating">
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
                   name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
            <label for="email">Email</label>

            <div id="floatingPassword" class="invalid-feedback text-start">
                Нет пользователя с таким email
            </div>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
                   name="password" id="password" placeholder="Password" required>
            <label for="password">Пароль</label>

            <div id="floatingPassword" class="invalid-feedback text-start">
                Неверный пароль
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-3 mb-2" type="submit">Войти</button>
        <a class="link-secondary" href="/sing_up">Регистрация</a>
    </form>
</main>

</body>
</html>
