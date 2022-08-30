<div class="album px-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach($excursions as $excursion)
            <div class="col">

                <div class="card shadow-sm">
                    <img alt="" src="{{ $excursion->photo }}" height="250" style="object-fit: cover"/>

                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <a href="/excursion/{{ $excursion->id }}" class="text"><b>{{ $excursion->title }}</b></a>
                            @if($excursion->rating > 0)
                                <x-places.rating rating="{{ $excursion->rating }}"></x-places.rating>
                            @endif
                        </div>
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
                            <p class="blockquote">{{ $excursion->price }} руб.</p>
                            <small class="text-muted">{{ $excursion->getDuration() }}</small>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
