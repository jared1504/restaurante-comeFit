@php
$items = [
['route'=> 'table.index', 'text' => 'Mesas'],
['route'=> 'table.create', 'text' => 'Nueva Mesa'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>