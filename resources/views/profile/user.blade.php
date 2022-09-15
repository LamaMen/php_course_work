<x-layout title="{{  $user->fullname() }}">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-5">Профиль пользователя</h1>

            @if(session()->get('user')->id == $user->id)
                <a class="btn" href="/user/edit/{{ $user->id }}">
                    <img width="36" height="36" src="/assets/icons/pencil-square.svg" alt="">
                </a>
            @endif
        </div>


        <div class="row">
            <div class="col-2">
                <img
                    style="height: 150px; width: 100%; object-fit: contain"
                    src="{{ $user->photo }}" alt=""
                >
            </div>
            <div class="col-10">
                <div class="row py-2">
                    <div class="col-3 lead parameter-name">Фамилия:</div>
                    <div class="col-9 lead">{{ $user->lastname }}</div>
                </div>

                <div class="row py-2">
                    <div class="col-3 lead parameter-name">Имя:</div>
                    <div class="col-9 lead">{{ $user->firstname }}</div>
                </div>

                <div class="row py-2">
                    <div class="col-3 lead parameter-name">Почта:</div>
                    <div class="col-9 lead">{{ $user->email }}</div>
                </div>
            </div>
        </div>


        <h1>Я поситил</h1>
        <div class="pt-3">
            @include('excursions.list.list', ['excursions' => $excursions])
        </div>
    </div>
</x-layout>
