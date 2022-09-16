<x-admin.layout current="2" title="{{ $method }} экскурсии">

    <form action="/admin/excursion/save" method="post" enctype="multipart/form-data">
        @csrf
        <input value="{{ $excursion->id }}" name="id" type="hidden">
        <input value="{{ $excursion->placeId }}" name="place_id" type="hidden">

        <div class="row g-3 pb-3">
            <div>
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" value="{{ $excursion->title }}"
                       name="title" required>
            </div>

            <div>
                <label for="description">Описание</label>
                <textarea name="description" id="description" class="form-control"
                          required>{{ $excursion->description }}</textarea>
            </div>

            <div>
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" value="{{ $excursion->address }}"
                       name="address" required>
            </div>

            <div>
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" value="{{ $excursion->price }}"
                       name="price" min="1" step="1" required>
            </div>

            <div>
                <label for="duration" class="form-label">Длительность</label>
                <input type="time" class="form-control" id="duration" name="duration"
                       value="{{ $excursion->duration() }}"
                       required>
            </div>


            <div>
                <label for="photo" class="form-label">Выберете фотографию</label>
                <input class="form-control" type="file" id="photo" name="photo">
            </div>

            <x-admin.instructors-select place="{{ $excursion->id }}"></x-admin.instructors-select>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>


</x-admin.layout>
