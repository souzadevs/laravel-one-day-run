@php $editing = isset($compraPedidoItem) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="quantidade"
            label="Quantidade"
            value="{{ old('quantidade', ($editing ? $compraPedidoItem->quantidade : '')) }}"
            placeholder="Quantidade"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="produto_id" label="Produto" required>
            @php $selected = old('produto_id', ($editing ? $compraPedidoItem->produto_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Produto</option>
            @foreach($produtos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="compra_pedido_id" label="Compra Pedido" required>
            @php $selected = old('compra_pedido_id', ($editing ? $compraPedidoItem->compra_pedido_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Compra Pedido</option>
            @foreach($compraPedidos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
