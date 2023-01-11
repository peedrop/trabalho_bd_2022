@php $editing = isset($faculdade) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $faculdade->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="endereco"
            label="Endereco"
            :value="old('endereco', ($editing ? $faculdade->endereco : ''))"
            maxlength="255"
            placeholder="Endereco"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
