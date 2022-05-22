@if (count($excursions) > 0)
    <div class="excursion">
        <img class="excursion-image" alt="" src="{{ $excursions[0]->photos['0'] ?? '' }}"/>
        <div class="container">
            <div class="excursion-body text-start">
                <h1>{{ $excursions[0]->title }}
                    @if ($excursions[0]->rating != 0)
                        <span class="position-absolute top-0 start-100
                                        translate-middle badge rounded-pill bg-danger">★{{ $excursions[0]->rating }}</span>
                    @endif
                </h1>
                <p class="excursion-description d-none d-sm-block mb-2 lead">
                    @if (strlen($excursions[0]->description) < 150)
                        {{ $excursions[0]->description }}
                    @else
                        {{ mb_substr($excursions[0]->description, 0, 150) }} ...
                    @endif
                </p>
                <div class="d-flex justify-content-between align-items-baseline pe-3">
                    <div class="btn-group">
                        <a class="btn btn-lg btn-primary mt-1" href="#">Подробнее</a>
                    </div>
                    <p class="text-muted lead d-none d-lg-block mb-0">Ближайшая
                        дата: {{ $excursions[0]->dates[0]->format('d.m h:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
