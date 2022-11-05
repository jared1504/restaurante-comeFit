@php
$items = [
['route'=> 'order.index', 'text' => 'Pedidos'],
['route'=> 'order.create', 'text' => 'Nuevo Pedido'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver Pedido</h2>
    <p>Ve los datos de un pedido</p>
    <div class="view">
        <p class="view__item"><span>Código: </span>{{$order->id}}</p>
        <p class="view__item"><span>Fecha: </span>{{$order->created_at->format('d/M/Y')}}</p>
        <p class="view__item"><span>Hora: </span>{{$order->created_at->format('h:m')}}</p>
        <p class="view__item"><span>Total: $</span>{{$order->total}}</p>
        <p class="view__item"><span>Proveedor: </span>{{$order->supplier->name}}</p>
        <p class="view__item"><span>Administrador: </span>{{$order->user->name}}</p>
        {{-- <a class="view__edit" href="{{route('supplier.edit', $supplier)}}">Actualizar</a> --}}
    </div>
  
    <h2 class="view__subtitle">Detalles del pedido</h2>
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Cantidad</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Subtotal</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($order->orderdetails as $orderdetail)
        <tr class="dashboard__table__body">
            <td>{{$orderdetail->amount}}</td>
            <td>{{$orderdetail->ingredient->name}}</td>
            <td>$ {{$orderdetail->price}}</td>
            <td>$ {{$orderdetail->subtotal}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('ingredient.show', $orderdetail->ingredient)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>

    
</x-dashboard>