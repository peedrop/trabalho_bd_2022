@php $editing = isset($departamento) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $departamento->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="area"
            label="Area"
            :value="old('area', ($editing ? $departamento->area : ''))"
            maxlength="255"
            placeholder="Area"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
