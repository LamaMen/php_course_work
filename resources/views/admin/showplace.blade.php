<x-admin.layout current="2" title="{{ $method }} достопримечательности">
    <form action="/admin/showplace/save" method="post" enctype="multipart/form-data">
        @csrf
        <input value="{{ $showplace->id }}" name="id" type="hidden">
        <input value="{{ $showplace->placeId }}" name="place_id" type="hidden">

        <div class="row g-3 pb-3">
            <div>
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" value="{{ $showplace->title }}"
                       name="title" required>
            </div>

            <div>
                <label for="description">Описание</label>
                <textarea name="description" id="description" class="form-control"
                          required>{{ $showplace->description }}</textarea>
            </div>

            <div>
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" value="{{ $showplace->address }}"
                       name="address" required>
            </div>

            <div>
                <label for="photo" class="form-label">Выберете фотографию</label>
                <input class="form-control" type="file" id="photo" name="photo">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>

</x-admin.layout>
