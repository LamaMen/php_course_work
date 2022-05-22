@if ($user == null)
    <a class="btn btn-primary btn-rounded me-2" href="/sing_in">Войти</a>
    <a class="btn btn-outline-primary btn-rounded" href="/sing_up">Регистрация</a>
@else
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle btn-rounded" type="button"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
            {{ $user->fullName() }}
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
                <a class="dropdown-item" href="#">
                    <img class="me-1" width="16" height="16" src="{{ asset('assets/icons/basket2.svg') }}" alt="">
                    Корзина
                    <span class="badge rounded-pill bg-danger shopping-card-badge">+1</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="/logout">
                    <img class="me-1" width="16" height="16" src="{{ asset('assets/icons/arrow-bar-left.svg') }}" alt="">
                    Logout
                </a>
            </li>
        </ul>

    </div>
@endif
