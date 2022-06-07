@php $editing = isset($cliente) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-4">
        <x-inputs.text
            name="nome"
            label="Nome"
            value="{{ old('nome', ($editing ? $cliente->nome : '')) }}"
            maxlength="255"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-4">
        <x-inputs.number
            name="cpf"
            label="CPF"
            step="1"
            value="{{ old('cpf', ($editing ? $cliente->cpf : '')) }}"
            maxlength="11"
            placeholder="CPF"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-4">
        <x-inputs.email
            name="email"
            label="EMAIL"
            value="{{ old('email', ($editing ? $cliente->email : '')) }}"
            maxlength="255"
            placeholder="EMAIL"
        ></x-inputs.email>
    </x-inputs.group>
</div>
