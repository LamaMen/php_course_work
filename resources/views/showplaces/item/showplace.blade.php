<x-layout pageIndex="1" title="{{ $showplace->title }}">
    <x-slot name="styles">
        <link href="{{ asset('css/place/place.css') }}" rel="stylesheet">
    </x-slot>

    <div class="container">
        <h1 class="display-4 fw-bold py-3">{{ $showplace->title}}</h1>

        <div class="row">
            <div class="col-8">
                <img class="feature-image img-fluid photo-image" alt="" src="{{ $showplace->photo }}"/>
            </div>


            <div class="col-4">
                @if ($showplace->rating != 0)
                    <div class="row py-3">
                        <div class="col lead parameter-name">Рейтинг:</div>
                        <div class="col lead">
                            <x-places.rating rating="{{ $showplace->rating }}"></x-places.rating>
                        </div>
                    </div>
                @endif
                <div class="row py-3">
                    <div class="col lead parameter-name">Автор:</div>
                    <a class="col lead" href="/user/{{ $showplace->owner->id ?? -1}}">
                        {{ $showplace->owner->fullName() ?? 'Неизвестен' }}
                    </a>
                </div>
                <div class="row py-3">
                    <div class="col lead parameter-name">Адрес:</div>
                    <div class="col lead">{{ $showplace->address }}</div>
                </div>
            </div>
        </div>

        <p class="lead pt-4">
            {{ $showplace->description }}
        </p>


        <x-places.comments-list placeId="{{ $showplace->placeId }}"></x-places.comments-list>
    </div>
</x-layout>
