<x-admin.layout current="2">
    <x-slot name="buttons">
        <div class="btn-group me-2">
            <a class="btn btn-sm btn-outline-primary" href="/admin/create/excursion">Создать экскурсию</a>
            <a class="btn btn-sm btn-outline-primary" href="/admin/create/showplace">Создать достопримечательность</a>
        </div>
    </x-slot>

    <table class="table table-bordered w-75">
        <tr>
            <th>Название</th>
            <th>Тип</th>
            <th></th>
        </tr>

        @foreach($places as $place)
            <tr>
                <td>{{ $place->title }}</td>
                <td>
                    @if($place->isExcursion)
                        Экскурсия
                    @else
                        Достопримечательность
                    @endif
                </td>
                <td class="text-center">
                    <a class="btn btn-sm btn-outline-primary" href="/admin/edit/{{ $place->id }}">Редактировать</a>
                </td>
            </tr>
        @endforeach
    </table>
</x-admin.layout>
