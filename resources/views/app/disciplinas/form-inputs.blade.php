@php $editing = isset($disciplina) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="curso_id" label="Curso" required>
            @php $selected = old('curso_id', ($editing ? $disciplina->curso_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Curso</option>
            @foreach($cursos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="departamento_id" label="Departamento" required>
            @php $selected = old('departamento_id', ($editing ? $disciplina->departamento_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Departamento</option>
            @foreach($departamentos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $disciplina->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="codigo"
            label="Codigo"
            :value="old('codigo', ($editing ? $disciplina->codigo : ''))"
            maxlength="255"
            placeholder="Codigo"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
