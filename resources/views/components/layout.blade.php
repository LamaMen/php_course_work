<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>{{ $title }}</title>

    <link href="/css/styles.css" rel="stylesheet">
    <link href="/css/shared/layout.css" rel="stylesheet">
    {{ $styles ?? '' }}

</head>
<body>

<header>
    <x-shared.navbar current="{{ $pageIndex }}"></x-shared.navbar>
</header>

<main>
    {{ $slot }}
</main>

<footer class="footer mt-auto text-center">
    <div class="container">
        <hr class="footer-divider">
        <p>&copy; 2022 GreatLuking</p>
    </div>
</footer>

<script src="/js/app.js"></script>

</body>
</html>
