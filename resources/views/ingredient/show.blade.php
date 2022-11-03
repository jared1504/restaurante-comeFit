@php
$items = [
['route'=> 'ingredient.index', 'text' => 'Ingredientes'],
['route'=> 'ingredient.create', 'text' => 'Nuevo Ingrediente'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver ingrediente</h2>
    <p>Ve los datos de un ingrediente</p>
    <div class="view">
        <p class="view__item"><span>Código: </span>{{$ingredient->id}}</p>
        <p class="view__item"><span>Nombre: </span>{{$ingredient->name}}</p>
        <p class="view__item"><span>Costo: </span>{{$ingredient->cost}}</p>
        <p class="view__item"><span>Unidad de medida: </span>{{$ingredient->unit}}</p>
        <p class="view__item"><span>Stock: </span>{{$ingredient->stock}}</p>
        <a class="view__edit"
            href="{{route('ingredient.edit', $ingredient)}}">Actualizar</a>
    </div>
</x-dashboard>