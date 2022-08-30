<x-layout pageIndex="2" title="{{ $excursion->title }}">
    <x-slot name="styles">
        <link href="{{ asset('css/place/place.css') }}" rel="stylesheet">
    </x-slot>

    <div class="container">
        <h1 class="display-4 fw-bold py-3">{{ $excursion->title}}</h1>

        <div class="row">
            <div class="col-8">
                <img class="feature-image img-fluid photo-image" alt="" src="{{ $excursion->photo }}"/>
            </div>


            <div class="col-4">
                @if ($excursion->rating != 0)
                    <div class="row py-3">
                        <div class="col lead parameter-name">Рейтинг:</div>
                        <div class="col lead">
                            <x-places.rating rating="{{ $excursion->rating }}"></x-places.rating>
                        </div>
                    </div>
                @endif
                <div class="row py-3">
                    <div class="col lead parameter-name">Длительность:</div>
                    <div class="col lead">{{ $excursion->getDuration(true) }}</div>
                </div>
                <div class="row py-3">
                    <div class="col lead parameter-name">Автор:</div>
                    <div class="col lead">{{ $excursion->owner->fullName() ?? 'Неизвестен' }}</div>
                </div>
                <div class="row py-3">
                    <div class="col lead parameter-name">Адрес:</div>
                    <div class="col lead">{{ $excursion->address }}</div>
                </div>
                <div class="row py-3">
                    <div class="col h1">Цена</div>
                    <div class="col h1">{{ $excursion->price }}</div>
                </div>
            </div>
        </div>

        <p class="lead pt-4">
            {{ $excursion->description }}
        </p>


        <x-places.comments-list placeId="{{ $excursion->placeId }}"></x-places.comments-list>
    </div>
</x-layout>
