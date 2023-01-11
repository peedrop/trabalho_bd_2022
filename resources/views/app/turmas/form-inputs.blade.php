@php $editing = isset($turma) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="disciplina_id" label="Disciplina" required>
            @php $selected = old('disciplina_id', ($editing ? $turma->disciplina_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Disciplina</option>
            @foreach($disciplinas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="professor_id" label="Professor" required>
            @php $selected = old('professor_id', ($editing ? $turma->professor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Professor</option>
            @foreach($professors as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="codigo"
            label="Codigo"
            :value="old('codigo', ($editing ? $turma->codigo : ''))"
            maxlength="255"
            placeholder="Codigo"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
