<div class="container places">

    <x-shared.divider>5</x-shared.divider>
    @for ($i = 0; $i < count($places); $i++)
        <div class="row feature">
            <div class="col-md-7 @if ($i % 2 == 1) order-md-2 @endif">
                <h2 class="place-heading">{{ $places[$i]->title }}
                    @if ($places[$i]->rating != 0)
                        <x-places.rating class="place-rating" rating="{{ $places[$i]->rating }}"></x-places.rating>
                    @endif
                </h2>
                <p class="lead">{{ $places[$i]->description }} </p>
                <p><a class="btn btn-lg btn-primary" href="/showplace/{{ $places[$i]->id }}">Подробнее</a></p>
            </div>
            <div class="col-md-5 @if ($i % 2 == 1) order-md-1 @endif">
                <img class="feature-image img-fluid place-image" alt="" src="{{ $places[$i]->photo }}"/>
            </div>
        </div>

        @if ($i != count($places) - 1)
            <x-shared.divider>5</x-shared.divider>
        @endif
    @endfor

</div>
