<nav class="mt-4" aria-label="pages">
    <ul class="pagination">
        <li class="page-item @if($actual == 1) disabled @endif">
            <a class="page-link" href="/excursions/{{ $actual - 1 }}" tabindex="-1">Назад</a>
        </li>

        @for ($i = 1; $i <= $count; $i++)
            <li class="page-item @if($actual == $i) active @endif">
                <a class="page-link" href="/excursions/{{ $i }}">{{ $i }}</a>
            </li>
        @endfor

        <li class="page-item @if($actual == $count) disabled @endif">
            <a class="page-link" href="/excursions/{{ $actual + 1 }}">Вперед</a>
        </li>
    </ul>
</nav>
