<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>Главная</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shared/navbar.css') }}" rel="stylesheet">

</head>
<body>

<header>
    <x-shared.navbar current="2"></x-shared.navbar>
</header>

<main>
    <h1 class="mt-5 display-1">Protected Screen Excursion</h1>

</main>

<footer class="footer">
    @include('shared.footer')
</footer>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
