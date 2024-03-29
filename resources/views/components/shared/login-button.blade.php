@if ($user == null)
    <a class="btn btn-primary btn-rounded me-2" href="/sing_in">Войти</a>
    <a class="btn btn-outline-primary btn-rounded" href="/sing_up">Регистрация</a>
@else

    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle btn-rounded" data-bs-toggle="dropdown"
                data-bs-display="static" aria-expanded="false">
            {{ $user->fullName() }}
        </button>
        <ul class="dropdown-menu dropdown-menu-lg-end">
            <li>
                <a class="dropdown-item"
                   href="/user">
                    <img class="me-1" width="16" height="16" src="/assets/icons/person-circle.svg"
                         alt="">
                    Профиль
                </a>
            </li>

            @if($user->role == 'instructor')
                <li>
                    <a class="dropdown-item" href="/groups">
                        <img class="me-1" width="16" height="16" src="/assets/icons/map.svg" alt="">
                        Мои группы
                    </a>
                </li>
            @else
                <li>
                    <a class="dropdown-item" href="/orders">
                        <img class="me-1" width="16" height="16" src="/assets/icons/basket2.svg" alt="">
                        Мои экскурсии
                    </a>
                </li>
            @endif

            <li>
                <a class="dropdown-item" href="/logout">
                    <img class="me-1" width="16" height="16" src="/assets/icons/arrow-bar-left.svg"
                         alt="">
                    Выйти
                </a>
            </li>

        </ul>
    </div>

@endif
