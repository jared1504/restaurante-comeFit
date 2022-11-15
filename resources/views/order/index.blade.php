@php
$items = [
['route'=> 'order.index', 'text' => 'Pedidos'],
['route'=> 'order.create', 'text' => 'Nuevo Pedido'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Pedidos</h2>
    <p>Ve los pedidos</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Fecha</td>
            <td>Proveedor</td>
            <td>Total</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($orders as $order)
        <tr class="dashboard__table__body">
            <td>{{$order->created_at->format('d/M/Y')}}</td>
            <td>{{$order->supplier->name}}</td>
            <td>$ {{$order->total}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('order.show', $order)}}">Ver</a>
            </td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <th colspan="4">{{ $orders->links() }}</th>
            </tr>
        </tfoot>
    </table>
</x-dashboard>