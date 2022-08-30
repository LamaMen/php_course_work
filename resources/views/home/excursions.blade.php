@if (count($excursions) > 0)
    <div class="excursion">
        <img class="excursion-image" alt="" src="{{ $excursions[0]->photo }}"/>
        <div class="container">
            <div class="excursion-body text-start">
                <h1>{{ $excursions[0]->title }}
                    @if ($excursions[0]->rating != 0)
                        <x-places.rating
                            class="position-absolute top-0 start-100 translate-middle"
                            rating="{{ $excursions[0]->rating }}">
                        </x-places.rating>
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
                        <a class="btn btn-lg btn-primary mt-1" href="/excursion/{{ $excursions[0]->id }}">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
