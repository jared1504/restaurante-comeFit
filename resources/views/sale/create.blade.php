@php
$items = [
['route'=> 'sale.index', 'text' => 'Ventas'],
['route'=> 'sale.filter', 'text' => 'Historial de ventas'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>