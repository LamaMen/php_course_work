<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>Регистрация</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-auth">
    <a href="/"><img class="mb-2" src="{{ asset('assets/brand/logo.png') }}" alt="" width="90"></a>
    <h1 class="h3 mb-4 fw-normal">Регистрация</h1>

    <form action="/sing_up" method="post">
        @csrf
        <div class="form-floating">
            <input type="text" class="form-control top_input"
                   name="firstname" id="firstname"
                   placeholder="Name" value="{{ old('firstname') }}"
                   required>
            <label for="firstname">Имя</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control center_input"
                   name="lastname" id="lastname"
                   placeholder="Second Name" value="{{ old('lastname') }}"
                   required>
            <label for="lastname">Фамилия</label>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
                   id="email" name="email" placeholder="name@example.com"
                   value="@if (!$errors->has('email')) {{ old('email') }} @endif"
                   required>
            <label for="email">Email</label>
            <div class="invalid-feedback text-start">
                На данный email уже зарегистрирован аккаунт
            </div>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
                   name="password" id="password" placeholder="Password" required>
            <label for="password">Пароль</label>

            <div class="invalid-feedback text-start mb-1">
                Пароль должен состоять не менее чем из 4 символов и содержать как минимум одну заглавную букву и одну цифру.
            </div>
        </div>

        <div class="form-floating">
            <select class="form-select" id="role" name="role">
                <option value="ordinary" selected>Обычный</option>
                <option value="instructor">Инструктор</option>
            </select>
            <label for="role">Выбирете роль</label>
        </div>

        <button class="w-100 btn btn-primary btn-lg mt-3 mb-2" type="submit">Зарегистрироваться</button>
    </form>

    <a class="link-secondary" href="/sing_in">Вход</a>
</main>

</body>
</html>

