<x-layout title="Мои места">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-5">Мои экскурсии</h1>

            @if( count($excursions) > 0)
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img width="36" height="36" src="/assets/icons/plus-circle.svg" alt="">
                </button>
            @endif

        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="/groups/create">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Создание группы</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row lead py-1">
                                <div class="col">
                                    <label for="capacity">Количество участников</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="capacity" id="capacity" min="1"
                                           step="1"
                                           value="10" required>
                                </div>
                            </div>

                            <div class="row lead py-1">
                                <div class="col">
                                    <label for="dateTime">Дата</label>
                                </div>
                                <div class="col">
                                    <input type="datetime-local" class="form-control" name="dateTime" id="dateTime"
                                           required>
                                </div>
                            </div>

                            <div class="row lead py-1">
                                <label for="excursion" class="form-label col">Экскурсия</label>
                                <select class="form-select col" id="excursion" name="excursion">

                                    @foreach($excursions as $excursion)
                                        <option value="{{ $excursion->excursion->id }}">
                                            {{ $excursion->excursion->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach($excursions as $excursion)

            <div class="card mb-3" style="height: 300px; overflow: hidden">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $excursion->excursion->photo }}" class="img-fluid rounded-start"
                             style="object-fit: cover" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="height: 300px">
                            <div class="d-flex flex-column justify-content-between align-items-start h-100">
                                <a href="/excursion/{{ $excursion->excursion->id }}"
                                   class="card-title h4">{{ $excursion->excursion->title }}</a>

                                <button type="button"
                                        class="btn btn-primary  @if(count($excursion->groups) == 0) disabled @endif"
                                        data-bs-toggle="modal"
                                        data-bs-target="#excursionGroup{{ $excursion->excursion->id }}">
                                    Посмотреть группы
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if( count($excursion->groups) > 0)
                <div class="modal fade" id="excursionGroup{{ $excursion->excursion->id }}"
                     data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="excursionGroupLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content px-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="excursionGroupLabel">Доступные группы</h5>
                            </div>


                            <table class="table table-bordered">
                                <tr>
                                    <th>Вместительность</th>
                                    <th>Дата</th>
                                    <th>Время</th>
                                </tr>

                                @foreach($excursion->groups as $group)
                                    <tr>
                                        <td>{{ $group->engaged}}
                                            / {{ $group->capacity }}</td>
                                        <td>{{ $group->date() }}</td>
                                        <td>{{ $group->time() }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Закрыть
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-layout>
