@php $editing = isset($professor) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="departamento_id" label="Departamento" required>
            @php $selected = old('departamento_id', ($editing ? $professor->departamento_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Departamento</option>
            @foreach($departamentos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $professor->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
