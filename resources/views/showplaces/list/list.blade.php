<div class="album px-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach($showplaces as $showplace)
            <div class="col">
                <div class="card shadow">
                    <img alt="" src="{{ $showplace->photo }}" height="250" style="object-fit: cover"/>

                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <a href="/showplace/{{ $showplace->id }}" class="text"><b>{{ $showplace->title }}</b></a>
                            @if($showplace->rating > 0)
                                <x-places.rating rating="{{ $showplace->rating }}"></x-places.rating>
                            @endif
                        </div>
                        <div style="height: 130px;">
                            <p class="card-text">
                                @if (strlen($showplace->description) < 180)
                                    {{ $showplace->description}}
                                @else
                                    {{ mb_substr($showplace->description, 0, 180) }} ...
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
