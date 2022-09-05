<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ilia Rodionov">
    <title>{{ $title }}</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shared/layout.css') }}" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center">

<div class="d-flex w-100 mx-auto flex-column justify-content-between">
    <header>
        <x-shared.navbar current="{{ $page }}"></x-shared.navbar>
    </header>

    <main>{{ $slot }}</main>

    <footer class="footer ">
        <div class="container">
            <hr class="footer-divider">
            <p>&copy; 2022 GreatLuking</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</div>

</body>
</html>
