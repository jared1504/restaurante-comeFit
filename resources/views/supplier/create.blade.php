@php
$items = [
['route'=> 'supplier.index', 'text' => 'Proveedores'],
['route'=> 'supplier.create', 'text' => 'Nuevo Proveedor'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>