<x-layout title="Редактирование инструктора">
    <x-slot name="styles">
        <link href="{{ asset('css/place/place.css') }}" rel="stylesheet">
    </x-slot>

    <div class="container">
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3 pt-5">Редактирование данных</h4>
                <form action="/user/edit/apply" method="post" enctype="multipart/form-data">
                    @csrf

                    <input value="{{ $user->id }}" name="id" type="hidden">
                    <input value="{{ $user->role }}" name="role" type="hidden">

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstname" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="firstname" value="{{ $user->firstname }}"
                                   name="firstname" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   value="{{ $user->lastname }}" required>
                        </div>

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $user->email }}" required>
                        </div>

                        <div>
                            <label for="password" class="form-label">Пароль</label>
                            <input type="text" class="form-control" id="password" name="password"
                                   value="{{ $user->password }}" required>
                        </div>

                        <div>
                            <label for="photo" class="form-label">Выберете фотографию</label>
                            <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
