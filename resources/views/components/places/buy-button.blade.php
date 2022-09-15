<div>
    @if(session()->get('user')->role == 'ordinary')
        <button type="button" class="btn btn-primary w-100 btn-lg"
                data-bs-toggle="modal"
                data-bs-target="#buyModal">
            Купить
        </button>
    @endif

    <div class="modal fade" id="buyModal"
         data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="excursionGroupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="/orders/create" method="post">
                @csrf
                <div class="modal-content px-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="excursionGroupLabel">Доступные группы</h5>
                    </div>

                    @if(count($groups) > 0)
                        <table class="table table-bordered">
                            <tr>
                                <th></th>
                                <th>Инструктор</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Свободных мест</th>
                            </tr>

                            @foreach($groups as $group)
                                <tr>
                                    <td><input class="form-check-input"
                                               type="radio"
                                               name="groupId"
                                               value="{{ $group->group->id }}"
                                               id="group{{ $group->group->id }}" required>
                                    </td>

                                    <td>
                                        <label class="form-check-label" for="group{{ $group->group->id }}">
                                            {{ $group->instructor->fullName()}}
                                        </label>
                                    </td>

                                    <td>{{ $group->group->capacity()}}</td>
                                    <td>{{ $group->group->date() }}</td>
                                    <td>{{ $group->group->time() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="danger lead my-2">Нет групп для этой экскурсии</div>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Закрыть
                        </button>
                        @if(count($groups) > 0)
                            <button type="submit" class="btn btn-success">
                                Заказать
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
