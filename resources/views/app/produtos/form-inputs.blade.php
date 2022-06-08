@php $editing = isset($produto) @endphp

<div class="row">
    

    <x-inputs.group class="col-sm-12 col-md-3">
        <x-inputs.number
            name="codigo_barras"
            label="Codigo Barras"
            value="{{ old('codigo_barras', ($editing ? $produto->codigo_barras : '')) }}"
            maxlength="20"
            step="1"
            placeholder="Codigo Barras"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-9">
        <x-inputs.text
            name="nome"
            label="Nome"
            value="{{ old('nome', ($editing ? $produto->nome : '')) }}"
            maxlength="100"
            placeholder="Nome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-3">
        <x-inputs.number
            name="valor_unitario"
            label="Valor Unitario"
            value="{{ old('valor_unitario', ($editing ? $produto->valor_unitario : '')) }}"
            max="1000000"
            step="0.01"
            placeholder="Valor Unitario"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
