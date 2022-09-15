<x-layout title="Редактирование инструктора">
    <x-slot name="styles">
        <link href="/css/place/place.css}" rel="stylesheet">
    </x-slot>

    <div class="container">
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3 pt-5">Редактирование данных</h4>
                <form action="/user/edit/apply" method="post" enctype="multipart/form-data">
                    @csrf

                    <input value="{{ $instructor->id }}" name="id" type="hidden">
                    <input value="{{ $instructor->instructorId }}" name="instructor_id" type="hidden">
                    <input value="{{ $instructor->role }}" name="role" type="hidden">

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstname" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="firstname" value="{{ $instructor->firstname }}"
                                   name="firstname" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   value="{{ $instructor->lastname }}" required>
                        </div>

                        <div>
                            <label for="surname" class="form-label">Отчество</label>
                            <input type="text" class="form-control" id="surname" name="surname"
                                   value="{{ $instructor->surname }}" required>
                        </div>

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $instructor->email }}" required>
                        </div>

                        <div>
                            <label for="password" class="form-label">Пароль</label>
                            <input type="text" class="form-control" id="password" name="password"
                                   value="{{ $instructor->password }}" required>
                        </div>

                        <div>
                            <label for="photo" class="form-label">Выберете фотографию</label>
                            <input class="form-control" type="file" id="photo" name="photo">
                        </div>

                        <x-user.specialization-select specialization-id="{{ $instructor->specializationId ?? -1 }}">
                        </x-user.specialization-select>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
