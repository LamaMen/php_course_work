<div>
    <p>Выберете инструторов</p>

    @foreach($instructors as $instructor)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $instructor->instructorId }}"
                   id="flexCheckDefault" name="instructors[]"
                   @if(in_array($instructor->instructorId, $selectedInstructors)) checked @endif
            >
            <label class="form-check-label" for="flexCheckDefault">
                {{ $instructor->fullName() }}
            </label>
        </div>
    @endforeach
</div>
