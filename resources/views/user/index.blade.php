@php
$items = [
['route'=> 'user.index', 'text' => 'Empleados'],
['route'=> 'user.create', 'text' => 'Nuevo Empleado'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>