<div class="album px-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach($model->excursions as $excursion)
            <div class="col">
                <div class="card shadow-sm">
                    @if(count($excursion->photos) > 0)
                        <img alt="" src="{{ $excursion->photos['0'] }}" height="250" style="object-fit: cover"/>
                    @endif

                    <div class="card-body">
                        <p class="card-title"><b>{{ $excursion->title }}</b></p>
                        <div style="height: 130px;">
                            <p class="card-text">
                                @if (strlen($excursion->description) < 150)
                                    {{ $excursion->description}}
                                @else
                                    {{ mb_substr($excursion->description, 0, 150) }} ...
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-primary" href="#">Подробнее</a>
                            </div>
                            <small class="text-muted">{{ $excursion->getDuration() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <nav class="mt-4" aria-label="pages">
        <ul class="pagination">
            <li class="page-item @if($model->currentPage == 1) disabled @endif">
                <a class="page-link" href="/excursions/{{ $model->currentPage - 1 }}" tabindex="-1">Назад</a>
            </li>

            @for ($i = 1; $i <= $model->maxPage; $i++)
                <li class="page-item @if($model->currentPage == $i) active @endif">
                    <a class="page-link" href="/excursions/{{ $i }}">{{ $i }}</a>
                </li>
            @endfor

            <li class="page-item @if($model->currentPage == $model->maxPage) disabled @endif">
                <a class="page-link" href="/excursions/{{ $model->currentPage + 1 }}">Вперед</a>
            </li>
        </ul>
    </nav>
</div>
