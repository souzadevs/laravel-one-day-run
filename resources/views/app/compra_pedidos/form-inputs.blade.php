@php $editing = isset($compraPedido) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-3">
        <x-inputs.datetime name="pedido_at" label="Data" value="{{ old('pedido_at', ($editing ? optional($compraPedido->pedido_at)->format('Y-m-d\TH:i:s') : now()->format('Y-m-d\TH:i:s'))) }}" max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-6">
        <x-inputs.select name="cliente_id" label="Cliente" required>
            @php $selected = old('cliente_id', ($editing ? $compraPedido->cliente_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Cliente</option>
            @foreach($clientes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-3">
        <x-inputs.select name="compra_pedido_status_id" label="Status" required>
            @php $selected = old('compra_pedido_status_id', ($editing ? $compraPedido->compra_pedido_status_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Compra Pedido Status</option>
            @foreach($compraPedidoStatuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>