@php $editing = isset($equipamento) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $equipamento->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="sala_id" label="Sala" required>
            @php $selected = old('sala_id', ($editing ? $equipamento->sala_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sala</option>
            @foreach($salas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="num_serie"
            label="Num Serie"
            :value="old('num_serie', ($editing ? $equipamento->num_serie : ''))"
            maxlength="255"
            placeholder="Num Serie"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
