<div>
    <h1 class="display-4 fw-bold py-3">Доступные инструкторы</h1>

    @foreach($instructors as $instructor)
        <x-shared.divider></x-shared.divider>

        <div class="d-flex align-items-center">
            <div class="py-2 px-3">
                <img src="{{ $instructor->photo }}" class="img-fluid rounded-start" alt="..."
                     style="height: 60px; width: 60px; object-fit: cover">
            </div>
            <div>
                <a href="/user/{{ $instructor->id }}" class="lead">{{ $instructor->fullName() }}</a>
                <small class="text-muted">
                    <x-user.specialization-view
                        id="{{ $instructor->specializationId }}"></x-user.specialization-view>
                </small>
            </div>
        </div>

    @endforeach

    <x-shared.divider></x-shared.divider>
</div>
