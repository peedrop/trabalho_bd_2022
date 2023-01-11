@php $editing = isset($reserva) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="data"
            label="Data"
            value="{{ old('data', ($editing ? optional($reserva->data)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="sala_id" label="Sala" required>
            @php $selected = old('sala_id', ($editing ? $reserva->sala_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sala</option>
            @foreach($salas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
