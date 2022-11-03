@php
$items = [
['route'=> 'category.index', 'text' => 'Categorías'],
['route'=> 'category.create', 'text' => 'Nueva Categoría'],
];
@endphp

<x-dashboard :items="$items">

</x-dashboard>