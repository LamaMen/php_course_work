<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand" href="#">
            <img class="me-3" src="{{ asset('assets/brand/logo.png') }}" alt="" width="35">
            GreatLuking
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @for ($i = 0; $i < count($routes); $i++)
                    <li class="nav-item">
                        <a class="nav-link @if($current == $i) active @endif" aria-current="page"
                           href="{{ $routes[$i]['url'] }}">{{ $routes[$i]['name'] }}
                        </a>
                    </li>
                @endfor
            </ul>
            <x-shared.login-button></x-shared.login-button>
        </div>
    </div>
</nav>
