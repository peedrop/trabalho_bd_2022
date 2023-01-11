@php $editing = isset($aluno) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nome"
            label="Nome"
            :value="old('nome', ($editing ? $aluno->nome : ''))"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $aluno->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="data_nascimento"
            label="Data Nascimento"
            value="{{ old('data_nascimento', ($editing ? optional($aluno->data_nascimento)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cpf"
            label="Cpf"
            :value="old('cpf', ($editing ? $aluno->cpf : ''))"
            maxlength="11"
            placeholder="Cpf"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
