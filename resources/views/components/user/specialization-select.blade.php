<div>
    <label for="specialization" class="form-label">Выбирете специализацию</label>
    <select class="form-select" id="specialization" name="specialization">
        @for ($i = 0; $i < count($specializations); $i++)
            <option
                value="{{ $specializations[$i]->id }}"
                @if ($specializations[$i]->id == $specializationId) selected @endif
            >
                {{ $specializations[$i]->name }}
            </option>
        @endfor

        <option
            value="-1"
            @if ($specializationId == -1) selected @endif
        >
            Не указывать
        </option>
    </select>
</div>
