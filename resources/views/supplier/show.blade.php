@php
$items = [
['route'=> 'supplier.index', 'text' => 'Proveedores'],
['route'=> 'supplier.create', 'text' => 'Nuevo Proveedor'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver Proveedor</h2>
    <p>Ve los datos de un proveedor</p>
    <div class="view">
        <p class="view__item"><span>Código: </span>{{$supplier->id}}</p>
        <p class="view__item"><span>Nombre: </span>{{$supplier->name}}</p>
        <p class="view__item"><span>Email: </span>{{$supplier->email}}</p>
        <p class="view__item"><span>Teléfono: </span>{{$supplier->phone}}</p>
        <a class="view__edit" href="{{route('supplier.edit', $supplier)}}">Actualizar</a>
    </div>
    @if (count($supplier->orders)>0)
    <h2 class="view__subtitle">Pedidos hechos al proveedor</h2>
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Fecha</td>
            <td>Total</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($supplier->orders as $order)
        <tr class="dashboard__table__body">
            <td>{{$order->id}}</td>
            <td>{{$order->created_at->format('d/M/y')}}</td>
            <td>$ {{$order->total}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('order.show', $order)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>

    @else
    <h2 class="view__subtitle">Aún no hay pedidos de este proveedor</h2>
    @endif
</x-dashboard>