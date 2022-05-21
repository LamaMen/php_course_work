<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
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
            <ul class="navbar-nav me-auto mb-2 mb-md-0"></ul>

            @if (!session()->has('user'))
                <a class="btn btn-primary btn-rounded me-2" href="/sing_in">Войти</a>
                <a class="btn btn-outline-primary btn-rounded" href="/sing_up">Регистрация</a>
            @else
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-rounded" type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        {{ session()->get('user')->fullName() }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
