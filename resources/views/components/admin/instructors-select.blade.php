<div>
    <p>Выберете инструторов</p>

    @foreach($instructors as $instructor)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $instructor->instructorId }}"
                   id="inst{{ $instructor->instructorId }}" name="instructors[]"
                   @if(in_array($instructor->instructorId, $selectedInstructors)) checked @endif
            >
            <label class="form-check-label" for="inst{{ $instructor->instructorId }}">
                {{ $instructor->fullName() }}
            </label>
        </div>
    @endforeach
</div>
