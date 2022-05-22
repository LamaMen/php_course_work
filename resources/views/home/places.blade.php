<div class="container places">

    <hr class="places-divider">
    @for ($i = 0; $i < count($places); $i++)
        <div class="row feature">
            <div class="col-md-7 @if ($i % 2 == 1) order-md-2 @endif">
                <h2 class="place-heading">{{ $places[$i]->title }}
                    @if ($places[$i]->rating != 0)
                        <span class="badge rounded-pill bg-danger place-rating">★{{ $places[$i]->rating }}</span>
                    @endif
                </h2>
                <p class="lead">{{ $places[$i]->description }} </p>
                <p><a class="btn btn-lg btn-primary" href="#">Подробнее</a></p>
            </div>
            <div class="col-md-5 @if ($i % 2 == 1) order-md-1 @endif">
                <img class="feature-image img-fluid place-image" alt="" src="{{ $places[$i]->photos['0'] ?? '' }}"/>
            </div>
        </div>
        <hr class="@if ($i == count($places) - 1) places-divider-last @else places-divider @endif">
    @endfor

</div>
