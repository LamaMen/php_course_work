<x-layout title="{{ $instructor->fullname() }}">
    <x-slot name="styles">
        <link href="{{ asset('css/place/place.css') }}" rel="stylesheet">
    </x-slot>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-5">Профиль инструктора</h1>

            @if(session()->get('user')->id == $instructor->id)
                <a class="btn" href="/user/edit/{{ $instructor->id }}">
                    <img width="36" height="36" src="{{ asset('assets/icons/pencil-square.svg') }}" alt="">
                </a>
            @endif
        </div>

        <div class="row">
            <div class="col-3">
                <img
                    style="height: 310px; width: 100%; object-fit: contain"
                    src="{{ $instructor->photo }}"
                    alt=""
                >
            </div>
            <div class="col-9">
                <div class="row py-3">
                    <div class="col-3 lead parameter-name">Фамилия:</div>
                    <div class="col-9 lead">{{ $instructor->lastname }}</div>
                </div>

                <div class="row py-3">
                    <div class="col-3 lead parameter-name">Имя:</div>
                    <div class="col-9 lead">{{ $instructor->firstname }}</div>
                </div>

                <div class="row py-3">
                    <div class="col-3 lead parameter-name">Отчество:</div>
                    <div class="col-9 lead">{{ $instructor->surname }}</div>
                </div>
                <div class="row py-3">
                    <div class="col-3 lead parameter-name">Почта:</div>
                    <div class="col-9 lead">{{ $instructor->email }}</div>
                </div>
                <div class="row py-3">
                    <div class="col-3 lead parameter-name">Специализация:</div>
                    <div class="col-9 lead">
                        @if($instructor->specializationId != null)
                            <x-user.specialization-view id="{{ $instructor->specializationId }}"></x-user.specialization-view>
                        @else
                            Не указана
                        @endif

                    </div>
                </div>
            </div>
        </div>


        <h1>Мои предложения</h1>
    </div>
</x-layout>
