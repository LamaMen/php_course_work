<div>
    <div class="row">
        <div class="col-8">
            <h1 class="display-4 fw-bold py-3">Отзывы</h1>
            @if(count($comments) == 0)
                <div class="lead">Отзывов пока нет.</div>
            @endif
            @foreach($comments as $comment)
                <x-shared.divider></x-shared.divider>
                <div class="d-flex lead">
                    <div class="me-2">{{ $comment->user->fullname() }}</div>
                    <div>
                        <x-places.rating rating="{{ $comment->rating }}" :isGeneral="false"></x-places.rating>
                    </div>
                </div>
                <p>{{ $comment->text }}</p>
            @endforeach
        </div>
        <div class="col-4">
            <h1 class="fw-bold py-3">Оставить отзыв</h1>
            <form action="/comments/create" method="post">
                @csrf
                <input type="hidden" name="place_id" value="{{ $placeId }}">

                <div class="row lead">
                    <div class="col">
                        <label for="rating">Рейтинг</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="rating" id="rating" min="1" max="5" step="1"
                               value="1" required>
                    </div>
                </div>

                <div class="lead">
                    <label for="comment" class="mb-1">Комментарий</label>
                    <textarea name="comment" id="comment" cols="40" rows="5" class="form-control" required></textarea>
                </div>

                <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</div>
