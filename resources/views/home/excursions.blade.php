<div id="myCarousel" class="excursion slide" data-bs-ride="carousel">
    @if (count($places) > 1)
        <div class="carousel-indicators">
            @for ($i = 0; $i < count($places); $i++)
                <button type="button" data-bs-target="#myCarousel"
                        @if ($i == 1) class="active" @endif
                        data-bs-slide-to="{{ $i }}"
                        aria-label="Slide {{ $i }}"></button>
            @endfor
        </div>
    @endif

    <div class="carousel-inner">
        @for ($i = 0; $i < count($places); $i++)
            <div class="carousel-item @if ($i == 0) active @endif">
                <img alt="" src="{{ $places[$i]->photos['0'] ?? '' }}"/>

                <div class="container">
                    <div class="carousel-caption text-start col-lg-4 col-8">
                        <h1>{{ $places[$i]->title }}
                            @if ($places[$i]->rating != 0)
                                <span class="position-absolute top-0 start-100
                                    translate-middle badge rounded-pill bg-danger">★{{ $places[$i]->rating }}</span>
                            @endif
                        </h1>
                        <p class="d-none d-sm-block mb-1">{{ mb_substr($places[$i]->description, 0, 150) }} ...</p>
                        <p class="e-date">Когда: {{ $places[$i]->dateTime->format('d.m h:i') }}</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Подробнее</a></p>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    @if (count($places) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
