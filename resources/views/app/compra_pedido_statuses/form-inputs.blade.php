@php $editing = isset($compraPedidoStatus) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="descricao"
            label="Descricao"
            value="{{ old('descricao', ($editing ? $compraPedidoStatus->descricao : '')) }}"
            maxlength="255"
            placeholder="Descricao"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="cor_fundo_hex"
            label="Cor Fundo Hex"
            value="{{ old('cor_fundo_hex', ($editing ? $compraPedidoStatus->cor_fundo_hex : '')) }}"
            maxlength="255"
            placeholder="Cor Fundo Hex"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="cor_texto_hex"
            label="Cor Texto Hex"
            value="{{ old('cor_texto_hex', ($editing ? $compraPedidoStatus->cor_texto_hex : '')) }}"
            maxlength="255"
            placeholder="Cor Texto Hex"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
