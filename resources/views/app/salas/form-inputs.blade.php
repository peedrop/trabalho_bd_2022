@php $editing = isset($sala) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="numero"
            label="Numero"
            :value="old('numero', ($editing ? $sala->numero : ''))"
            maxlength="255"
            placeholder="Numero"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
