@php
$items = [
['route'=> 'sale.index', 'text' => 'Ventas'],
['route'=> 'sale.create', 'text' => 'Nueva Venta'],
];
@endphp

<x-dashboard :items="$items">
    @role('admin')
    <h1>Eres Admin</h1>
    @endrole

    @role('cashier')
    <h2>Eres Cajero</h2>
    @endrole

    @role('waiter')
    <h1>Eres Mesero</h1>
    @endrole


    @role('chef')
    <h1>Eres Chef</h1>
    @endrole
</x-dashboard>