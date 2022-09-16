<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ $title }}</title>

    <link href="/css/admin/dashboard.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="height: 48px;">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">GreatLuking</a>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="/logout">Выйти</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    @for ($i = 0; $i < count($routes); $i++)
                        <li class="nav-item">
                            <a class="nav-link @if($current == $i) active @endif" aria-current="page"
                               href="{{ $routes[$i]['url'] }}">
                                <span data-feather="{{ $routes[$i]['icon'] }}"></span>
                                {{ $routes[$i]['title'] }}
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $title }}</h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    {{ $buttons ?? '' }}
                </div>
            </div>

            {{ $slot }}
        </main>
    </div>
</div>


<script src="/js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>

<script>
    (function () {
        'use strict'
        feather.replace({'aria-hidden': 'true'})
    })()
</script>

{{ $scripts ?? '' }}

</body>
</html>
