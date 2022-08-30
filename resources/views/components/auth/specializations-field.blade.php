<div class="form-floating mt-3" id="specialization-field"
     style="display:@if (old('role') == 'instructor') block @else none @endif;"
>
    <select class="form-select" id="specialization" name="specialization">
        @for ($i = 0; $i < count($specializations); $i++)
            <option
                value="{{ $specializations[$i]->id }}"
                @if (old('specialization') == $specializations[$i]->id || $i == 0) selected @endif
            >
                {{ $specializations[$i]->name }}
            </option>
        @endfor
    </select>
    <label for="specialization">Выбирете специализацию</label>
</div>
