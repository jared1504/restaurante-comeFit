@php
$items = [
['route'=> 'sale.index', 'text' => 'Ventas'],
['route'=> 'sale.create', 'text' => 'Nueva Venta'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>