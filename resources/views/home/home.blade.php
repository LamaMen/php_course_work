<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>Главная</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/excursion.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/place.css') }}" rel="stylesheet">

</head>
<body>

<header>
    @include('shared.navbar')
</header>

<main>
    @include('home.excursions', ['places' => $excursions])
    @include('home.places', ['places' => $places])
</main>

<footer class="footer">
    @include('shared.footer')
</footer>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
