<x-admin.layout current="1">
    <x-slot name="buttons">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#create">
            <span data-feather="plus"></span>
            Добавить
        </button>

        <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="createLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="/admin/specializations/create">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLabel">Создание специализации</h5>
                        </div>

                        <div class="modal-body">
                            <label for="name">Название</label>
                            <input type="text" class="form-control mt-1" name="name" id="name" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        <form action="/admin/specializations/delete" method="post">
            <table class="table table-bordered w-50">
                <tr>
                    <th></th>
                    <th>Название</th>
                </tr>

                @foreach($specializations as $specialization)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" id="inp{{ $specialization->id }}"
                                   name="specializations[]" value="{{ $specialization->id }}">
                        </td>
                        <td><label for="inp{{ $specialization->id }}">{{ $specialization->name }}</label></td>
                    </tr>
                @endforeach
            </table>

            <button type="submit" class="btn btn-outline-danger">
                <span data-feather="trash-2"></span>
                Удалить
            </button>
        </form>
    </div>

</x-admin.layout>
