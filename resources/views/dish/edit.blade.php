@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>