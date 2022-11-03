@php
$items = [
['route'=> 'order.index', 'text' => 'Pedidos'],
['route'=> 'order.create', 'text' => 'Nuevo Pedido'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>