<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>{{ $title }}</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shared/navbar.css') }}" rel="stylesheet">
    {{ $styles ?? '' }}

</head>
<body>

<header>
    <x-shared.navbar current="{{ $pageIndex }}"></x-shared.navbar>
</header>

<main>
    <div class="mt-5">
        {{ $slot }}
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; 2022 GreatLuking</p>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
