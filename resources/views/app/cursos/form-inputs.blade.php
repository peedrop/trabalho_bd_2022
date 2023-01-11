@php $editing = isset($curso) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="faculdade_id" label="Faculdade" required>
            @php $selected = old('faculdade_id', ($editing ? $curso->faculdade_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Faculdade</option>
            @foreach($faculdades as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $curso->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
