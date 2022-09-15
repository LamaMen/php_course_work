<x-layout title="Заказы">

    <div class="container">
        <h1 class="my-5">Мои заказы</h1>
    </div>


    <div class="album px-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach($excursions as $excursion)
                <div class="col">

                    <div class="card shadow-sm">
                        <img alt="" src="{{ $excursion->excursion->photo }}" height="250" style="object-fit: cover"/>

                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <a href="/excursion/{{ $excursion->excursion->id }}"
                                   class="text"><b>{{ $excursion->excursion->title }}</b></a>
                                @if($excursion->excursion->rating > 0)
                                    <x-places.rating rating="{{ $excursion->excursion->rating }}"></x-places.rating>
                                @endif
                            </div>
                            <div style="min-height: 130px;">
                                <p class="card-text">
                                    @if (strlen($excursion->excursion->description) < 150)
                                        {{ $excursion->excursion->description}}
                                    @else
                                        {{ mb_substr($excursion->excursion->description, 0, 150) }} ...
                                    @endif
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="blockquote">{{ $excursion->date() }}</p>
                                <small class="text-muted">{{ $excursion->excursion->getDuration() }}</small>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-layout>
